<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function documentField()
    {
        return $this->hasMany(DocumentsField::class, 'document_id', 'id');
    }
    public function relatedDocuments()
    {
        return $this->hasOne(DocumentRelated::class, 'document_id', 'id');
    }
}
