<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\documentFaq;
use App\Models\DocumentGuide;
use App\Models\DocumentMedia;
class Document extends Model
{
    use HasFactory;
      public function documentFaq()
    {
        return $this->hasMany(DocumentFaq::class, 'document_id', 'id');
    }
    public function documentGuide()
    {
        return $this->hasMany(DocumentGuide::class,'document_id','id');
    }
    public function documentMedia()
    {
         return $this->hasMany(DocumentMedia::class, 'document_id', 'id');
    }
    public function relatedDocuments()
    {
        return $this->belongsToMany(Document::class, 'document_related', 'document_id', 'related_document_id');
    }
}
