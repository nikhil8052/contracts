<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.adminLogin');
    }

    public function loginProcc(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/admin-dashboard')->with('sucess','Welcome to Admin Dashbaord');
        }else{
            return redirect()->back()->with('error','Login failed !!');
        }
    }

    public function adminLogout(){
        Auth::logout();

        return redirect('/')->with('success',"You have logged out succesfully");
    }
}
