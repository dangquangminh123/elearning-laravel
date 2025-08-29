<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail']; // Hoặc thêm database, slack...
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Đơn hàng của bạn đã bị huỷ hoặc đang được xử lý để hoàn trả lại cho bạn')
            ->line('Đơn hàng #' . $this->order->id . ' đã được huỷ (hoặc đã được hoàn trả ) vào ngày ' . now()->format('d/m/Y H:i'))
            ->action('Xem chi tiết các đơn hàng', route('students.account.order-detail', $this->order->id));
    }
}
