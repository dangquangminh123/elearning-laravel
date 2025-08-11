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
        $search = request()->get('search')['value'] ?? null;
        $orders = $this->ordersRepository->getAllOrdersWithRelations($search);

        return DataTables::of($orders)
            ->addColumn('action', function ($order) {
                $viewBtn = '<div class="mb-1"><a href="' . route('admin.orders.show', $order->id) . '" class="btn-view"><i class="fas fa-eye"></i> Xem</a></div>';

                $transitions = $this->ordersRepository->getAvailableTransitions($order);

                if (!empty($transitions)) {
                    $dropdown = '<div class="dropdown">';
                    $dropdown .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">Cập nhật đơn hàng</button>';
                    $dropdown .= '<div class="dropdown-menu">';
                    foreach ($transitions as $statusId => $statusName) {
                        $dropdown .= '<a href="#" class="dropdown-item update-status" data-order-id="' . $order->id . '" data-status-id="' . $statusId . '">' . $statusName . '</a>';
                    }
                    $dropdown .= '</div></div>';

                    return $viewBtn . $dropdown;
                }
                return $viewBtn;
            })
            ->addColumn('id', fn($order) => $order->id)
            ->addColumn('student_name', fn($order) => $order->student->name ?? '(Không có)')
            ->addColumn('coupon_discount', fn($order) => get_coupon_discount_info($order->id)['formatted'])

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

    public function updateStatus(Request $request, $id)
    {
        $statusId = $request->input('status_id');

        $order = $this->ordersRepository->changeStatus($id, $statusId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Chỉnh sửa trạng thái thất bại (đơn hàng không tồn tại).'
            ], 422);
        }
        $statusOrder = $this->ordersRepository->getStatusBadge($order);
        $paymentCompleted = optional($order->payment_complete_date)->format('d/m/Y H:i');

        return response()->json([
            'success' => true,
            'message' => 'Chỉnh sửa trạng thái thành công',
            'statusOrder' => $statusOrder,
            'payment_complete_date' => $paymentCompleted,
        ]);
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