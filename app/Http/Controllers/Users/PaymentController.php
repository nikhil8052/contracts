<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    public function chargeCustomer(Request $req)
    {
        $user = User::find(3); // Example: Fetch the user, replace with dynamic user ID if needed
    
        dd($user);
    }
}
