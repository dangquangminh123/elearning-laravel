<?php

namespace Modules\Courses\src\Http\Controllers\Clients;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Iman\Streamer\VideoStreamer;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CoursesController extends Controller {
    protected $coursesRepository;
    protected $lessonRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepositoryInterface $lessonRepository) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository = $lessonRepository;
    }
    
    public function index() {
        $pageTitle = 'Khóa học';
        $pageName = 'Khóa học';
        $courses = $this->coursesRepository->getCourses(config('paginate.limit'));

        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
    }

    public function detail($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            abort(404);
        }
        $pageTitle = $course->name;
        $pageName = $course->name;
        $index = 0;
        return view('courses::clients.detail', compact('pageTitle', 'pageName', 'course', 'index'));
    }

    public function getTrialVideo($lessonId = 0)
    {
        $lesson = $this->lessonRepository->find($lessonId);
        if (!$lesson) {
            return ['success' => false];
        }
        return ['success' => true, 'data' => $lesson];
    }

    public function streamVideo(Request $request)
    {
        $videoPath = $request->video;
        $path = public_path($videoPath);
        VideoStreamer::streamFile($path);
    }
}