<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('users.checkout.checkout');
    }

    public function order_confirm(){
        return view('users.checkout.order_confirmation');
    }
}
