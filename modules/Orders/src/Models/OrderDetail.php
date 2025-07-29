<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orders_detail';
    protected $with = ['order'];
    protected $fillable = ['order_id', 'course_id', 'price'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->withoutGlobalScopes();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}