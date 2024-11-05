<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCondition extends Model
{
    use HasFactory;

    // Define inverse relationship with Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Define relationship with conditional question
    public function conditionalQuestion()
    {
        return $this->belongsTo(Question::class, 'conditional_question_id');
    }
}
