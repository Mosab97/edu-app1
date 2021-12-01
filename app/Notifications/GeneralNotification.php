<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    public function __construct($title, $body)
    {
        $date = Carbon::now();
        $date_formatted = $date->format(DATE_FORMAT_DOTTED);
        $time_formatted = $date->format(TIME_FORMAT_WITHOUT_SECONDS);
        $this->message = [
            'title' => $title,
            'body' => $body,
            'others' => [
                'type' => GENERAL_NOTIFICATION,
                'date' => days(getDayNumber(Carbon::now()->dayOfWeek)) . ' | ' . $date_formatted . ' | ' . $time_formatted,
//                'type_name' => getNotificationTypeName(GENERAL_NOTIFICATION, 'ar'),
                'time' => $date->format(TIME_FORMAT_WITHOUT_SECONDS),
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
//        dd($notifiable->id);
        if (isset($notifiable) && $notifiable instanceof User) {
//            $notifiable->setLanguage();
            send_to_topic('user_' . $notifiable->id, $this->message);
        }
    }
}
