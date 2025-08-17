<?php 
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaidNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Thanh toán đơn hàng thành công')
            ->line('Bạn vừa thanh toán thành công đơn hàng #' . $this->order->id)
            ->line('Unicode xin chân thành cảm ơn bạn đã tin tưởng và muốn trải nghiệm khoá học ở chúng tôi!')
            ->action('Xem khoá học của bạn', route('students.account.courses'))
            ->line('Chúc bạn học tập hiệu quả và thành công!');
    }
}
