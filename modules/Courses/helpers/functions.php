<?php 
if (!function_exists('getCategoriesCheckbox')) {

    function getCategoriesCheckbox($categories, $old=[], $parentId=0, $char='') {
        $id =request()->route()->category;
        if($categories) {
            foreach($categories as $key => $category) {
                if($category->parent_id == $parentId && $id!=$category->id) {
                    $checked = !empty($old) && in_array($category->id, $old) ? 'checked':null;
                    echo '<label class="d-block"><input type="checkbox" name="categories[]" value="'.$category->id.'" '.$checked.'/> ' .$char.$category->name.'</label>';
                    unset($categories[$key]);
                    getCategoriesCheckbox($categories, $old, $category->id, $char.' |- ');
                }
            }
        }
    }
}

function format_course_type($typeName) {
    switch ($typeName) {
        case 'Khóa học nền tảng':
            $class = 'badge-course-foundation';
            break;
        case 'Khóa học miễn phí':
            $class = 'badge-course-free';
            break;
        case 'Khóa học nổi bật':
            $class = 'badge-course-hot';
            break;
        case 'Khóa học chuyên sâu':
            $class = 'badge-course-advanced';
            break;
        case 'Khóa học mở rộng kỹ năng':
            $class = 'badge-course-skill';
            break;
        default:
            $class = 'badge-course-default';
    }
    return '<span class="badge-course '.$class.'">'.$typeName.'</span>';
}


