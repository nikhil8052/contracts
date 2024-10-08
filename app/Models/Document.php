<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Document extends Model
{
    use HasFactory;

    public function documentAgreement(){
        return $this->hasMany(DocumentAgreement::class,'document_id','id');
    }

    public function documentGuide(){
        return $this->hasMany(DocumentGuide::class,'document_id','id');
    }

    public function documentField(){
        return $this->hasMany(DocumentsField::class, 'document_id', 'id');
    }

    public function relatedDocuments(){
        return $this->belongsToMany(Document::class,  'document_related', 'document_id', 'related_document_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'document_id','id');
    }
}
