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

if (!function_exists('course_type_class')) {
    function course_type_class($typeName)
    {
        $map = [
            'Khóa học nền tảng'       => 'course-type-nen-tang',
            'Khóa học miễn phí'       => 'course-type-mien-phi',
            'Khóa học nổi bật'        => 'course-type-noi-bat',
            'Khóa học chuyên sâu'     => 'course-type-chuyen-sau',
            'Khóa học mở rộng kỹ năng'=> 'course-type-mo-rong',
        ];

        return $map[$typeName] ?? '';
    }
}