<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Api\v1\Controller;
use App\Models\ContactUs;
use App\Models\Manager;
use App\Notifications\ContactUsNotification;
use App\Rules\EmailRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;


class ContactUsController extends Controller
{

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250',
            'email' => ['required', 'email', 'max:50', new EmailRule()],
            'mobile' => ['required', 'min:13'],
            'message' => 'required',
        ]);

        $data = $request->only(['name', 'email', 'mobile', 'message']);
        $data['source'] = 'Mobile App';
        $contact = ContactUs::create($data);
        Notification::send(Manager::query()->get(), new ContactUsNotification($contact));
        return apiSuccess(null, api('Message Sent Successfully'));
    }

}
