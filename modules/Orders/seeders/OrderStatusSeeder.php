<?php

namespace Modules\Orders\seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Orders\src\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Chờ thanh toán',
                'color' => 'warning',
                'code'  => 'pending_payment',
                'is_success' => false
            ],
            [
                'name' => 'Đã thanh toán',
                'color' => 'success',
                'code'  => 'paid',
                'is_success' => true
            ],
            [
                'name' => 'Thanh toán bất bại',
                'color' => 'danger',
                'code'  => 'failed_payment',
                'is_success' => false
            ],
            [
                'name' => 'Hủy thanh toán',
                'color' => 'secondary',
                'code'  => 'cancelled_payment',
                'is_success' => false
            ],
            [
                'name' => 'Hoàn trả hoàn tiền',
                'color' => 'info',
                'code'  => 'refunded',
                'is_success' => false,
            ]
        ];
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // OrderStatus::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        OrderStatus::insert($data);
    }
}