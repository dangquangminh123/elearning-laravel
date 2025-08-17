<?php 
namespace Modules\Orders\src\Listeners;

use Modules\Orders\src\Events\OrderPaid;
use App\Notifications\OrderPaidNotification;

class SendOrderPaidNotification
{
    public function handle(OrderPaid $event)
    {
        $event->order->student->notify(new OrderPaidNotification($event->order));
    }
}
