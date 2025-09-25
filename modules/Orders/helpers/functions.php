<?php

use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
if (!function_exists('get_coupon_discount_info')) {
    function get_coupon_discount_info($orderId) {
        $ordersRepo = app(OrdersRepositoryInterface::class);
        $order = $ordersRepo->getCouponOrder($orderId);
        $couponCode = $order->coupon;
        $coupon = app(CouponsRepositoryInterface::class)->getCouponByCode($couponCode);

        if (!$coupon) return ['amount' => 0, 'formatted' => '0đ'];

        $amount = calculate_discount_amount($order->total, $coupon->discount_value, $coupon->discount_type);
        $formatted = format_currency($amount);

        return ['amount' => $amount, 'formatted' => $formatted];
    }
}

function get_coupon_type($orderId) {
    $ordersRepo = app(OrdersRepositoryInterface::class);
    $order = $ordersRepo->getCouponOrder($orderId);
    $couponCode = $order->coupon;

    $coupon = app(CouponsRepositoryInterface::class)->getCouponByCode($couponCode);

    if (!$coupon) return 'Không có';

    return $coupon->discount_type === 'percent' ? 'Phần trăm' : 'Tiền mặt';
}


if (!function_exists('format_currency')) {
    function format_currency($number)
    {
        return number_format($number, 0, ',', '.') . 'đ';
    }
}

if (!function_exists('render_status_badge')) {
    function render_status_badge($status)
    {
        $name  = $status['name'] ?? '(Không rõ)';
        $color = $status['color'] ?? '#6c757d'; 

        return '<span class="badge bg-' . e($color) . '">' 
                . e($name) . 
               '</span>';
    }
}



if (!function_exists('format_discount_value')) {
    function format_discount_value($value, $type)
    {
        return $type === 'percent' ? $value . '%' : format_currency($value);
    }
}

if (!function_exists('calculate_discount_amount')) {
    function calculate_discount_amount($total, $value, $type)
    {
        if ($type === 'percent') {
            return ($total * $value) / 100;
        }
        return $value;
    }
}
