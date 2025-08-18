<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseTypeBadge extends Component
{
    public $type;
    public $class;

    public function __construct($type)
    {
        $this->type = $type;
        // Gọi helper để lấy CSS class
        $this->class = course_type_class_by_name($type);
    }

    public function render()
    {
        return view('components.course-type-badge');
    }
}
