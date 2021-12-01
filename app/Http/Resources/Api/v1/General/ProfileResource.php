<?php

namespace App\Http\Resources\Api\v1\General;

use App\Models\StudentDetails;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        $except_arr_resource = $request['except_arr_resource'];
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'rate' => (int)$this->rate,
            'email' => $this->email,
            'description' => $this->description,
            'user_type' => $this->user_type,
            'status' => api($this->status),
            'image' => $this->image,
            'phone' => $this->phone,
            'verified' => (bool)$this->verified,
            'gender' => gender($this->gender),
            'code' => $this->generatedCode,
            'created_at' => Carbon::parse($this->created_at)->format(DATE_FORMAT_DOTTED),
            'access_token' => $this->access_token,
        ];
        if ($this->user_type == User::user_type['TEACHER']) {
            /** @var Teacher $teacher_details */
            $teacher_details = $this->teacher_details;
            return array_merge($response, [
                'major' => optional($teacher_details)->major,
                'experience' => optional($teacher_details)->experience,
                'demonstration_video' => optional($teacher_details)->demonstration_video,
            ]);
        }
        if ($this->user_type == User::user_type['STUDENT']) {
            /** @var StudentDetails $student_details */
            $student_details = $this->student_details;
            return array_merge($response, [
                'age' => new AgeResource(optional($student_details)->age),
            ]);
        }
        return $response;
    }
}
