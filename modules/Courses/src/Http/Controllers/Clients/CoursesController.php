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

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepositoryInterface $lessonRepository) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository = $lessonRepository;
    }
    
    public function index(StudentCourseAccessService $accessService) {
        $pageTitle = 'Khóa học';
        $pageName = 'Khóa học';
        $courses = $this->coursesRepository->getCourses(config('paginate.limit'));
        $hasAccessList = [];

        if (auth('students')->check()) {
            $student = auth('students')->user();

            foreach ($courses as $course) {
                $hasAccessList[$course->id] = $accessService->studentHasAccessToCourse($student, $course);
            }
        }
        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses', 'hasAccessList'));

        // return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
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
        // dd($course);
        return view('courses::clients.detail', compact('pageTitle', 'pageName', 'course', 'index'));
    }

    public function learn($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            abort(404);
        }

        $lessonGroups = $this->lessonRepository->getLessonsGroup($course->id);
       
        $firstLesson = $lessonGroups->first()['lessons']->first(); // Phần bài học con đầu tiên để hiển thị


        $pageTitle = 'Học - ' . $course->name;
        $pageName = $course->name;

        return view('courses::clients.learn', [
            'course' => $course,
            'lessonGroups' => $lessonGroups,
            'firstLesson' => $firstLesson,
            'pageTitle' => 'Học - ' . $course->name,
            'pageName' => $course->name,
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
            abort(404, 'Không tìm thấy video cho bài học này.');
        }

        return VideoStreamer::streamFile(public_path($lesson->video->url));
    }
}