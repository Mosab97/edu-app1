<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
protected $guarded = [];

    public function group()
    {
            return $this->belongsTo(Group::class);
}
    public function category()
    {
            return $this->belongsTo(CategoryActivity::class);
}
}
