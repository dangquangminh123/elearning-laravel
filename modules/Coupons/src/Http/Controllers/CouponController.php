<?php

namespace Modules\Coupons\src\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Coupons\src\Http\Requests\CouponsRequest;
use Yajra\DataTables\Facades\DataTables;
class CouponController extends Controller
{

    protected $couponsRepository;
    protected $ordersRepository;
    protected $coursesRepository;
    protected $studentsRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, 
    CouponsRepositoryInterface $couponsRepository, OrdersRepositoryInterface $ordersRepository, 
    StudentsRepositoryInterface $studentsRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->couponsRepository = $couponsRepository;
        $this->ordersRepository = $ordersRepository;
        $this->studentsRepository = $studentsRepository;
    }

   
    public function create() {
        $pageTitle = 'Tạo mới mã giảm giá';
        $couponCode = generateCoupon(); //tạo mã

        $courses = $this->coursesRepository->getAllCourses()->get();
        $students = $this->studentsRepository->getAllStudents()->get();
        return view('coupons::add', compact('pageTitle', 'courses', 'students', 'couponCode'));
    }

    public function store(CouponsRequest $request) {
        $coupons = $request->except(['_token']);

        $coupon = $this->couponsRepository->create($coupons);
        // dd($coupon);
        // Lấy danh sách học viên và khoá học từ form
        $studentIds = $request->input('student_id', []);
        $courseIds = $request->input('course_id', []);
        
        // Nếu có student_id thì gán, còn không thì bỏ qua
        if (!empty($studentIds)) {
            $students = $this->getHandleStudents($studentIds);
            $this->couponsRepository->createCouponStudents($coupon, $students);
        }

        // Nếu có course_id thì gán, còn không thì bỏ qua
        if (!empty($courseIds)) {
            $courses = $this->getHandleCourses($courseIds);
            $this->couponsRepository->createCouponCourse($coupon, $courses);
        }

        return redirect()->route(route: 'admin.coupons.index')->with('msg',__('coupons::messages.create.success'));
    }

    public function data() {
        $coupons = $this->couponsRepository->getAllCoupons();
        return DataTables::of($coupons)
            ->addColumn('edit', function($coupon) {
                return '<a href="'.route('admin.coupons.edit', $coupon).'" class="btn btn-warning btm-sm">Sửa</a>';
            })
            ->addColumn('delete', function($coupon) {
                return '<a href="'.route('admin.coupons.delete', $coupon->id).'" class="btn btn-danger btm-sm delete-action">Xoá</a>';
            })
            ->editColumn('code', function($coupon) {
                return '<span class="badge bg-danger">'.$coupon->code.'</span>';
            })
           ->editColumn('discount_type', function ($coupon) {
                return format_discount_type($coupon->discount_type);
            })
            ->editColumn('discount_value', function ($coupon) {
                return format_discount_value($coupon->discount_type, $coupon->discount_value);
            })
            ->editColumn('total_condition', function ($coupon) {
                return number_format($coupon->discount_value).'đ' ;
            })
            ->editColumn('count', function ($coupon) {
                return format_coupon_count($coupon->count);
            })
            ->editColumn('start_date', function ($coupon) {
                return format_coupon_start_date($coupon->start_date);
            })
            ->editColumn('end_date', function ($coupon) {
                return format_coupon_end_date($coupon->end_date);
            })
        ->rawColumns(['edit', 'delete', 'code', 'discount_type', 'discount_value', 'total_condition', 'count', 'start_date', 'end_date'])
        ->toJson();
    }
    public function index() {
        $pageTitle = 'Quản lý mã giảm giá';
        return view('coupons::lists', compact('pageTitle'));
    }

    public function edit($id) {
        $coupon = $this->couponsRepository->getCoupon($id);
        $studentIds = $this->couponsRepository->getStudentsCoupon($coupon);
        $courseIds = $this->couponsRepository->getCourseCoupon($coupon);

        $courses = $this->coursesRepository->getAllCourses();
        $students = $this->studentsRepository->getAllStudents()->get();

        $pageTitle = 'Cập nhập mã giảm giá';

        if(!$coupon) {
            abort(404);
        }
        return view('coupons::edit', compact('coupon', 'pageTitle', 'studentIds', 'students', 'courseIds', 'courses'));
    }

    public function update(CouponsRequest $coursesRequest, $id) {
        // dd($coursesRequest->all());
        $coupon = $this->couponsRepository->getCoupon($id);
        if (!$coupon) {
            return back()->with('error', 'Không tìm thấy mã giảm giá!');
        }

        $data = $coursesRequest->except('_token', '_method');        
        
        $this->couponsRepository->updateCoupon($id, $data);

        // Lấy danh sách học viên và khoá học từ form
        $studentIds = $coursesRequest->input('student_id', []);
        $courseIds = $coursesRequest->input('course_id', []);
        if (!empty(array_filter($studentIds))) {
            $students = $this->getHandleStudents($studentIds);
            $this->couponsRepository->updateCouponStudents($coupon, $studentIds);
        }

        if (!empty(array_filter($courseIds))) {
            $courses = $this->getHandleCourses($courseIds);
            $this->couponsRepository->updateCouponCourse($coupon, $courses);
        }



        return back()->with('msg',__('coupons::messages.update.success'));
    }


    public function delete($id) {
        DB::beginTransaction();
        $coupon = $this->couponsRepository->getCoupon($id);

        try {
            // B1: Kiểm tra và xoá đơn hàng nếu được
            $couponOrder = $this->ordersRepository->deleteOrdersByCouponCode($coupon->code);
            if (!$couponOrder) {
                DB::rollBack();
                return redirect()->back()->with('msg', __('coupons::messages.orders.success'));
            }

            // B2: Xoá các liên kết quan hệ
            $deleteCoupon = $this->couponsRepository->deleteCouponRelations($coupon);
            if (!$deleteCoupon) {
                DB::rollBack();
                return redirect()->back()->with('msg', __('coupons::messages.delete.failure'));
            }

            // B3: Xoá mã giảm giá
            $coupon->delete();

            DB::commit();
            return redirect()->route('admin.coupons.index')->with('msg', __('coupons::messages.delete.success'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg',__('coupons::messages.delete.failure'));
        }
    }

    
    public function getHandleStudents($studentIds) {
        $students = [];
        foreach($studentIds as $student) {
            $students[$student] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        return $students;
    }

    public function getHandleCourses($courseIds) {
        $courses = [];
        foreach($courseIds as $course) {
            $courses[$course] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        return $courses;
    }
 

}