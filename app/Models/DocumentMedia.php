<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
class DocumentMedia extends Model
{
    use HasFactory;
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
