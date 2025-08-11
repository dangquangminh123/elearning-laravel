<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Models\OrderStatus;
use Carbon\Carbon;

class AutoCancelPendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:auto-cancel';
   
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động hủy đơn hàng quá hạn thanh toán (24h)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Lấy ID trạng thái để so sánh
        $pendingId = OrderStatus::where('code', 'pending_payment')->value('id');
        $failedId  = OrderStatus::where('code', 'failed_payment')->value('id');
        $cancelledId = OrderStatus::where('code', 'cancelled_payment')->value('id');

        $orders = Order::whereIn('status_id', [$pendingId, $failedId])
            ->whereNotNull('payment_date')
            ->where('payment_date', '<=', $now->subHours(24))
            ->get();

        foreach ($orders as $order) {
            $order->status_id = $cancelledId;
            $order->save();
            $this->info("Đơn hàng #{$order->id} đã bị hủy tự động");
        }

        $this->info('Đã xử lý xong các đơn hàng quá hạn.');
        return Command::SUCCESS;
    }
}
