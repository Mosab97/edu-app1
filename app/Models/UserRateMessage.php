<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRateMessage extends Model
{
    protected $guarded = [];

    public static function init(\Illuminate\Http\Request $request, $user_id)
    {
        $user = apiUser();
        $user_rate_message = self::create([
            'from_id' => $user->id,
            'from_type' => $user->user_type,
            'to_id' => $user_id,
            'to_type' => $user->user_type == User::user_type['STUDENT'] ? User::user_type['TEACHER'] : User::user_type['STUDENT'],
            'message' => $request->message
        ]);
        $total = 0;
        $rates = request()->get('rates', []);
        $arr_size = sizeof($rates);
        foreach ($rates as $index => $item) {
            $user_rate_message->standard_rates()->create([
                'standard_id' => $item['standard_id'],
                'rate' => $item['rate'],
            ]);
            $total += $item['rate'];
        }
        $user_rate_message->update(['avg' => ((is_array($rates) && $arr_size > 0) ? $total / $arr_size : 0)]);
        return $user_rate_message;
    }

    public function standard_rates()
    {
        return $this->hasMany(UserStandardRate::class, 'parent_id');
    }
}
