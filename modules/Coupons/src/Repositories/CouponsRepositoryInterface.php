<?php

namespace Modules\Coupons\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CouponsRepositoryInterface extends RepositoryInterface
{
    public function verifyCoupon($code, $odderId);
     public function getCoupon($couponId);
    public function isCourseCoupon($coupon);
    public function getCourses($coupon, $orderId);
    public function createCouponStudents($coupon, $data = []);
    public function createCouponCourse($coupon, $data = []);
    public function getAllCoupons();
    public function deleteCouponRelations($coupon);

    public function getStudentsCoupon($coupon);
    public function getCourseCoupon($coupon);
    public function couponUsage($couponCode, $orderId);
    public function updateCouponStudents($coupon, $data = []);
    public function updateCouponCourse($coupon, $data = []);
    public function updateCoupon($id, $data = []);

     public function getCouponByCode($code);
}