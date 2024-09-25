<?php

namespace App\Models;
use App\models\document;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentFaq extends Model
{
    use HasFactory;
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
    
}
