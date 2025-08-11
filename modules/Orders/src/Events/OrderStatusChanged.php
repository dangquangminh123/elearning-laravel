<?php

namespace Modules\Orders\src\Events;

use Modules\Orders\src\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged
{
    use Dispatchable, SerializesModels;

    public $order;
    public $oldStatusCode;
    public $newStatusCode;

    public function __construct(Order $order, string $oldStatusCode, string $newStatusCode)
    {
        $this->order = $order;
        $this->oldStatusCode = $oldStatusCode;
        $this->newStatusCode = $newStatusCode;
    }
}
