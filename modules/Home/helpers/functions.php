<?php
use Illuminate\Support\Str;

function course_type_class_by_name(?string $typeName): string
{
    if (!$typeName) return 'badge-course-default';

    $key = Str::slug($typeName, '-'); // chuyển 'Khóa học nền tảng' -> 'khoa-hoc-nen-tang'
    $map = [
        'khoa-hoc-nen-tang'        => 'badge-course-foundation',
        'khoa-hoc-mien-phi'        => 'badge-course-free',
        'khoa-hoc-noi-bat'         => 'badge-course-hot',
        'khoa-hoc-chuyen-sau'      => 'badge-course-advanced',
        'khoa-hoc-mo-rong-ky-nang' => 'badge-course-skill',
    ];

    return $map[$key] ?? 'badge-course-default';
}



if (!function_exists('course_section_class_by_name')) {
    function course_section_class_by_name(?string $typeName): string
    {
        if (!$typeName) return 'default-course';

        $key = Str::slug($typeName, '-');
        $map = [
            'khoa-hoc-nen-tang'        => 'foundation-course',
            'khoa-hoc-mien-phi'        => 'free-course',
            'khoa-hoc-noi-bat'         => 'featured-course',
            'khoa-hoc-chuyen-sau'      => 'intensive-course',
            'khoa-hoc-mo-rong-ky-nang' => 'skill-extention',
        ];
        return $map[$key] ?? 'default-course';
    }
}