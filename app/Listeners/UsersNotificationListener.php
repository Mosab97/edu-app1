<?php

namespace App\Listeners;

use App\Events\UserNotificationEvent;
use App\Notifications\GeneralNotification;
use App\Notifications\UsersNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class UsersNotificationListener
{
    public function handle(UserNotificationEvent $event)
    {
        Notification::send($event->user, new GeneralNotification(/*$event->user,*/$event->title, $event->body));
    }
}
