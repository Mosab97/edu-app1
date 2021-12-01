<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
protected $guarded = [];
public const manager_route = 'payment';

    public function user()
    {return $this->belongsTo(User::class);

}
}
