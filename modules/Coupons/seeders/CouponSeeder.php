<?php

namespace Modules\Coupons\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Modules\Coupons\src\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
      /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($index = 1; $index <= 10; $index++) {
            $coupon = new Coupon;
            $coupon->code = generateCoupon();
            $coupon->discount_type = rand(0, 1) ? 'percent' : 'value';
            if ($coupon->discount_type == 'percent') {
                $coupon->discount_value = rand(10, 40);
            } else {
                $coupon->discount_value = rand(100000, 300000);
            }
            $coupon->save();
        }
    }
}