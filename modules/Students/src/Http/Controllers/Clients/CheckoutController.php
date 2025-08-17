<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepository;
use Modules\Students\src\Services\StudentCourseService;
use Modules\Orders\src\Events\OrderRefunded;
use App\Notifications\OrderRefundedNotification;

class CheckoutController extends Controller
{

    private $orderRepository;
    protected $courseService;
    public function __construct(OrdersRepository $orderRepository, StudentCourseService $courseService)
    {
        $this->orderRepository = $orderRepository;
        $this->courseService = $courseService;
    }

    public function index($id)
    {
        $pageTitle = 'Thanh toán';
        $pageName = 'Thanh toán';
        $order = $this->orderRepository->getOrder($id);
        if (!$order || $order->status->is_success == 1) {
            // return abort(404);
            return view('errors.404', [
                'message' => 'Đơn hàng này không tìm thấy hoặc không tồn tại',
                'pageTitle' => 'Không tìm thấy đơn hàng',
            ]);
        }

        // Đổi lại trạng thái cũ của đơn hàng 
        $order = $this->orderRepository->setPendingIfFailed($id);
        $order->status->code = 'pending_payment'; // Cập nhật để view không bị lệch
        
        $this->orderRepository->updateDiscount($id, 0, null); 
        $order->discount = 0;
        $order->coupon = 0;

        $this->orderRepository->updatePaymentDate($id);
        if (config('checkout.checkout_countdown') > 0) {

            $now = strtotime(date('Y-m-d H:i:s'));
            $paymentDate = strtotime($order->payment_date);
            $diff = $now - $paymentDate;
            $checkoutCountdown = config('checkout.checkout_countdown') * 60;
            if ($diff > $checkoutCountdown) {
                // return abort(400, "Đơn hàng hết thời gian thanh toán");
                return view('errors.400', [
                    'message' => 'Đơn hàng này đã hết thời gian thanh toán ! Vui lòng thử lại',
                    'pageTitle' => 'Hết hạn thanh toán !',
                ]);
            }
        }

        return view('students::clients.checkout', compact('pageTitle', 'pageName', 'id', 'order'));
    }

    public function refundOrder($id) {
        // 1. Lấy đơn hàng
        $order = $this->orderRepository->getOrderWithRelationsById($id);

        // Kiểm tra quyền sở hữu
        if (!$order || $order->student_id !== auth('students')->id()) {
             return view('errors.404', [
                'message' => 'Bạn chưa được phép huỷ đơn hàng này',
                'pageTitle' => 'Không được phép!',
            ]);
        }

        // Kiểm tra trạng thái
        if ($order->status_id !== $this->orderRepository->getStatusIdByCode('paid')) {
            return redirect()
                ->route('students.account.order-detail', $id)
                ->with('error', 'Chỉ đơn hàng đã thanh toán mới được hoàn tiền');
        }

        // 2. Cập nhật trạng thái đơn hàng + chi tiết
        $success = $this->orderRepository->refundOrder($id);
        if (!$success) {
            return redirect()
                ->route('students.account.order-detail', $id)
                ->with('error', 'Không thể hoàn tiền. Vui lòng thử lại.');
        }

        // 3. Xoá quyền truy cập khoá học
        $this->courseService->removeCoursesStudent($id);

        // Gọi event thay vì notify trực tiếp
        event(new OrderRefunded($order));
        $order->student->notify(new OrderRefundedNotification($order));

        // 5. Redirect trả về trang chi tiết đơn hàng
        return redirect()
            ->route('students.account.order-detail', $id)
            ->with('success', 'Đã hoàn trả đơn hàng thành công');
    }
}