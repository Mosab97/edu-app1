<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\General\AgeResource;
use App\Http\Resources\Api\v1\General\StandardResource;
use App\Http\Resources\Api\v1\General\UserRateMessageResource;
use App\Http\Resources\Api\v1\Teacher\GroupStudentResource;
use App\Models\Age;
use App\Models\ContactUs;
use App\Models\Group;
use App\Models\Manager;
use App\Models\Standard;
use App\Models\User;
use App\Models\UserRateMessage;
use App\Notifications\ContactUsNotification;
use App\Rules\EmailRule;
use App\Rules\StartWith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RateController extends Controller
{

    public function post_rate(Request $request, $user_id)
    {
        return apiSuccess(new UserRateMessageResource(UserRateMessage::init($request, $user_id)),'Rated Successfully');
    }
}
