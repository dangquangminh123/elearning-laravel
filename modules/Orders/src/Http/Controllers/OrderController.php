<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    protected $ordersRepository;
    protected $couponRepository;
    public function __construct(OrdersRepositoryInterface $ordersRepository, CouponsRepositoryInterface $couponRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->couponRepository = $couponRepository;
    }

    public function data()
    {
        $orders = $this->ordersRepository->getAllOrdersWithRelations();

        return DataTables::of($orders)
            ->addColumn('action', function ($order) {
                $viewBtn = '<div class="mb-1"><a href="' . route('admin.orders.show', $order->id) . '" class="btn-view"><i class="fas fa-eye"></i> Xem</a></div>';

                // Các trạng thái được phép chỉnh sửa
                $editableStatuses = ['Chờ thanh toán', 'Thanh toán bất bại'];
                if (in_array($order->status->name ?? '', $editableStatuses)) {
                    $editBtn = '<div><a href="' . route('admin.orders.edit', $order->id) . '" class="btn-edit"><i class="fas fa-edit"></i> Chỉnh sửa</a></div>';
                    return $viewBtn . $editBtn;
                }
                return $viewBtn;
            })
            ->addColumn('id', fn($order) => $order->id)
            ->addColumn('student_name', fn($order) => $order->student->name ?? '(Không có)')
            ->addColumn('coupon_discount', function ($order) {
                $info = get_coupon_discount_info($order->id);
                return $info['formatted'];
            })
            ->addColumn('total', fn($order) => format_currency($order->total))
            ->addColumn('final_amount', function ($order) {
                $info = get_coupon_discount_info($order->id);
                return format_currency($order->total - $info['amount']);
            })
            ->addColumn('status', fn($order) => $this->ordersRepository->getStatusBadge($order))
            ->addColumn('payment_date', fn($order) => $order->payment_date ? Carbon::parse($order->payment_date)->format('d/m/Y H:i') : '-')
            ->addColumn('payment_complete_date', fn($order) => $order->payment_complete_date ? Carbon::parse($order->payment_complete_date)->format('d/m/Y H:i') : '-')
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function index() {
        $pageTitle = 'Quản lý đơn hàng';
        // $users = $this->coursesRepository->getAllCourses();
        return view('orders::index', compact('pageTitle'));
    }

    public function show($id)
    {
        $order = $this->ordersRepository->getOrderWithRelationsById($id);
        $statusName = strtolower($order->status?->name ?? '');
        // dd($statusName);
        $isPaid = (bool) $order->status?->is_success;

        $paymentAmount = $isPaid ? ($order->total - $order->discount) : 0;
        if (request()->ajax()) {
            $couponInfo = get_coupon_discount_info($order->id);
            $couponType = $order->coupon ? get_coupon_type($order->id) : 'Không có';
            
            return response()->json([
                'success' => true,
                'order' => [
                    'id' => $order->id,
                    'student' => $order->student,
                    'status' => $order->status->name,
                    'total' => format_currency($order->total),
                    'discount' => [
                        'amount' => $couponInfo['amount'],
                        'formatted' => $couponInfo['formatted'],
                        'type' => $couponType,
                    ],
                    'payment_amount' => format_currency($paymentAmount),
                    'payment_date' => Carbon::parse($order->payment_date)->format('d/m/Y H:i'),
                    'payment_complete_date' => $isPaid && $order->payment_complete_date ? Carbon::parse($order->payment_complete_date)->format('d/m/Y H:i')
                    : 'Không thanh toán',
                    'note' => $order->note,
                    'courses' => $order->detail->map(function ($detailCourse) {
                        return [
                            'name' => $detailCourse->course->name ?? '(Không rõ)',
                            'price' => format_currency($detailCourse->price),
                        ];
                    }),
                ]
            ]);
        }
        return redirect()->route('admin.orders.index');
    }


}