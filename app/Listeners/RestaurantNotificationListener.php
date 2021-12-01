<?php

namespace App\Listeners;

use App\Events\RestaurantNotificationEvent;
use App\Models\User;
use App\Notifications\RestaurantNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RestaurantNotificationListener
{
    public function handle(RestaurantNotificationEvent $event)
    {
        Notification::send($event->user, new RestaurantNotification($event->user,$event->title, $event->body));
    }
}
