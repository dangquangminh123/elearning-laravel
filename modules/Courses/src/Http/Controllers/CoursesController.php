<?php

namespace Modules\Courses\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
   protected $coursesRepository;
   protected $categoriesRepository;

    public function __construct(CoursesRepository $coursesRepository, CategoriesRepository $categoriesRepository) {
        $this->coursesRepository = $coursesRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function data() {
        $courses = $this->coursesRepository->getAllCourses();
        return DataTables::of($courses)
            ->addColumn('edit', function($course) {
                return '<a href="'.route('admin.courses.edit', $course).'" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function($course) {
                return '<a href="'.route('admin.courses.delete', $course).'" class="btn btn-danger delete-action">Xoá</a>';
            })
            ->editColumn('code', function($course) {
                return '<span class="badge bg-danger">'.$course->code.'</span>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('status', function ($course) {
                return $course->status == 1 ? '<button class="btn btn-success">Đã diễn ra</button>' : '<button class="btn btn-warning">Chưa diễn ra</button>';
            })
            ->editColumn('price', function ($course) {
                if($course->price) {
                    if($course->sale_price) {
                        $price = number_format($course->sale_price).'đ';
                    }else {
                        $price = number_format($course->price).'đ';
                    }
                }else {
                    $price = 'Miễn phí';
                }
                return $price;
            })
        ->rawColumns(['edit', 'delete', 'code', 'status'])
        ->toJson();
    }
    public function index() {
        $pageTitle = 'Quản lý người dùng';
        $users = $this->coursesRepository->getAllCourses();
        return view('courses::lists', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = 'Thêm mới khoá học';

        $categories = $this->categoriesRepository->getAllCategories();
        return view('courses::add', compact('pageTitle', 'categories'));
    }

    public function store(CoursesRequest $request) {
        $courses = $request->except(['_token']);

        if(!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }
        if(!$courses['price']) {
            $courses['price'] = 0;
        }
        $course = $this->coursesRepository->create($courses);

        $categories = $this->getHandleCategories($courses);

        $this->coursesRepository->createCourseCategories($course, $categories);

        return redirect()->route(route: 'admin.courses.index')->with('msg',__('user::messages.create.success'));
    }

    public function edit($id) {
        $course = $this->coursesRepository->find($id);
        $categoryIds = $this->coursesRepository->getRelatedCategories($course);
        $categories = $this->categoriesRepository->getAllCategories();

        $pageTitle = 'Cập nhập khoá học';

        if(!$course) {
            abort(404);
        }
        return view('courses::edit', compact('course', 'pageTitle', 'categories', 'categoryIds'));
    }

    public function update(CoursesRequest $coursesRequest, $id) {

        $courses = $coursesRequest->except('_token', '_method');
        if(!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }
        if(!$courses['price']) {
            $courses['price'] = 0;
        }
        
        $this->coursesRepository->update($id, $courses);

        $categories = $this->getHandleCategories($courses);

        $course = $this->coursesRepository->find($id);
        $this->coursesRepository->updateCourseCategories($course, $categories);

        return back()->with('msg',__('courses::messages.update.success'));
    }

    public function delete($id) {
        $course = $this->coursesRepository->find($id);
        $this->coursesRepository->deleteCourseCategories($course);
        $this->coursesRepository->delete($id);
        return back()->with('msg',__('courses::messages.delete.success'));
    }

    public function getHandleCategories($courses) {
        $categories = [];
        foreach($courses['categories'] as $category) {
            $categories[$category] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        return $categories;
    }
}
