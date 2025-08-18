<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
class HomeController extends Controller
{
    protected $coursesRepository;
    protected $teacherRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, TeacherRepositoryInterface $teacherRepository) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index() {
       $pageTitle = 'Trang chủ';

        // Lấy tất cả loại khóa học
        $courseTypes = $this->coursesRepository->getAllTypeCourses();

        // Lấy tất cả khóa học (bao gồm type + teacher)
        $courses = $this->coursesRepository->getAllCourses()->get();

        // Group các khóa học theo type_id
        $coursesByType = $courses->groupBy('type_id');

        // dd($courses);
        return view('home::index', compact('pageTitle', 'courseTypes', 'coursesByType'));
    }
}