<?php
/*  Dev Mosab Irwished
eng.mosabirwished@gmail.com
WhatsApp +970592879186
*/

namespace App\Channels;


use Illuminate\Notifications\Notification;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\Topics;

class PusherChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toPusher($notifiable);
    }
}
