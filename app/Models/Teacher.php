<?php

namespace App\Models;

use App\Traits\UploadMedia;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use UploadMedia;
    protected $guarded = [];
    protected $table = 'teachers';
    public const manager_route = 'teachers';


    public function getDemonstrationVideo()
    {
        $file = File::where(['target_id' => $this->id, 'target_type' => Teacher::class])->first();
        return !isset($file) ? defaultUserVideo() : $file->path;
    }

}
