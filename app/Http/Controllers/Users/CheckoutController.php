<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        $document_id = $request->id;
        $document = Document::find($document_id);
        $title = $document->title;
        $price = $document->doc_price;
        $user=User::find(3);
        $intent='';
        return view('users.checkout.checkout',compact('title','price','intent'));
    }

    public function order_confirm(){
        return view('users.checkout.order_confirmation');
    }
}
