<?php

namespace Modules\Students\src\Services;

use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
use Illuminate\Support\Facades\DB;
class StudentCourseService
{
    protected $orderRepository;
    protected $couponRepository;

    public function __construct(OrdersRepositoryInterface $orderRepository, CouponsRepositoryInterface $couponRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->couponRepository = $couponRepository;
    }

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

         // Lấy mảng course_id từ repository
        $courseIds = $this->orderRepository->getCourseIdsByOrderId($orderId);

        if (!empty($courseIds)) {
            $student->courses()->detach($courseIds);
        }

         // 2. Xoá toàn bộ dữ liệu trong bảng coupons_usage
        $this->couponRepository->deleteCouponUsageByOrderId($orderId);

    }

}
