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
            ->orderBy('position', 'asc'); // Bắt buộc phải toArray để xử lý phân cấp
    }

     public function getAllLessons() {
        return $this->getAll();
    }
}