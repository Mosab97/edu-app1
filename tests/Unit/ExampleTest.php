<?php

namespace Tests\Unit;

use App\Models\Distributor;
use App\Models\Order;
use App\Models\ProductImages;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $order = new Order();
        $this->assertInstanceOf(Order::class,$order);

       return ;
        dd(34);
        dd( number_format(100000.6506,3,'.',','));

///623245207""623245207
//        dd(substr(time(),1,13));
        dd(getRandomLatLng());
        $phone = '0569874564';
        dd( ltrim('0569874564', $phone[0]));
        dd(getDayNumber());
        dd(getDayNumber(Carbon::now()->day));
        dd(Carbon::now()->month);
        dd(collect(ProductImages::type)->random());
        dd(getRandomLatLng());
        $arr = [
            'Jabalia' => ['lat' => 31.5294135, 'lng' => 34.4709862],
            'Alfakora' => ['lat' => 31.5421994, 'lng' => 32.2539447,],
            'Kamal Adwan Hospital' => ['lat' => 31.5384095, 'lng' => 34.4935112,],
            'Darna Restaurant' => ['lat' => 31.5384095, 'lng' => 34.4984913,],
            'Indonesian hospital' => ['lat' => 31.5378405, 'lng' => 34.5028037,],
            'Alaoda hospital' => ['lat' => 31.5347879, 'lng' => 34.4695492,],
            'Alqods open university' => ['lat' => 31.5349724, 'lng' => 34.4591199],
            'Shifa Hospital' => ['lat' => 31.5258214, 'lng' => 34.4589034],
            'Muhannad' => ['lat' => 31.5295964, 'lng' => 34.4768227],
            "Hamdan Restaurant People's Food" => ['lat' => 31.5323399, 'lng' => 34.4902981,],
        ];
        dd($arr[array_rand($arr)]);
        dd(ProductImages::type[array_rand(ProductImages::type)]);

        dd(str_replace('+', "", "966569321450"));
        $str = '0569856321';
        dd(ltrim($str, $str[0]));
        dd(array_rand([1, 2, 3, 4, 5, 6, 7]));
        dd($this->secondsToTime(1640467));
        dd(implode(Distributor::stakeholders, ','));
        dd($merchant_type = (\App\Models\Merchant::MERCHANT_TYPES)[array_rand(\App\Models\Merchant::MERCHANT_TYPES)]);
        dd(Distributor::stakeholders[array_rand(\App\Models\Distributor::stakeholders)]);
        $this->assertTrue(true);
    }

    private function secondsToTime($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
}
