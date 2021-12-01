<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function welcome()
    {
        return redirect()->route('manager.home');
    }
}
