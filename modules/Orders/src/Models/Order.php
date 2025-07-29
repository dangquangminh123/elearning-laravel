<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\src\Models\OrderDetail;
use Modules\Students\src\Models\Student;
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = ['student_id', 'total', 'payment_date', 'discount', 'coupon', 'status_id', 'payment_complete_date'];
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}