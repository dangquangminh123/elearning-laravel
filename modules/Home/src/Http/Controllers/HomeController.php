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
        $pageTitle = __('home::messages.home_page');

        $teachers = $this->teacherRepository->getAllTeacher()->get();
        $teachersWithCourses = [];

        foreach ($teachers as $teacher) {
            $courses = $this->coursesRepository->getCoursesByTeacher($teacher->id);
            $teachersWithCourses[] = [
                'teacher' => $teacher,
                'courses' => $courses
            ];
        }
        // Lấy tất cả loại khóa học
        $courseTypes = $this->coursesRepository->getAllTypeCourses();

        // Lấy tất cả khóa học đã group theo type_id
        $coursesByType = $this->coursesRepository->getAllCoursesByType();


        $courseGroups = $this->coursesRepository->getCoursesGroupedByType(4);
        return view('home::index', compact('pageTitle', 'courseTypes', 'teachersWithCourses', 'coursesByType', 'courseGroups'));
    }
}