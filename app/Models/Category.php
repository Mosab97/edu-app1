<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];
    protected $table = 'categories';

    protected static function boot()
    {
        parent::boot(); //  Change the autogenerated stub
        static::addGlobalScope('orderedBy', function (Builder $builder) {
            $builder->latest('categories.updated_at');
        });
    }

    public function values()
    {
        return $this->hasMany(PackageValues::class);
    }

    public function getImageAttribute($value)
    {
        return is_null($value) ? defaultUserImage() : asset($value);
    }


    public function getActionButtonsAttribute()
    {
        $button = '';
        $button .= '<a href="' . route('manager.category.edit', $this->id) . '" class="btn btn-icon btn-danger "><i class="la la-pencil"></i></a> ';
        $button .= '<button type="button" data-id="' . $this->id . '" data-toggle="modal" data-target="#deleteModel" class="deleteRecord btn btn-icon btn-danger"><i class="la la-trash"></i></button>';
        return $button;
    }
}
