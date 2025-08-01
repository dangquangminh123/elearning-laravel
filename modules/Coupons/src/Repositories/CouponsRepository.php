<?php

namespace Modules\Coupons\src\Repositories;
use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Modules\Coupons\src\Models\Coupon;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;

class CouponsRepository extends BaseRepository implements CouponsRepositoryInterface
{
    public function getModel()
    {
        return Coupon::class;
    }

    public function createCouponStudents($coupon, $data = []) {
        return $coupon->students()->attach($data);
    }
    public function createCouponCourse($coupon, $data = []) {
        return $coupon->courses()->attach($data);
    }

    public function getCoupon($couponId)
    {
        return $this->model->find($couponId);
    }

    public function getStudentsCoupon($coupon) {
        $studentIds = $coupon->students()->allRelatedIds()->toArray();
        return $studentIds;
    }


    public function getCourseCoupon($coupon) {
        $courseIds = $coupon->courses()->allRelatedIds()->toArray();
        return $courseIds;
    }

    public function updateCouponStudents($coupon, $data = []) {
        return $coupon->students()->sync($data);
    }

    public function updateCouponCourse($coupon, $data = []) {
        return $coupon->courses()->sync($data);
    }

    public function updateCoupon($id, $data = [])
    {
        $result = $this->getCoupon($id);
        if ($result) {
            return $result->update($data);
        }
        return false;
    }
   

   public function deleteCouponRelations($coupon)
    {
        try {
            $coupon->students()->detach();
            $coupon->courses()->detach();
            $coupon->usages()->detach();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function couponUsage($couponCode, $orderId)
    {
        $coupon = $this->model->where('code', $couponCode)->first();

        if (!$coupon) {
            return false;
        }

        // Nếu đã ghi nhận rồi thì không ghi lại
        if ($coupon->usages()->where('order_id', $orderId)->exists()) {
            return false;
        }

        $coupon->usages()->attach($orderId);
        return true;
    }

    public function verifyCoupon($code, $orderId)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $coupon = $this->model->whereCode($code)->first();
        if (!$coupon) {
            return false;
        }
        
        //Kiểm tra số lần sử dụng
        // - Kiểm tra xem coupon đó có giới hạn số lần sử dụng không?
        // - Nếu không --> bỏ qua
        // - Nếu có --> Kiểm tra coupons_usage
        if ($coupon->count && $coupon->usages->count() >= $coupon->count) {
            return false;
        }

        $students = $coupon->students;
        if ($students->count() && !$students->find(Auth::guard('students')->user()->id)) {
            return false;
        }
        $courses = $coupon->courses();

        if ($courses->count()) {
            $count = $courses->whereHas('orderDetail', function ($query) use ($orderId) {
                $query->where('order_id', $orderId);
            })->count();
            if (!$count) {
                return false;
            }
        }
        $startStatus = true;
        $endStatus = true;
        // Chưa bắt đầu
        if ($coupon->start_date && $now < $coupon->start_date) {
            $startStatus = false;
        }

        // Đã quá hạn
        if ($coupon->end_date && $now > $coupon->end_date) {
            $endStatus = false;
        }

        return $startStatus && $endStatus ? $coupon : false;
    }

    public function isCourseCoupon($coupon)
    {
        return $coupon->courses()->count() > 0;
    }
    public function getCourses($coupon, $orderId)
    {
        $courses = $coupon->courses()->whereHas('orderDetail', function ($query) use ($orderId) {
            $query->where('order_id', $orderId);
        })->get();
        return $courses;
    }

    public function getAllCoupons() {
        return $this->model->select(['id', 'code', 'discount_type', 'discount_value', 'total_condition', 'count', 'start_date', 'end_date'])->latest();
    }

}