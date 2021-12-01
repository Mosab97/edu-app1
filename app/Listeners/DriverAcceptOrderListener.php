<?php

namespace App\Listeners;

use App\Events\AcceptOrderEvent;
use App\Events\CancelOrderEvent;
use App\Events\DriverAcceptOrderEvent;
use App\Models\Branch;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AcceptOrderNotification;
use App\Notifications\DriverAcceptOrderNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class DriverAcceptOrderListener
{
    public function handle(DriverAcceptOrderEvent $event)
    {
        $order = $event->order;
        if ($order instanceof Order) {
            $branch = Branch::query()->where('id', $order->branch_id)->first();
            if ($branch) {
                Notification::send($branch, new DriverAcceptOrderNotification($order));
//reject the remaining deliveries except the current one;
                $order->deliveries_new()->where('id', '!=', $order->id)->update([
                    'status' => Delivery::MERCHANT_REJECT,
                    'status_time_line' => getNewEncodedArray(getAnonymousStatusObj(Delivery::MERCHANT_REJECT, 'MERCHANT_REJECT'), $order->status_time_line)
                ]);
            }
        }
    }
}
