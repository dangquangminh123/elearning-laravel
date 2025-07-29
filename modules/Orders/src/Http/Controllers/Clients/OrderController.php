<?php

namespace Modules\Orders\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $ordersRepository;

    public function __construct(OrdersRepositoryInterface $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    public function proceed(Request $request)
    {
        if (!auth('students')->check()) {
            session(['url.intended' => route('orders.proceed')]);
            return redirect()->route('clients.login')->with('msg', 'Bạn cần đăng nhập để tiếp tục thanh toán.');
        }

        $studentId = auth('students')->id(); 
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('msg', 'Giỏ hàng đang trống.');
        }

       
        $order = $this->ordersRepository->createOrderWithDetails($studentId, $cart);

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