<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\RepositoryInterface;

interface OrdersRepositoryInterface extends RepositoryInterface
{
    public function getOrdersByStudent($studentId, $filters = [], $limit);
     public function createOrderWithDetails($studentId, array $cart);
    public function getOrder($orderId);
    public function updatePaymentDate($orderId);
    public function updateDiscount($orderId, $discount, $coupon);
    public function getOrderWithRelationsById($id);
    public function updatePaymentCompleteDate($orderId);
    public function setPendingIfFailed($orderId);
    public function updateStatus($orderId, $status);
    public function deleteOrdersByCouponCode($couponCode);
    public function studentPurchasedCourse($studentId, $courseId);
    public function getAllOrdersWithRelations($search = null);
    public function getCouponOrder($orderId);
    public function getStatusBadge($order);

    public function getAvailableTransitions($order);
    public function changeStatus($orderId, $statusId);

}