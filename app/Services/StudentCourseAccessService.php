<?php
namespace App\Services;

use Modules\Students\src\Models\Student;
use Modules\Courses\src\Models\Course;

class StudentCourseAccessService
{
    public function studentHasAccessToCourse(Student $student, Course $course): bool
    {
        $hasDirectAccess = $student->courses()
            ->where('courses.id', $course->id)
            ->exists();

        $hasPurchased = $student->orders()
            ->whereHas('detail', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })->exists();

        return $hasDirectAccess || $hasPurchased;
    }
}
