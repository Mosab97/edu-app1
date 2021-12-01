<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DistributorCancelOrderNotification extends Notification
{
    use Queueable;

    public $order;
    private $message;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $date = Carbon::now();
        $date_formatted = $date->format(DATE_FORMAT_DOTTED);
        $time_formatted = $date->format(TIME_FORMAT_WITHOUT_SECONDS);
        $this->message = [
            'title' => [
                'ar' => notification_trans('Distributor Cancel Order', [], 'ar'),
                'en' => notification_trans('Distributor Cancel Order', [], 'en'),
            ],
            'body' => [
                'ar' => notification_trans('Your order Canceled by Distributor', [], 'ar'),
                'en' => notification_trans('Your order Canceled by Distributor', [], 'en'),
            ],
            'click_action' => "order_details_activity",
            'others' => [
                'type' => DISTRIBUTOR_CANCELED_ORDER_NOTIFICATION,
                'date' => days(getDayNumber(Carbon::now()->dayOfWeek)) . ' | ' . $date_formatted . ' | ' . $time_formatted,
                "order_id" => $this->order->id,
                "uuid" => $this->order->uuid,
            ],
        ];


    }

    public function via($notifiable)
    {
        return ['database', FcmChannel::class];
    }


    public function toDatabase($notifiable)
    {
        return $this->message;
    }

    public function toFcm($notifiable)
    {
        $notifiable->setLanguage();
        send_to_topic('user_' . $notifiable->id, $this->message);

    }
}
