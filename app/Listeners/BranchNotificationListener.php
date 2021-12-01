<?php

namespace App\Listeners;

use App\Events\BranchNotificationEvent;
use App\Notifications\BranchNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BranchNotificationListener
{
    public function handle(BranchNotificationEvent $event)
    {
        Notification::send($event->user, new BranchNotification($event->user,$event->title, $event->body));
    }
}
