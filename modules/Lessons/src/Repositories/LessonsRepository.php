<?php

namespace Modules\Lessons\src\Repositories;

use Modules\Lessons\src\Models\Lesson;
use App\Repositories\BaseRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

class LessonsRepository extends BaseRepository implements LessonsRepositoryInterface
{
    public function getModel()
    {
        return Lesson::class;
    }

    public function getPosition($courseId) {
        $result = $this->model->where('course_id', $courseId)->count();
        return $result + 1;
    }

    public function getLessons($courseId)
    {
        return $this->model
            ->with('subLessons')
            ->whereCourseId($courseId)
            ->whereNull('parent_id')
            ->select(['id', 'name', 'slug', 'is_trial', 'parent_id', 'view', 'durations', 'course_id'])
           ->position();
    }

    public function getAllLessions($courseId)
    {
        return $this->model->where('course_id', $courseId)->get();
    }

    public function getLessonCount($course)
    {
        return (object) [
            'module' => $course->lessons()->whereNull('parent_id')->count(),
            'lessons' => $course->lessons()->whereNotNull('parent_id')->count(),
        ];
    }

     public function getModuleByPosition($course)
    {
        return $course->lessons()->active()->whereNull('parent_id')->position()->get();
    }

    public function getLessonsByPosition($course, $moduleId = null, $isDocument = false)
    {
        $query = $course->lessons()->active();
        if ($moduleId) {
            $query->where('parent_id', $moduleId);
        } else {
            $query->whereNotNull('parent_id');
        }
        if ($isDocument) {
            $query->whereNotNull('document_id');
        }
        return $query->position()->get();

    }

    public function getLesssonActive($slug)
    {
        return $this->model->whereSlug($slug)->active()->first();
    }


    public function getLessonsGroup($courseId)
    {
        $lessons = $this->model
            ->with(['video']) // eager load video
            ->where('course_id', $courseId)
            ->active()
            ->position()
            ->get();

        $sections = $lessons->whereNull('parent_id');
        $grouped = [];

        foreach ($sections as $section) {
            $children = $lessons->where('parent_id', $section->id)->map(function ($lesson) {
                // Format duration thành phút:giây (mm:ss)
                $lesson->formatted_duration = gmdate("H:i:s", $lesson->durations ?: 0);
                return $lesson;
            });

            $grouped[] = [
                'section' => $section,
                'lessons' => $children->values(),
            ];
        }

        return collect($grouped);
    }



    public function findLessonWithVideo($lessonId)
    {
        return $this->model->with('video')->active()->find($lessonId);
    }
}