<?php

namespace Modules\Courses\seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Courses\src\Models\CourseType;
class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Khóa học nền tảng'],
            ['name' => 'Khóa học miễn phí'],
            ['name' => 'Khóa học nổi bật'],
            ['name' => 'Khóa học chuyên sâu'],
            ['name' => 'Khóa học mở rộng kỹ năng'],
        ];
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // OrderStatus::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        CourseType::insert($data);
    }
}