<?php

namespace Modules\Students\src\Services;

use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudentCourseService
{
    protected $orderRepository;

    public function __construct(OrdersRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Gắn khoá học vào học viên khi thanh toán thành công
     */
    public function attachCoursesToStudent(int $orderId)
    {
        $order = $this->orderRepository->getOrderWithRelationsById($orderId);
        $student = $order->student;
        if (!$student) return;

        $details = $order->detail;
        if ($details->isEmpty()) return;

        $now = now();
        $attachData = [];
        foreach ($details as $d) {
            if ($d->course_id) {
                $attachData[$d->course_id] = [
                    'status'     => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        $student->courses()->syncWithoutDetaching($attachData);

        foreach (array_keys($attachData) as $courseId) {
            $student->courses()->updateExistingPivot($courseId, [
                'status' => 1,
                'updated_at' => $now,
            ]);
        }
    }

    public function removeCoursesStudent(int $orderId)
    {
        $order = $this->orderRepository->getOrderWithRelationsById($orderId);
        $student = $order->student;
        if (!$student) return;

        foreach ($order->detail as $d) {
            if ($d->course_id) {
                $student->courses()->detach($d->course_id);
            }
        }

         // 2. Xoá toàn bộ dữ liệu trong bảng coupons_usage
        DB::table('coupons_usage')
            ->where('order_id', $orderId)
            ->delete();
    }

}
