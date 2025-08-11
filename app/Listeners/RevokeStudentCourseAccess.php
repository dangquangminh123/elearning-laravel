<?php

namespace Modules\Courses\src\Listeners;

use Modules\Orders\src\Events\OrderStatusChanged;
use Illuminate\Support\Facades\DB;

class RevokeStudentCourseAccess
{
    public function handle(OrderStatusChanged $event)
    {
        if (in_array($event->newStatusCode, ['refunded', 'cancelled_payment'])) {
            $studentId = $event->order->student_id;

            foreach ($event->order->detail as $detail) {
                DB::table('students_courses')
                    ->where('student_id', $studentId)
                    ->where('course_id', $detail->course_id)
                    ->delete();
            }
        }
    }
}
