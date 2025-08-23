<?php

namespace Modules\Orders\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Services\StudentCourseAccessService;

class OrderController extends Controller
{

    protected $ordersRepository;
    protected $accessService;


    public function __construct(OrdersRepositoryInterface $ordersRepository, StudentCourseAccessService $accessService)
    {
        $this->ordersRepository = $ordersRepository;
        $this->accessService = $accessService;
    }

    public function proceed(Request $request)
    {

        //B1: xác thực người dùng
        if (!auth('students')->check()) {
            session(['url.intended' => route('orders.proceed')]);
            return redirect()->route('clients.login')->with('msg', 'Bạn cần đăng nhập để tiếp tục thanh toán.');
        }

        // $studentId = auth('students')->id(); 
        $student = auth('students')->user();

        //B2: kiểm tra giỏ hàng
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('msg', 'Giỏ hàng đang trống.');
        }

        // 3) Phân loại: đã sở hữu / chưa sở hữu
        $owned = $notOwned = [];
        foreach ($cart as $key => $item) {
            if ($this->accessService->studentHasAccessToCourse($student, $item['slug'])) {
                $owned[$key] = $item;
            } else {
                $notOwned[$key] = $item;
            }
        }

        // 4) Nếu có khóa đã sở hữu: xóa chúng khỏi giỏ, rồi chuyển tới khóa sở hữu đầu tiên
        if ($owned) {
            session(['cart' => $notOwned]);
            $slug = reset($owned)['slug'];
            return redirect()->route('courses.learn', $slug)
                            ->with('msg', 'Một số khoá học bạn đã sở hữu nên đã được xoá khỏi giỏ. Học ngay!');
        }

        // 5) Nếu không có khóa nào đã sở hữu: tạo đơn với phần chưa sở hữu
        $order = $this->ordersRepository->createOrderWithDetails($student->id, $notOwned);
        session(['current_order_id' => $order->id]);

        return redirect()->route('orders.confirm');
    }

    public function confirm()
    {
        $pageTitle = 'Xác nhận đơn hàng';
        $orderId = session('current_order_id');

        if (!$orderId) {
            return redirect()->route('home')->with('msg', 'Không tìm thấy đơn hàng.');
        }

        $order = $this->ordersRepository->getOrder($orderId);

        return view('orders::clients.confirm', compact('pageTitle','order'));
    }
}