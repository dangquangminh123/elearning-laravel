<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Yajra\DataTables\Contracts\DataTable;

class LessonController extends Controller
{
    protected $coursesRepository;
    protected $videoRepository;
    protected $documentRepository;
    protected $lessonRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository,
    VideoRepositoryInterface $videoRepository, DocumentRepositoryInterface $documentRepository, LessonsRepositoryInterface $lessonRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
        $this->documentRepository = $documentRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index($courseId) {
        $course = $this->coursesRepository->getCourse($courseId);

        $pageTitle = 'Bài giảng: ' . $course->name;
        return view('lessons::lists', compact('pageTitle', 'course'));
    }

    public function data($courseId) {
        $lessons = $this->lessonRepository->getLessons($courseId);
        $lessons = DataTables::of($lessons)->toArray();
        $lessons['data'] = $this->getLessonTable($lessons['data']);
        return $lessons;
    }


    public function getLessonTable($lessons, $char = '', &$result = [], $search = null)
    {
        if(!empty($lessons)) {
            foreach ($lessons as $key => $lesson) {
                // Chỉ add nếu không search hoặc tên phù hợp
                $row = $lesson;
                $row['name'] = $char . $row['name'];
                if($row['parent_id'] == null) {
                    $row['is_trial'] = '';
                    $row['view'] = '';
                    $row['durations'] = '';
                    $row['add'] = '<a href="'.route('admin.lessons.create', $row['course_id']).'?module='.$row['id'].'" 
                    class="btn btn-info btn-sm">Thêm bài</a>';
                    $row['edit'] = '<a href="'.route('admin.lessons.edit', $row['id']).'" class="btn btn-warning btn-sm">Sửa</a>';
                    $row['delete'] = '<a href="'.route('admin.lessons.delete', $row['id']).'" class="btn btn-danger btn-sm delete-action">Xoá</a>';
                } else {
                    $row['is_trial'] = ($row['is_trial'] == 1 ? 'Có' : 'Không');
                    $row['view'] = $row['view'];
                    $row['durations'] = getTime($row['durations']);
                    $row['add'] = '';
                    $row['edit'] = '<a href="'.route('admin.lessons.edit', $row['id']).'" class="btn btn-warning btn-sm">Sửa</a>';
                    $row['delete'] = '<a href="'.route('admin.lessons.delete', $row['id']).'" class="btn btn-danger btn-sm delete-action">Xoá</a>';
                }
              
                unset($row['sub_lessons']);
                unset($row['course_id']);
                unset($row['updated_at']);
                unset($row['created_at']);
                $result[] = $row;
                // Đệ quy sub_categories
                if (!empty($lesson['sub_lessons'])) {
                    $this->getLessonTable($lesson['sub_lessons'], $char . '|-- ', $result, $search);
                }
            }
        }

        return $result;
    }
    public function create(Request $request, $courseId) {
        $pageTitle = 'Thêm mới bài giảng';
        $position = $this->lessonRepository->getPosition($courseId);
        $lessons = $this->lessonRepository->getAllLessions($courseId);
        return view('lessons::add', compact('pageTitle', 'courseId', 'position', 'lessons'));
    }

     public function store($courseId, LessonRequest $request) {

        $name = $request->name;
        $slug = $request->slug;
        $video = $request->video;
        $document = $request->document;
        $parentId = $request->parent_id == 0 ? null : $request->parent_id;
        $isTrail = $request->is_trial;
        $position = $request->position;
        $description = $request->description;

        $videoId = null;
        $documentId = null;
        if($document) {
            $documentInfo = getFileInfo($document);
            $document = $this->documentRepository->createDocument([
                'name' => $documentInfo['name'], 
                'url' => $document, 
                'size' => $documentInfo['size']
            ], $document);
            $documentId = $document ? $document->id : null;
        }

        if($video) {
            $videoInfo = getVideoInfo($video);
            $video = $this->videoRepository->createVideo([
                'url' => $video, 
                'name' => $videoInfo['filename'], 
                'size' => $videoInfo['playtime_seconds']
            ], $video);
            $videoId = $video ? $video->id : null;
        }

        $this->lessonRepository->create([
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'course_id' => $courseId,
            'document_id' => $documentId,
            'parent_id' => $parentId,
            'is_trial' => $isTrail,
            'position' => $position,
            'durations' => $videoInfo['playtime_seconds'] ?? 0,
            'description' => $description,
        ]);
        $this->updateDurations($courseId);
        return redirect()->route('admin.lessons.create', $courseId)->with('msg',__('lessons::messages.create.success'));
    }


    public function edit(Request $request, $lessonId) {
        $pageTitle = 'Chỉnh sửa bài giảng';
        $position = 0;
        $lesson = $this->lessonRepository->find($lessonId);
        $lessons = $this->lessonRepository->getAllLessions($lesson->course_id);
        $lesson->video = $lesson->video?->url;
        $lesson->document = $lesson->document?->url;
        if(!$lesson){
            return abort(404);
        }
        $courseId = $lesson->course_id;
        return view('lessons::edit', compact('pageTitle', 'courseId', 'position', 'lessons', 'lesson'));
    }

    public function update(Request $request, $lessonId) {
        $lesson = $this->lessonRepository->find($lessonId);
        $lesson->video = $lesson->video->url;
        $lesson->document = $lesson->document?->url;

        $name = $request->name;
        $slug = $request->slug;
        $video = $request->video;
        $document = $request->document;
        $parentId = $request->parent_id == 0 ? null : $request->parent_id;
        $isTrail = $request->is_trial;
        $position = $request->position;
        $description = $request->description;
        $status = $request->status ?? 0;
        $videoId = null;
        $documentId = null;
        if($document) {
            $documentInfo = getFileInfo($document);
            $document = $this->documentRepository->createDocument([
                'name' => $documentInfo['name'], 
                'url' => $document, 
                'size' => $documentInfo['size']
            ], $document);
            $documentId = $document ? $document->id : null;
        }

        if($video) {
            $videoInfo = getVideoInfo($video);
            $video = $this->videoRepository->createVideo([
                'url' => $video, 
                'name' => $videoInfo['filename'], 
                'size' => $videoInfo['playtime_seconds']
            ], $video);
            $videoId = $video ? $video->id : null;
        }

        $this->lessonRepository->update($lessonId, [
            'name' => $name,
            'slug' => $slug,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'parent_id' => $parentId,
            'is_trial' => $isTrail,
            'position' => $position,
            'durations' => $videoInfo['playtime_seconds'] ?? 0,
            'description' => $description,
            'status' => $status,
        ]);
        $this->updateDurations($lesson->course_id);
        return redirect()->route('admin.lessons.edit', $lessonId)->with('msg',__('lessons::messages.update.success'));
    }

    public function delete(Request $request, $lessonId) {
        $lesson = $this->lessonRepository->find($lessonId);
        $this->lessonRepository->delete($lessonId);
        $this->updateDurations($lesson->course_id);
        return redirect()->route('admin.lessons.index', $lesson->course_id)->with('msg',__('lessons::messages.delete.success'));
    }

    public function sort(Request $request, $courseId) {
        $pageTitle = 'Chỉnh sửa bài giảng';
        $modules = $this->lessonRepository->getLessons($courseId)->with('children')->get();
        return view('lessons::sort', compact('pageTitle', 'courseId', 'modules'));
    }

    public function handleSort(Request $request, $courseId) {
        $lessons = $request->lesson;
        if($lessons) {
            foreach($lessons as $index => $lessonId) {
                $this->lessonRepository->update($lessonId, [
                    'position' => $index
                ]);
            }
            return redirect()->route('admin.lessons.sort', $courseId)->with('msg',__('lessons::messages.update.success'));
        }
    }

     private function updateDurations($courseId)
    {
        //Lấy tất cả bài học trong 1 khóa học
        $lessons = $this->lessonRepository->getAllLessions($courseId);

        //Tính tổng durations của các bài học trong 1 khóa học
        $durations = $lessons->reduce(function ($prev, $item) {
            return $prev + $item->durations;
        }, 0);

        //Cập nhật vào bảng courses
        $this->coursesRepository->updateCourse($courseId, [
            'durations' => $durations,
        ]);
    }

}