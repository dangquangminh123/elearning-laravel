<?php

namespace Modules\Orders\src\Repositories;
use Modules\Orders\src\Models\Order;
use App\Repositories\BaseRepository;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;

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

        return $order;
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

    public function updateStatus($orderId, $status)
    {
        return $this->update($orderId, [
            'status_id' => $status
        ]);
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
}