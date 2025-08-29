<?php
use Illuminate\Support\Str;

function course_type_class_by_name($typeName)
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

if (!function_exists('course_type_key')) {
    function course_type_key(?string $typeName): string
    {
        if (!$typeName) return '';
        // Str::ascii để chuyển ký tự dấu sang ascii, rồi slug -> chuẩn hoá
        return Str::slug(Str::ascii(trim($typeName)), '-');
    }
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

if (!function_exists('course_type_icon')) {
    function course_type_icon($typeName)
    {
        $map = [
            'khoa-hoc-nen-tang'         => '<i class="fa-solid fa-seedling" aria-hidden="true"></i>',
            'khoa-hoc-mien-phi'         => '<i class="fa-solid fa-gift" aria-hidden="true"></i>',
            'khoa-hoc-noi-bat'          => '<i class="fa-solid fa-fire" aria-hidden="true"></i>',
            'khoa-hoc-chuyen-sau'       => '<i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>',
            'khoa-hoc-mo-rong-ky-nang'  => '<i class="fa-solid fa-layer-group" aria-hidden="true"></i>',
        ];
        $key = course_type_key($typeName);
        return $map[$key] ?? '<i class="fa-solid fa-circle-question" aria-hidden="true"></i>';
    }
}


if (!function_exists('course_type_class')) {
    function course_type_class($typeName)
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
}