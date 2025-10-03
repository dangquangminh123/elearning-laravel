<?php

namespace Modules\Courses\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
   protected $coursesRepository;
   protected $categoriesRepository;
   protected $teacherRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, 
    CategoriesRepositoryInterface $categoriesRepository,
    TeacherRepositoryInterface $teacherRepository) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function data() {
        $courses = $this->coursesRepository->getAllCourses();
        return DataTables::of($courses)
            ->addColumn('lessons', function($course) {
                return '<a href="'.route('admin.lessons.index', $course).'" class="btn btn-primary btm-sm">'.__('courses::messages.courses_lesson').'</a>';
            })
            ->addColumn('edit', function($course) {
                return '<a href="'.route('admin.courses.edit', $course).'" class="btn btn-warning btm-sm">'.__('courses::messages.courses_edit').'</a>';
            })
            ->addColumn('delete', function($course) {
                return '<a href="'.route('admin.courses.delete', $course).'" class="btn btn-danger btm-sm delete-action">'.__('courses::messages.courses_delete').'</a>';
            })
            ->editColumn('code', function($course) {
                return '<span class="badge bg-danger">'.$course->code.'</span>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('status', function ($course) {
                return $course->status == 1 ? '<span class="btn btn-success">'.__('courses::messages.courses_taken_place').'</span>' : '<span class="btn btn-warning">'.__('courses::messages.courses_not_yet').'</span>';
            })
            ->addColumn('type_name', function($course) {
                return format_course_type($course->type->name ?? __('courses::messages.courses_no_type'));
            })
            ->editColumn('price', function ($course) {
                if($course->price) {
                    if($course->sale_price) {
                        $price = number_format($course->sale_price).'đ';
                    }else {
                        $price = number_format($course->price).'đ';
                    }
                }else {
                    $price = __('courses::messages.free_price');
                }
                return $price;
            })
        ->rawColumns(['edit', 'delete', 'code', 'status', 'type_name', 'lessons'])
        ->toJson();
    }
    public function index() {
        $pageTitle = __('courses::messages.manager_courses');
        return view('courses::lists', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = __('courses::messages.add_courses_page');
        $teacher = $this->teacherRepository->getAllTeacher()->get();
        $types = $this->coursesRepository->getAllTypeCourses();
        $categories = $this->categoriesRepository->getAllCategories();
        return view('courses::add', compact('pageTitle', 'categories', 'teacher', 'types'));
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

        return redirect()->route(route: 'admin.courses.index')->with('msg',__('courses::messages.create.success'));
    }

    public function edit($id) {
        $course = $this->coursesRepository->getCourse($id);
        $categoryIds = $this->coursesRepository->getRelatedCategories($course);
        $categories = $this->categoriesRepository->getAllCategories();
        $types = $this->coursesRepository->getAllTypeCourses();
        $teacher = $this->teacherRepository->getAllTeacher()->get();

        $pageTitle = __('courses::messages.edit_courses_page');

        if(!$course) {
            abort(404);
        }
        return view('courses::edit', compact('course', 'pageTitle', 'categories', 'categoryIds', 'teacher', 'types'));
    }

    public function update(CoursesRequest $coursesRequest, $id) {

        $courses = $coursesRequest->except('_token', '_method');
        if(!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }
        if(!$courses['price']) {
            $courses['price'] = 0;
        }
        
        $this->coursesRepository->updateCourse($id, $courses);

        $categories = $this->getHandleCategories($courses);

        $course = $this->coursesRepository->getCourse($id);
        $this->coursesRepository->updateCourseCategories($course, $categories);

        return back()->with('msg',__('courses::messages.update.success'));
    }

    public function delete($id) {
        $course = $this->coursesRepository->getCourse($id);
        // $this->coursesRepository->deleteCourseCategories($course);
        $status = $this->coursesRepository->deleteCourse($id);
        if($status) {
            deleteFileStorage($course->thumbnail);
        }
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
