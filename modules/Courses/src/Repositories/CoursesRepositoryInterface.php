<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CoursesRepositoryInterface extends RepositoryInterface
{
    public function getAllCourses();
    public function getAllTypeCourses();

    public function getAllCoursesByType();
    public function createCourseCategories($course, $data = []);
    public function updateCourseCategories($course, $data = []);
    public function deleteCourseCategories($course);
    public function getRelatedCategories($course);

    public function getCourses($limit);
    public function getCourse($id);

    public function deleteCourse($id);
    public function updateCourse($id, $data = []);
    public function getCourseActive($slug);
     public function studentOwnsCourse(int $studentId, int $courseId);
    public function getCoursesGroupedByType($limit);
}