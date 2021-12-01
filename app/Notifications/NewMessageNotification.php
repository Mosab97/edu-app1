<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\ChatMessage;
use App\Models\Group;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $order;
    private $message;

    public function __construct(Group $order, ChatMessage $chatMessage = null)
    {
        $this->order = $order;
        $date = Carbon::now();
        $date_formatted = $date->format(DATE_FORMAT_DOTTED);
        $time_formatted = $date->format(TIME_FORMAT_WITHOUT_SECONDS);
        $this->message = [
            'title' => [
                'ar' => notification_trans("New Message from", ['user' => apiUser()->name], 'ar'),
                'en' => notification_trans("New Message from", ['user' => apiUser()->name], 'en'),
            ],
            'body' => [
                'ar' => optional($chatMessage)->message,
                'en' => optional($chatMessage)->message,
            ],
            'image' => $chatMessage->image,
            'others' => [
                'type' => NEW_CHAT_MESSAGE,
                'date' => days(getDayNumber(Carbon::now()->dayOfWeek)) . ' | ' . $date_formatted . ' | ' . $time_formatted,
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
//        $notifiable->setLanguage();
        send_to_topic('user_' . $notifiable->id, $this->message, 'chat');

    }
}
