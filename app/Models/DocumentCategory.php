<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    public function documents(){
        return $this->belongsToMany(Document::class,'document_with_categories','id','document_id');
    }
}
