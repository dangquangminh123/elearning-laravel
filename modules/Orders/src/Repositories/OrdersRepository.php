<?php

namespace Modules\Orders\src\Repositories;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Models\OrderStatus;
use App\Repositories\BaseRepository;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\src\Jobs\AutoCancelOrderJob;
use Modules\Orders\src\Events\OrderStatusChanged;
class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function createOrderWithDetails($studentId, array $cart)
    {
        // Tính tổng tiền cart trước
        $total = 0;
        foreach ($cart as $item) {
            $price = isset($item['sale_price']) && $item['sale_price'] !== null ? $item['sale_price'] : $item['price'];
            $total += $price;
        }

        // Tạo đơn hàng với tổng tiền
        $order = $this->model->create([
            'student_id' => $studentId,
            'status_id' => 1,
            'discount' => 0,
            'coupon' => null,
            'total' => $total,
        ]);

        // Lưu chi tiết từng khóa học
        foreach ($cart as $item) {
            $price = isset($item['sale_price']) && $item['sale_price'] !== null ? $item['sale_price'] : $item['price'];
            $order->detail()->create([
                'course_id' => $item['id'],
                'price' => $price,
            ]);
        }
        AutoCancelOrderJob::dispatch($order->id)->delay(now()->addHours(24));
        return $order;
    }

    public function getOrderWithRelationsById($id)
    {
        return Order::with([
            'student',
            'status',
            'detail.course',
            'couponOrder',
        ])->findOrFail($id);
    }
    
    public function getOrdersByStudent($studentId, $filters = [], $limit)
    {

        @['status_id' => $statusId, 'start_date' => $startDate, 'end_date' => $endDate, 'total' => $total] = $filters;
        $query = $this->model->with('status')->where('student_id', $studentId)->latest();

        if ($statusId) {
            $query->where('status_id', $statusId);
        }
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($total && $total >= 0) {
            $query->where('orders.total', '>=', $total);
        }
        return $query->paginate($limit)->withQueryString();
    }

    public function getOrder($orderId)
    {
        return $this->model->with('detail')->find($orderId);
    }

   
    public function updatePaymentDate($orderId)
    {
        $order = $this->getOrder($orderId);

        if ($order->payment_date) {
            return;
        }
        return $this->update($orderId, [
            'payment_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function updatePaymentCompleteDate($orderId)
    {
        return $this->update($orderId, [
            'payment_complete_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function updateDiscount($orderId, $discount, $coupon)
    {
        return $this->update($orderId, [
            'discount' => $discount,
            'coupon' => $coupon
        ]);
    }


    public function setPendingIfFailed($orderId)
    {
        $order = $this->getOrderWithRelationsById($orderId);

        if ($order->status && $order->status->code === 'failed_payment') {
            $pendingStatusId = OrderStatus::where('code', 'pending_payment')->value('id');
            if ($pendingStatusId) {
                $this->updateStatus($orderId, $pendingStatusId);
                $order->status_id = $pendingStatusId;
            }
        }

        return $order;
    }

    public function updateStatus($orderId, $status)
    {
        return $this->update($orderId, [
            'status_id' => $status
        ]);
    }

    // Update trạng thái và bắn event
    public function updateStatusAndFireEvent($order, $newStatusCode)
    {
        $oldCode = $order->status->code;
        $this->updateStatus($order, $newStatusCode);

        event(new OrderStatusChanged($order->fresh('detail'), $oldCode, $newStatusCode));
    }

    public function deleteOrdersByCouponCode($couponCode) 
    {
        $orders = $this->model->where('coupon', $couponCode)->with('status', 'detail')->get();

        // Nếu có đơn hàng đã hoàn tất => không cho xoá
        foreach ($orders as $order) {
            if ($order->status && $order->status->is_success) {
                return false;
            }
        }

        // Xoá chi tiết đơn hàng
        foreach ($orders as $order) {
            $order->detail()->delete(); // Xoá qua quan hệ
            $order->delete();           // Xoá đơn hàng
        }

        return true;
    }

    public function getStatusIdByCode($code)
    {
        static $cache = [];
        if (array_key_exists($code, $cache)) {
            return $cache[$code];
        }

        $id = OrderStatus::where('code', $code)->value('id');
        $cache[$code] = $id ? (int)$id : null;
        return $cache[$code];
    }
    public function studentPurchasedCourse($studentId, $courseId): bool
    {
        // Phải thanh toán thành công đơn hàng
        $paidStatusId = $this->getStatusIdByCode('paid');
        if (!$paidStatusId) {
            return false;
        }

        return $this->model
            ->where('student_id', $studentId)
            ->where('status_id', $paidStatusId)
            ->whereHas('detail', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })->exists();
    }

    public function getAllOrdersWithRelations($search = null)
    {
        $query = $this->model
            ->with(['student', 'status', 'detail.course'])
            ->latest();
        
        // Nếu có search thì lọc theo tên học viên
        if (!empty($search)) {
            $query->whereHas('student', function ($name) use ($search) {
                $name->where('name', 'like', '%' . $search . '%');
            });
        }
        return $query->get();
    }

    public function getCouponOrder($id)
    {
        return $this->model->with(['couponOrder'])->findOrFail($id);
    }

    public function getStatusBadge($order)
    {
        $name = $order->status?->name ?? '(Không rõ)';
        $color = $order->status?->color ?? '#6c757d'; // mặc định màu xám
        return '<span class="badge bg-' . $color . '">' . $name . '</span>';
    }

    public function getAvailableTransitions($order)
    {
        $statusMap = OrderStatus::pluck('id', 'code')->toArray();

        $rules = [
            'pending_payment' => ['paid', 'cancelled_payment'],
            'paid'            => ['refunded'],
            'failed_payment'  => ['pending_payment', 'cancelled_payment'],
            'cancelled_payment' => [],
            'refunded'          => [],
        ];

        $currentCode = OrderStatus::find($order->status_id)->code;
        $allowedCodes = $rules[$currentCode] ?? [];

        $allowedIds = array_map(fn($code) => $statusMap[$code], $allowedCodes);

        return OrderStatus::whereIn('id', $allowedIds)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function changeStatus($orderId, $statusId)
    {
        $order = $this->getOrderWithRelationsById($orderId);
        if (!$order) {
            return false; 
        }

        $status = OrderStatus::find($statusId);
        if (!$status) {
            return false;
        }

        $order->status_id = $statusId;
        $newStatusCode = $status->code;

        if ($newStatusCode === 'paid' && !$order->payment_complete_date) {
            $order->payment_complete_date = now();
        }

        if (in_array($newStatusCode, ['refunded', 'cancelled_payment'])) {
            $order->refunded_at = now();

            foreach ($order->detail as $d) {
                $d->update([
                    'is_refunded' => true,
                    'refunded_at' => now(),
                ]);
            }
        }
        $order->save();

        return $this->getOrderWithRelationsById($orderId);
    }


    public function refundOrder(int $orderId): bool
    {
        $refundedStatusId = $this->getStatusIdByCode('refunded');
        if (!$refundedStatusId) {
            return false;
        }

        $order = $this->getOrderWithRelationsById($orderId);
        if (!$order || $order->status_id !== $this->getStatusIdByCode('paid')) {
            return false; // Chỉ hoàn tiền đơn đã thanh toán
        }

        // Cập nhật trạng thái
        $order->update([
            'status_id' => $refundedStatusId,
            'refunded_at' => now(),
        ]);

        // Đánh dấu các detail đã hoàn
        foreach ($order->detail as $d) {
            $d->update([
                'is_refunded' => true,
                'refunded_at' => now(),
            ]);
        }
        return true;
    }
}