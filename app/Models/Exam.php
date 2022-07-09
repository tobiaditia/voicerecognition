<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function question()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($exam) {
             $exam->question()->each(function($question) {
                $question->delete();
             });
        });
    }
}
