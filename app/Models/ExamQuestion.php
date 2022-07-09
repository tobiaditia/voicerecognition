<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    public function multiple_choice()
    {
        return $this->hasMany(ExamMultipleChoiceItem::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($question) {
             $question->multiple_choice()->each(function($multiple_choice) {
                $multiple_choice->delete();
             });
        });
    }
}
