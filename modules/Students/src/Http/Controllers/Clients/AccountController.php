<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Orders\src\Repositories\OrdersRepository;
use Modules\Orders\src\Repositories\OrdersStatusRepositoryInterface;
use Modules\Students\src\Http\Requests\Clients\PasswordRequest;
use Modules\Students\src\Http\Requests\Clients\StudentRequest;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class AccountController extends Controller
{
    private $studentRepository;
    private $teacherRepository;
    private $orderRepository;
    private $orderStatusRepository;

    public function __construct(StudentsRepositoryInterface $studentRepository, TeacherRepositoryInterface $teacherRepository,
     OrdersRepository $orderRepository, OrdersStatusRepositoryInterface $orderStatusRepository
     )
    {
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }
    public function index()
    {
        $pageTitle = 'Tài khoản';
        $pageName = 'Tài khoản';

        return view('students::clients.account', compact('pageTitle', 'pageName'));
    }

    public function profile()
    {
        $pageTitle = 'Thông tin cá nhân';
        $pageName = 'Thông tin cá nhân';

        $student = Auth::guard('students')->user();

        return view('students::clients.profile', compact('pageTitle', 'pageName', 'student'));
    }

    public function updateProfile(StudentRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->update($id, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return ['success' => $status];
    }

    public function myCourses(Request $request)
    {
        $pageTitle = 'Khóa học của tôi';
        $pageName = 'Khóa học của tôi';

        $filters = [];
        if ($request->teacher_id) {
            $filters['teacher_id'] = $request->teacher_id;
        }

        if ($request->keyword) {
            $filters['keyword'] = $request->keyword;
        }
        $studentId = Auth::guard('students')->user()->id;
        $courses = $this->studentRepository->getCourses($studentId, $filters, config('paginate.account_limit'));
        $teacher = $this->teacherRepository->getTeachers();

        return view('students::clients.my-courses', compact('pageTitle', 'pageName', 'courses', 'teacher'));
    }
    public function myOrders(Request $request)
    {
        $pageTitle = 'Đơn hàng của tôi';
        $pageName = 'Đơn hàng của tôi';

        $filters = [];
        if ($request->status_id) {
            $filters['status_id'] = $request->status_id;
        }
        if ($request->start_date) {
            $filters['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
        }
        if ($request->end_date) {
            $filters['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }
        if ($request->total) {
            $filters['total'] = $request->total;
        }

        $orders = $this->orderRepository->getOrdersByStudent(Auth::guard('students')->user()->id, $filters, config('paginate.account_limit'));
        $ordersStatus = $this->orderStatusRepository->getOrdersStatus();

        return view('students::clients.my-orders', compact('pageTitle', 'pageName', 'orders', 'ordersStatus'));
    }
    public function orderDetail($orderId)
    {
        $pageTitle = 'Chi tiết đơn hàng';
        $pageName = 'Chi tiết đơn hàng';
        $order = $this->orderRepository->getOrder($orderId);
        $now = strtotime(date('Y-m-d H:i:s'));
        $paymentDate = strtotime($order->payment_date);
        $diff = $now - $paymentDate;

        if (config('checkout.checkout_countdown') > 0) {
            $checkoutCountdown = config('checkout.checkout_countdown') * 60;
            if ($diff > $checkoutCountdown) {
                $order->expired = true;
            }
        }
        return view('students::clients.order-detail', compact('pageTitle', 'pageName', 'order'));
    }
    public function changePassword()
    {
        $pageTitle = 'Đổi mật khẩu';
        $pageName = 'Đổi mật khẩu';

        return view('students::clients.change-password', compact('pageTitle', 'pageName'));
    }

    public function updatePassword(PasswordRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->setPassword($request->password, $id);
        if (!$status) {
            $message = __('students::messages.update.failure');
        } else {
            $message = __('students::messages.update.success');
        }
        return back()->with('msg', $message)->with('msgType', $status ? 'success' : 'danger');
    }
}