<?php

namespace Modules\Courses\src\Http\Controllers\Clients;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Iman\Streamer\VideoStreamer;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Services\StudentCourseAccessService;

class CoursesController extends Controller {
    protected $coursesRepository;
    protected $lessonRepository;
    protected $accessService;

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepositoryInterface $lessonRepository, 
    StudentCourseAccessService $accessService) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository = $lessonRepository;
        $this->accessService = $accessService;
    }
    
    public function index(StudentCourseAccessService $accessService) {
        $pageTitle = __('courses::messages.titlePage');
        $pageName = __('courses::messages.titlePage');
        $courses = $this->coursesRepository->getCourses(config('paginate.limit'));
        $hasAccessList = [];

        if (auth('students')->check()) {
            $student = auth('students')->user();
            foreach ($courses as $course) {
                $hasAccessList[$course->id] = $accessService->studentHasAccessToCourse($student, $course->slug); // truyền slug
            }
        }
        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses', 'hasAccessList'));
    }

    public function detail($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            return view('errors.404', [
                'message' => __('courses::messages.courseNotExits'),
                'pageTitle' => __('courses::messages.notFound'),
            ]);
        }
        $pageTitle = $course->name;
        $pageName = $course->name;
        $index = 0;
        $student = auth('students')->user();
        $courseStatus = $this->accessService->getStudentCourseStatus($student, $slug);

        // dd($course);
        return view('courses::clients.detail', compact('pageTitle', 'pageName', 'course', 'index', 'courseStatus'));
    }

    public function learn($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            return view('errors.404', [
                'message' => __('courses::messages.courseNotExits'),
                'pageTitle' => __('courses::messages.notFound'),
            ]);
        }

        $lessonGroups = $this->lessonRepository->getLessonsGroup($course->id);
       
        $firstLesson = $lessonGroups->first()['lessons']->first();


        $pageTitle = 'Học - ' . $course->name;
        $pageName = $course->name;

        return view('courses::clients.learn', [
            'course' => $course,
            'lessonGroups' => $lessonGroups,
            'firstLesson' => $firstLesson,
            'pageTitle' =>  $pageTitle,
            'pageName' => $pageName,
        ]);
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

    public function lessonVideo(Request $request)
    {
        $lessonId = $request->get('lesson_id');

        $lesson = $this->lessonRepository->findLessonWithVideo($lessonId);

        if (!$lesson->video) {
            abort(404, __('courses::messages.lessonNotfound'));
        }

        return VideoStreamer::streamFile(public_path($lesson->video->url));
    }
}