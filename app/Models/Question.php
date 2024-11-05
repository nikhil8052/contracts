<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Define relationship with QuestionData
    public function questionData()
    {
        return $this->hasOne(QuestionData::class);
    }

    // Define relationship with QuestionCondition
    public function conditions()
    {
        return $this->hasMany(QuestionCondition::class);
    }

    // Define relationship with MultipleChoiceQuestionOption
    public function options()
    {
        return $this->hasMany(MultipleChoiceQuestionOption::class);
    }

    // Define self-referencing relationship for the next question
    public function nextQuestion()
    {
        return $this->belongsTo(Question::class, 'next_question_id');
    }
}
