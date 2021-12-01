<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptMerchantFromManagerNotification extends Notification
{
    use Queueable;

    private $message;

    public function __construct()
    {
        $date = Carbon::now();
        $date_formatted = $date->format(DATE_FORMAT_DOTTED);
        $time_formatted = $date->format(TIME_FORMAT_WITHOUT_SECONDS);
        $this->message = [
            'title' => [
                'ar' => notification_trans('Manager Activate Your Account', [], 'ar'),
                'en' => notification_trans('Manager Activate Your Account', [], 'en'),
            ],
            'body' => [
                'ar' => notification_trans('Manager Activate Your Account', [], 'ar'),
                'en' => notification_trans('Manager Activate Your Account', [], 'en'),
            ],
            'click_action' => "",
            'others' => [
                'type' => MANAGER_ACCEPT_YOUR_ACCOUNT_NOTIFICATION,
                'date' => days(getDayNumber(Carbon::now()->dayOfWeek)) . ' | ' . $date_formatted . ' | ' . $time_formatted,
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
