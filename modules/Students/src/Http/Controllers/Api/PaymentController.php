<?php

namespace Modules\Students\src\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersStatusRepositoryInterface;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
use Modules\Students\src\Services\StudentCourseService;
use Modules\Orders\src\Events\OrderPaid;
class PaymentController extends Controller
{

    private $orderRepository;
    private $couponRepository;
    private $orderStatusRepository;
    protected $studentCourseService;

    public function __construct(OrdersRepositoryInterface $orderRepository, OrdersStatusRepositoryInterface $orderStatusRepository,
    CouponsRepositoryInterface $couponRepository, StudentCourseService $studentCourseService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->couponRepository = $couponRepository;
        $this->studentCourseService = $studentCourseService;
    }

    public function autoPay(Request $request)
    {
        $authorize = $request->header('Authorization') ?? "";
        $apiKey = str_replace('Apikey ', '', $authorize);
        if (!$apiKey || $apiKey !== env('SEPAY_SECRET')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }
        $content = $request->input('content');
        $transferType = $request->transferType;
        $transferAmount = $request->transferAmount;
        if (!$content || $transferType != 'in' || !$transferAmount) {
            return response()->json([
                'success' => false,
            ], 401);
        }
        //Lấy order id từ content
        preg_match("/chuyen tien hoc phi khoa hoc (\d+)/i", $content, $matches);
        if (!empty($matches[1])) {
            $orderId = $matches[1];
            $order = $this->orderRepository->getOrder($orderId);
            if (!$order) {
                return view('errors.401', [
                    'message' => 'Không tìm thấy đơn này! vui lòng thử tạo lại đơn hàng mới',
                    'pageTitle' => 'Thanh toán thất bại',
                ]);
            }
            // //Kiểm tra thời gian của đơn hàng
            if (config('checkout.checkout_countdown') > 0) {
                $now = strtotime(date('Y-m-d H:i:s'));
                $paymentDate = strtotime($order->payment_date);
                $diff = $now - $paymentDate;
                $checkoutCountdown = config('checkout.checkout_countdown') * 60;
                if ($diff > $checkoutCountdown) {
                    return view('errors.401', [
                        'message' => 'Đơn hàng này đã quá hạn thanh toán! Vui lòng thanh toán lại',
                        'pageTitle' => 'Thanh toán thất bại',
                    ]);
                }
            }

            $total = $order->total - $order->discount;
            if ($total != $transferAmount) {
                return view('errors.401', [
                    'message' => 'Số tiền thanh toán bị sai hoặc bạn trả tiền chưa đúng',
                    'pageTitle' => 'Thanh toán thất bại',
                ]);
            }

            // // Xử lý cập nhật trạng thái đơn hàng
            $orderStatus = $this->orderStatusRepository->getOrderStatus(1, 'is_success');
            if (!$orderStatus) {
                return view('errors.401', [
                    'message' => 'Đơn hàng này đã được thanh toán hoặc không thể thanh toán!',
                    'pageTitle' => 'Thanh toán thất bại',
                ]);
            }

            $statusId = $orderStatus->id;
            if ($order->status_id == $statusId) {
                return view('errors.401', [
                    'message' => 'Trạng thái đơn hàng đang bị lỗi hoặc đơn hàng đã bị sai !',
                    'pageTitle' => 'Thanh toán thất bại',
                ]);
            }
            $data = $this->orderRepository->updateStatus($orderId, $statusId);
            if (!$data) {
                return view('errors.401', [
                    'message' => 'Thông tin đơn hàng bị sai hoặc đơn hàng này đã bị lỗi!',
                    'pageTitle' => 'Thanh toán thất bại',
                ]);
            }

            // Cập nhật thời gian hoàn thành thanh toán
            $status = $this->orderRepository->updatePaymentCompleteDate($orderId);
            if ($order->coupon) {
                $this->couponRepository->couponUsage($order->coupon, $orderId);
            }

            $this->studentCourseService->attachCoursesToStudent($orderId);
            event(new OrderPaid($order));
            return [
                'success' => true,
            ];
        }
        // return response()->json([
        //     'success' => false,
        // ], 401);
        return view('errors.401', [
                'message' => 'Đã có lỗi xảy ra ở trạng thái, số tiền thanh toán, thời hạn thanh toán! Vui lòng thử lại đơn hàng khác',
                'pageTitle' => 'Thanh toán thất bại',
            ]);
    }

    public function checkPayment($orderId)
    {
        $order = $this->orderRepository->getOrder($orderId);
        if (!$order) {
            return response()->json([
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $order->status
        ]);
    }
}