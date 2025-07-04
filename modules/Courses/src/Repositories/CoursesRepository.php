<?php

namespace Modules\Courses\src\Repositories;
use App\Scopes\ActiveScope;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Courses\src\Models\Course;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses() {
        return $this->model->withoutGlobalScope(ActiveScope::class)->select(['id', 'name', 'code', 'price', 'status', 'sale_price', 'created_at'])->latest();
    }

    public function createCourseCategories($course, $data = []) {
        return $course->categories()->attach($data);
    }

    public function updateCourseCategories($course, $data = []) {
        return $course->categories()->sync($data);
    }

    public function deleteCourseCategories($course) {
        return $course->categories()->detach();
    }

    public function getRelatedCategories($course) {
        $categoryIds = $course->categories()->allRelatedIds()->toArray();
        return $categoryIds;
    }

    // Clients
    public function getCourses($limit)
    {
        return $this->model->limit($limit)->latest()->paginate($limit);
    }

    public function getCourse($id)
    {
        return $this->model->withoutGlobalScope(ActiveScope::class)->find($id);
    }


    public function deleteCourse($id)
    {
        return $this->model->withoutGlobalScope(ActiveScope::class)->where('id', $id)->delete();
    }

    public function updateCourse($id, $data = [])
    {
        $result = $this->getCourse($id);
        if ($result) {
            return $result->update($data);
        }
        return false;
    }

    public function getCourseActive($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }

}