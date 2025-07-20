<?php
function generateCoupon()
{
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $res = "";
    for ($i = 0; $i < 10; $i++) {
        $res .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $res;
}


function format_discount_type($type)
{
    if ($type === 'percent') {
        return '<span class="badge bg-success">Phần trăm</span>';
    } else {
        return '<span class="badge bg-warning text-dark">Số tiền</span>';
    }
}

function format_discount_value($type, $value)
{
    if ($type === 'percent') {
        return '<span class="badge bg-success">' . $value . '%</span>';
    } else {
        return '<span class="badge bg-warning text-dark">' . number_format($value) . ' đ</span>';
    }
}

function format_coupon_count($count)
    {
        if ($count > 0) {
            return '<span class="badge bg-success-subtle text-success fs-6">' . $count . ' lượt</span>';
        } else {
            return '<span class="badge bg-secondary text-danger">Không giới hạn</span>';
        }
    }

function format_coupon_start_date($date)
{
    if ($date) {
        return '<span class="badge bg-primary">' . \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s') . '</span>';
    } else {
        return '<span class="badge bg-secondary">Không xác định</span>';
    }
}

function format_coupon_end_date($date)
{
    if ($date) {
        return '<span class="badge bg-danger">' . \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s') . '</span>';
    } else {
        return '<span class="badge bg-secondary">Không xác định</span>';
    }
}

