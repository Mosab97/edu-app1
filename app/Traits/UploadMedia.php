<?php
/**
 * Dev Mosab Irwished
 * eng.mosabirwished@gmail.com
 * WhatsApp +970592879186
 */

namespace App\Traits;

use App\Models\File;
use App\Models\Group;
use Carbon\Carbon;

trait UploadMedia
{

    public function getImageAttribute($value)
    {
        return is_null($value) ? defaultUserImage() : asset($value);
    }

    public function getVideoAttribute($value)
    {
        return is_null($value) ? defaultUserVideo() : asset($value);
    }

    public function getDemonstrationVideoAttribute($value)
    {
        return is_null($value) ? defaultUserVideo() : asset($value);
    }

    public function getPathAttribute($value)
    {
        return asset($value);
    }

}
