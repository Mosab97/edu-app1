<?php

namespace App\Models;

use App\Http\Resources\Api\v1\General\LevelResource;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    private static $points = 0;

    /**
     * @param int $points
     * @return array
     */
    public static function CheckLevel(int $points)
    {
        $level = Level::where('points', '<=', $points)->first();
        $level = $level ?? Level::first();
        return [
            'level' => new LevelResource($level),
            'level_message' => api('you got ', [
                'level' => optional($level)->name
            ])
        ];
    }

    public static function totalPoints(array $questions)
    {
        $questions = collect($questions);
        $questions->each(function ($item) {
            $question = Question::query()->with('right_answer')->find($item['question_id']);
            if (optional(optional($question)->right_answer)->id == $item['answer_id']) self::$points += 1;
        });
        return self::$points;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function right_answer()
    {
        return $this->hasOne(Answer::class, 'question_id')->where('is_right_answer', true);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
