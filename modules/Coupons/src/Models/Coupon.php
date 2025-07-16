<?php

namespace Modules\Coupons\src\Models;
use Modules\Orders\src\Models\Order;
use Modules\Courses\src\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\src\Models\Student;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'total_condition',
        'count',
        'start_date',
        'end_date',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'coupons_students', 'coupon_id', 'student_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'coupons_courses', 'coupon_id', 'course_id')->withoutGlobalScopes();
    }

    public function usages()
    {
        return $this->belongsToMany(Order::class, 'coupons_usage', 'coupon_id', 'order_id');
    }
}