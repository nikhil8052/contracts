<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    public function homeCategory(){
        return $this->hasOne(HomeCategories::class,'id','home_category_id');
    }
}
