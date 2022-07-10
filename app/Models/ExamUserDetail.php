<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamUserDetail extends Model
{
    public function question()
    {
        return $this->hasOne(ExamQuestion::class,'id','exam_question_id');
    }
}
