<?php

namespace App\Listeners;

use App\Events\AcceptOrderEvent;
use App\Events\CancelOrderEvent;
use App\Events\OnProgressOrderEvent;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AcceptOrderNotification;
use App\Notifications\OnProgressOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class OnProgressOrderListener
{
    public function handle(OnProgressOrderEvent $event)
    {
        $order = $event->order;
        if ($order instanceof Order) {
            $user = User::query()->where('id', $order->user_id)->first();
            if ($user) {
                Notification::send($user, new OnProgressOrderNotification($order));
                $order->update([
                    'status_time_line' => getNewEncodedArray(getAnonymousStatusObj(Order::ON_PROGRESS, 'ON_PROGRESS'), $order->status_time_line)
                ]);
            }
        }

    }
}
