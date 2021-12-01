<?php
/**
 * Dev Mosab Irwished
eng.mosabirwished@gmail.com
WhatsApp +970592879186
 */
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait MultiGuard
{
    public function get_guard(){
        if(Auth::guard('manager')->check())
        {
            return "manager";
        }
        if(Auth::guard('web')->check())
        {
            if (Auth::user()->type == 'vendor')
            {
                return "restaurants";
            }
            if(Auth::user()->type == 'branch')
            {
                return "branch";
            }
        }

    }

}
