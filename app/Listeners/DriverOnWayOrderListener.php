<?php

namespace App\Listeners;

use App\Events\AcceptOrderEvent;
use App\Events\CancelOrderEvent;
use App\Events\DriverAcceptOrderEvent;
use App\Events\DriverOnWayOrderEvent;
use App\Models\Branch;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AcceptOrderNotification;
use App\Notifications\DriverAcceptOrderNotification;
use App\Notifications\DriverOnWayOrderNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class DriverOnWayOrderListener
{
    public function handle(DriverOnWayOrderEvent $event)
    {
        $order = $event->order;
        if ($order instanceof Order) {
            $branch = Branch::query()->where('id', $order->branch_id)->first();
            $user = User::query()->where('id', $order->user_id)->first();

            if ($branch) Notification::send($branch, new DriverOnWayOrderNotification($order));
            if ($user) Notification::send($user, new DriverOnWayOrderNotification($order));
            $order->update([
                'status' => Order::ON_WAY,
                'status_time_line' => getNewEncodedArray(getAnonymousStatusObj(Order::ON_WAY_DONE, 'ON_WAY_DONE'), $order->status_time_line),
            ]);
        }
    }
}
