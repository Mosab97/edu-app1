<?php
/*  Dev Mosab Irwished
eng.mosabirwished@gmail.com
WhatsApp +970592879186
*/

namespace App\Channels;


use Illuminate\Notifications\Notification;

class FcmChannel
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
        $message = $notification->toFcm($notifiable);
    }
}
