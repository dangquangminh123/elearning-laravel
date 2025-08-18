<?php

namespace Modules\Courses\src\Models;
use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
class CourseType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
