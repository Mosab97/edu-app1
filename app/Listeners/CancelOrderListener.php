<?php

namespace App\Listeners;

use App\Events\AddNewBalanceEvent;
use App\Events\CancelOrderEvent;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\AcceptOrderNotification;
use App\Notifications\CancelOrderNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CancelOrderListener
{
    private $payment_id;
    private $res_amount;
    private $app_amount;
    private $res_id;

    public function handle(CancelOrderEvent $event)
    {
        $order = $event->order;
        if ($order instanceof Order) {
            $user = User::query()->where('id', $order->user_id)->first();
            if ($user) {
                Notification::send($user, new CancelOrderNotification($order));
                $order->update([
                    'status_time_line' => getNewEncodedArray(getAnonymousStatusObj(Order::CANCELED, 'CANCELED'), $order->status_time_line)
                ]);
            }

            //            $this->payment_id = $event->order->payment_id;
//            $this->app_amount = $event->order->commission;
//            $this->res_amount = (float)($event->order->total_cost - $event->order->discount) - $this->app_amount;
//            $this->res_id = optional(optional($event->order->branch)->merchant)->destination_id;
//
//
//            $wallet = Wallet::query()->where('user_id', $user->id)->where('t_type', '2')
//                ->where('order_id', $event->order->id)->first();
//            if (!$wallet)
//            {
//                if ($event->order->paid_type == 'wallet')
//                {
//                    $wallet = Wallet::query()->create([
//                        'user_id' => $user->id,
//                        't_type' => '2',
//                        'order_id' => $event->order->id,
//                        'amount' => abs($event->order->total),
//                    ]);
//                    event(new AddNewBalanceEvent($user, $wallet));
//                    Log::critical('balance added');
//                }else{
//                    if (Carbon::parse($event->order->created_at)->addDay() < Carbon::now())
//                    {
//                        $wallet = Wallet::query()->create([
//                            'user_id' => $user->id,
//                            't_type' => '2',
//                            'order_id' => $event->order->id,
//                            'amount' => abs($event->order->total),
//                        ]);
//                        event(new AddNewBalanceEvent($user, $wallet));
//                        Log::critical('balance added after 24H');
//                    }
//                    elseif(is_null($event->order->payment_id) || is_null($this->res_id)) {
//                        $wallet = Wallet::query()->create([
//                            'user_id' => $user->id,
//                            't_type' => '2',
//                            'order_id' => $event->order->id,
//                            'amount' => abs($event->order->total),
//                        ]);
//                        event(new AddNewBalanceEvent($user, $wallet));
//                        Log::critical('balance added no payment ID or destination');
//                    }
//                    else{
//                        $curl = curl_init();
//
//                        curl_setopt_array($curl, array(
//                            CURLOPT_URL => "https://api.tap.company/v2/refunds",
//                            CURLOPT_RETURNTRANSFER => true,
//                            CURLOPT_ENCODING => "",
//                            CURLOPT_MAXREDIRS => 10,
//                            CURLOPT_TIMEOUT => 30,
//                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                            CURLOPT_CUSTOMREQUEST => "POST",
//                            CURLOPT_POSTFIELDS => "{\"charge_id\":\"$this->payment_id\",\"amount\":$this->app_amount,\"currency\":\"SAR\",\"description\":\"Refund Description\",\"reason\":\"requested_by_customer\",\"reference\":{\"merchant\":\"txn_0001\"},\"metadata\":{\"udf1\":\"test1\",\"udf2\":\"test2\"},\"post\":{\"url\":\"https://antaderk.com/post\"},\"destinations\":{\"destination\":[{\"id\":\"$this->res_id\",\"amount\":$this->res_amount,\"currency\":\"SAR\",\"description\":\"reversal for refund\",\"reference\":\"reference id\"}]}}",
//                            CURLOPT_HTTPHEADER => array(
//                                "authorization: Bearer sk_live_QkVtLbmW6H1oMRzXaYFecZIA", //sk_test_C5S4VYNZxrUEt6uFoyjO8Rew
//                                "content-type: application/json"
//                            ),
//                        ));
//
//                        $response = curl_exec($curl);
//                        $err = curl_error($curl);
//                        curl_close($curl);
//                        if ($err) {
//                            Log::alert($err);
//                            $wallet = Wallet::query()->create([
//                                'user_id' => $user->id,
//                                't_type' => '2',
//                                'order_id' => $event->order->id,
//                                'amount' => abs($event->order->total),
//                            ]);
//                            event(new AddNewBalanceEvent($user, $wallet));
//                            Log::critical('balance added error return');
//                        }
//
//                        $res = json_decode($response);
//                        if (!isset($res->status) || $res->status != "PENDING")
//                        {
//                            $wallet = Wallet::query()->create([
//                                'user_id' => $user->id,
//                                't_type' => '2',
//                                'order_id' => $event->order->id,
//                                'amount' => abs($event->order->total),
//                            ]);
//                            event(new AddNewBalanceEvent($user, $wallet));
//                            Log::critical('balance added error status');
//                        }
//                        Log::critical($response);
//                        Log::critical("DID: $this->res_id, DAmount: $this->res_amount, AppAmount: $this->app_amount, ChargeID: $this->payment_id");
//
//                    }
//                }
//            }
//
        }
    }
}
