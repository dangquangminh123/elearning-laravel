<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepository;

class CheckoutController extends Controller
{

    private $orderRepository;
    public function __construct(OrdersRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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

    public function refund($id) {
        return "Đã hoàn trả đơn hàng";
    }
}