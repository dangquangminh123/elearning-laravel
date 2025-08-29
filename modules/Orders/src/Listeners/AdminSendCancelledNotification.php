<?php 

namespace Modules\Orders\src\Listeners;

use Modules\Orders\src\Events\AdminOrderCancel;
use App\Notifications\AdminOrderCancelledNotification;

class AdminSendCancelledNotification
{
    public function __construct()
    {
        //
    }

    public function handle(AdminOrderCancel $event)
    {
        // Gửi thông báo cho học viên
        $event->order->student->notify(new AdminOrderCancelledNotification($event->order));
    }
}
