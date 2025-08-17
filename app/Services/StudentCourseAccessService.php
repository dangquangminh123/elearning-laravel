<?php
namespace App\Services;

use Modules\Students\src\Models\Student;
use Modules\Courses\src\Models\Course;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class StudentCourseAccessService
{
    protected $ordersRepository;
    protected $coursesRepository;

    public function __construct( OrdersRepositoryInterface $ordersRepository, CoursesRepositoryInterface $coursesRepository) 
    {
        $this->ordersRepository = $ordersRepository;
        $this->coursesRepository = $coursesRepository;
    }

    
    public function studentHasAccessToCourse(Student $student, string $slug): bool
    {
        $course = $this->coursesRepository->getCourseActive($slug);

        if (!$course) return false;

        $hasDirectAccess = $this->coursesRepository->studentOwnsCourse($student->id, $course->id, 1);

        $hasPurchased = $this->ordersRepository->studentPurchasedCourse($student->id, $course->id);

        return $hasDirectAccess || $hasPurchased;
    }

    public function getStudentCourseStatus(?Student $student, string $slug): string
    {
        if (!$student) {
            return 'guest';
        }

        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            return 'not_found';
        }

        $hasDirectAccess = $this->coursesRepository->studentOwnsCourse($student->id, $course->id);
        $hasPurchased = $this->ordersRepository->studentPurchasedCourse($student->id, $course->id);

        if ($hasDirectAccess || $hasPurchased) {
            return 'owned';
        }

        return 'not_owned';
    }

    public function getCourseBySlug(string $slug): ?Course
    {
        return $this->coursesRepository->getCourseActive($slug);
    }
}
