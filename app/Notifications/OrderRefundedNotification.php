<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderRefundedNotification extends Notification implements ShouldQueue
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
            ->subject('Bạn đã gửi hoàn trả đơn hàng thành công')
            ->line('Bạn vừa muốn huỷ bỏ hoàn trả đơn hàng này ở cửa hàng chúng tôi!')
            ->line('Hy vọng tương lai bạn sẽ tiếp tục quay lại cửa hàng chúng tôi!')
            ->line('Nếu sản phẩm có làm bạn không hài lòng bạn có thể thử sản phẩm khác của chúng tôi!')
            ->action('Xem chi tiết các đơn hàng', route('students.account.order-detail', $this->order->id))
            ->line('Cảm ơn bạn đã tin tưởng cửa hàng của chúng tôi!');
    }
}
