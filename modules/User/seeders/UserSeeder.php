<?php

namespace Modules\User\seeders;

use Faker\Factory;
use Modules\User\src\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        // for($index = 1; $index <= 30; $index++) {
            $user = new User();
            $user->name = 'Hoàng An';
            $user->email = 'hoangan@gmail.com';
            $user->password = Hash::make('123456');
            $user->group_id = 1;
            $user->save();
        // }
       
    }
}
