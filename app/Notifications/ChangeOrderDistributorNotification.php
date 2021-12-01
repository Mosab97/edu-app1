<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ChangeOrderDistributorNotification extends Notification
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
                'ar' => notification_trans("Order Assigned To Another Distributor", ['order_id' => $order->id], 'ar'),
                'en' => notification_trans("Order Assigned To Another Distributor", ['order_id' => $order->id], 'en'),
            ],
            'body' => [
                'ar' => notification_trans("Order Assigned To Another Distributor", ['order_id' => $order->id], 'ar'),
                'en' => notification_trans("Order Assigned To Another Distributor", ['order_id' => $order->id], 'en'),
            ],
            'click_action' => "order_details_activity",
            'others' => [
                'type' => CHANGE_ORDER_DISTRIBUTOR_NOTIFICATION,
                'date' => $date_formatted . ' | ' . $time_formatted,
                "order_id" => $this->order->id,
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
        if ($notifiable instanceof User) {
            $notifiable->setLanguage();
            send_to_topic('user_' . $notifiable->id, $this->message);
        }
    }
}
