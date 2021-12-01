<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\General\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\GeneralNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function notifications(Request $request)
    {
        $user = apiUser();
        $notifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', User::class)
            ->where('created_at', '>=', $user->created_at)
            ->paginate($this->perPage);
        return apiSuccess([
            'items' => NotificationResource::collection($notifications->items()),
            'paginate' => paginate($notifications),
            'unread_notifications' => $user->unread_notifications,
        ]);
    }

    public function notification($id)
    {
        $user = apiUser();
        $notification = Notification::query()
            ->where(function ($query) use ($user) {
                $query->where('notifiable_id', $user->id)->orWhere('notifiable_id', 0);
            })
            ->find($id);
        if (!$notification) return apiError(api('Notification Not Found'));
        if (!$notification->seen && $notification->notifiable_id != 0) $notification->update(['read_at' => now()]);
        return apiSuccess([
            'item' => new NotificationResource($notification),
            'unread_notifications' => $user->unread_notifications,
        ]);
    }

    public function sendNotificationForAllUsers(Request $request)
    {
        $user = User::get();
        $title = [
            'ar' => $request->title,
            'en' => $request->title,
        ];
        $body = [
            'ar' => $request->body,
            'en' => $request->body,
        ];
        \Illuminate\Support\Facades\Notification::send($user, new GeneralNotification($title, $body));
        return apiSuccess('done');
    }


}
