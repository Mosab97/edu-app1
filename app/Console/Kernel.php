<?php

namespace App\Console;

use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $orders = Order::pendingOrder()->get();
            foreach ($orders as $index => $item) {
                $mins = Carbon::now()->diffInMinutes($item->updated_at);
                if ($mins > 30) $item->update(['status' => Order::TIMED_OUT, 'distributor_id' => null]);
            }

            $offers = Offer::where('type', Offer::type['LIMITED'])->where('active', true)->get();
            foreach ($offers as $index => $item) {
                $to = strtotime(Carbon::parse($item->to));
                $now = strtotime(Carbon::now());
                if ($now > $to) $item->update(['active' => false]);
            }
//            dd($offers->first());
//            dd(count($offers));
        })->everyMinute();

    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
