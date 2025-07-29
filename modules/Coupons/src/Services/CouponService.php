<?php

namespace Modules\Coupons\src\Services;

use Modules\Coupons\src\Repositories\CouponsRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CouponService
{
    protected $couponRepo;
    protected $orderRepo;

    public function __construct(
        CouponsRepositoryInterface $couponRepo,
        OrdersRepositoryInterface $orderRepo
    ) {
        $this->couponRepo = $couponRepo;
        $this->orderRepo = $orderRepo;
    }

    public function deleteCouponWithRelations($couponId)
    {
        DB::beginTransaction();
        try {
            $coupon = $this->couponRepo->getCoupon($couponId);
            if (!$coupon) {
                DB::rollBack();
                return __('coupons::messages.not_found');
            }

            // B1: Xoá đơn hàng
            $ordersDeleted = $this->orderRepo->deleteOrdersByCouponCode($coupon->code);
            if (!$ordersDeleted) {
                DB::rollBack();
                return __('coupons::messages.orders.failure');
            }

            // B2: Xoá liên kết
            $relationsDeleted = $this->couponRepo->deleteCouponRelations($coupon);
            if (!$relationsDeleted) {
                DB::rollBack();
                return __('coupons::messages.delete.relations.failure');
            }

            // B3: Xoá mã giảm giá
            $coupon->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return __('coupons::messages.delete.failure');
        }
    }
}
