<?php

namespace Modules\Orders\src\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\src\Models\Order;

class AutoCancelOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $orderId;

    /**
     * Create a new job instance.
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

     public function handle()
    {
        $order = Order::find($this->orderId);

        // Nếu đơn hàng không tồn tại -> bỏ qua
        if (!$order) {
            return;
        }

        // Nếu đơn hàng đã thanh toán -> bỏ qua
        if ($order->status_id == 2) { // 2 = Đã thanh toán
            return;
        }

        // Nếu trạng thái không phải chờ thanh toán hoặc thanh toán thất bại -> bỏ qua
        if (!in_array($order->status_id, [1, 3])) {
            return;
        }

        // Nếu đã quá 24 giờ kể từ payment_date (hoặc created_at nếu chưa có payment_date)
        $startTime = $order->payment_date ?? $order->created_at;
        if (Carbon::parse($startTime)->addHours(24)->isPast()) {
            $order->update([
                'status_id' => 4 // 4 = Hủy thanh toán
            ]);
        }
    }
    
}
