<?php

namespace Modules\Orders\src\Listeners;

use Modules\Orders\src\Events\OrderRefunded;
use App\Notifications\OrderRefundedNotification;

class SendOrderRefundedNotification
{
    public function __construct()
    {
        //
    }

    public function handle(OrderRefunded $event)
    {
        // Gửi thông báo cho học viên
        $event->order->student->notify(new OrderRefundedNotification($event->order));
    }
}
