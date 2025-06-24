<?php

namespace Modules\Categories\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'group_id',
    ];

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories() {
        return $this->children()->with('subCategories');
    }

    public function courses() {
        $this->belongsToMany(Course::class, 'categories_courses');
    }
}
