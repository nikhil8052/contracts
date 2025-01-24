<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function transactions(){
        return $this->hasOne(Transaction::class,'order_id', 'id');
    }


    public function getStatusAttribute($value){

        if($value==1){
            return "Succecceed";
        } else if($value==0){
            return "Incomplete";
        }else if($value==2){
            return "Refunded";
        }else{
            return "Not Found";
            
        }
    }
}
