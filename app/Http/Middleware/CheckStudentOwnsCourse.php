<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Modules\Courses\src\Models\Course;
use Modules\Students\src\Models\Student;

use App\Services\StudentCourseAccessService;
class CheckStudentOwnsCourse
{
    protected $accessService;

    public function __construct(StudentCourseAccessService $accessService)
    {
        $this->accessService = $accessService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = auth('students')->user();

        //B1 kiểm tra students đăng nhập chưa
        if (!auth('students')->check()) {
            return redirect()->route('clients.login')->with('msg', 'Vui lòng đăng nhập để tiếp tục.');
        }
        $slug = $request->route('slug');

        $course = Course::where('slug', $slug)->first();

        if (!$course) {
            return redirect()->route('courses.index')->with('msg', 'Khoá học không tồn tại.');
        }

        if (!$this->accessService->studentHasAccessToCourse($student, $course)) {
            return redirect()->route('courses.index')->with('msg', 'Bạn chưa sở hữu khoá học này.');
        }

        return $next($request);
    }
}
