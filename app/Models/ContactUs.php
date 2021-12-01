<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public const target = [
        'Services Of Ingaz' => 1,
        'Compilations And Suggestions' => 2,
        'Cooperative Training' => 3,
        'Recruitment' => 4,
    ];
    public const how_did_you_hear_about_ingaz = [
        'Facebook' => 1,
        'LinkedIn' => 2,
        'Google' => 3,
        'Friends' => 4,
        'Others' => 5,
    ];

    public function getTargetNameAttribute()
    {
        switch ($this->target) {
            case self::target['Services Of Ingaz']:
                return w('Services Of Ingaz');
            case self::target['Compilations And Suggestions']:
                return w('Compilations And Suggestions');
            case self::target['Cooperative Training']:
                return w('Cooperative Training');
            case self::target['Recruitment']:
                return w('Recruitment');
        }
    }

    public function getHowDidYouHearAboutIngazNameAttribute()
    {
        switch ($this->how_did_you_hear_about_ingaz) {
            case self::how_did_you_hear_about_ingaz['Facebook']:
                return w('Facebook');
            case self::how_did_you_hear_about_ingaz['LinkedIn']:
                return w('LinkedIn');
            case self::how_did_you_hear_about_ingaz['Google']:
                return w('Google');
            case self::how_did_you_hear_about_ingaz['Friends']:
                return w('Friends');
            case self::how_did_you_hear_about_ingaz['Others']:
                return w('Others');
        }
    }

    public function getActionButtonsAttribute()
    {
        $button = '';
        $button .= '<a href="' . route('manager.contact_us.show', $this->id) . '" class="btn btn-icon btn-danger "><i class="la la-eye"></i></a> ';
        $button .= '<button type="button" data-id="' . $this->id . '" data-toggle="modal" data-target="#deleteModel" class="deleteRecord btn btn-icon btn-danger"><i class="la la-trash"></i></button>';
        return $button;
    }
}
