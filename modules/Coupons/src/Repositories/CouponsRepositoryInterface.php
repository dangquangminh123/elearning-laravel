<?php

namespace Modules\Coupons\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CouponsRepositoryInterface extends RepositoryInterface
{
    public function verifyCoupon($code, $odderId);
    public function isCourseCoupon($coupon);
    public function getCourses($coupon, $orderId);
    public function createCouponStudents($coupon, $data = []);
    public function createCouponCourse($coupon, $data = []);
}