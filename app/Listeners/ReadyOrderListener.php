<?php

namespace App\Listeners;

use App\Events\CancelOrderEvent;
use App\Events\ReadyOrderEvent;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OnProgressOrderNotification;
use App\Notifications\ReadyOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ReadyOrderListener
{
    public function handle(ReadyOrderEvent $event)
    {
        $order = $event->order;
        if ($order instanceof Order) {
            $merchants_range = optional(getSettings('merchants_range'))->value;
            $merchants_range = (isset($merchants_range)) ? $merchants_range : 3;
            $branch = $order->branch;
            $lat = $branch->lat;
            $lng = $branch->lng;

            $drivers = User::driver()->when($branch, function ($query) use ($lat, $lng, $merchants_range) {
                $query->selectRaw("users.*,ROUND(6371 * acos( cos( radians({$lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin(radians(lat)) ) ) AS distance")
                    ->having("distance", "<", $merchants_range)
                    ->orderBy('distance', "ASC");
            })->get();

            foreach ($drivers as $index => $driver) {
                Delivery::create([
                    'driver_id' => $driver->id,
                    'order_id' => $order->id,
                    'status' => Delivery::NEW_DELIVERY,
                    'distance' => $order->distance,
                ]);
            }

            if (count($drivers) > 0) {
                Notification::send($drivers, new ReadyOrderNotification($order));
                $order->update([
                    'status_time_line' => getNewEncodedArray(getAnonymousStatusObj(Order::READY, 'READY'), $order->status_time_line)
                ]);
            }
        }


    }
}
