<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRightSection extends Model
{
    use HasFactory;

    public function conditions(){
        return $this->hasMany(QuestionCondition::class,'document_right_content_id','id');
    }

    public function document(){
        return $this->hasMany(Document::class,'id','document_id');
    }
}
