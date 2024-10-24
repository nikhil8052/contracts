<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrorMessage;
use Exception;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index.index');
    }

    public function country(){
        return view('admin.country.countries');
    }

    public function messages(){
        return view('admin.configurations.messages');
    }

    public function saveMesage(Request $request){
        // return $request->all();
        try{
            if($request->has('page_type') != null){
                $error_messages = new ErrorMessage;
                if($request->has('incorrect_username') != null){
                    $error_messages->error_key = 'incorrect_username';
                    $error_messages->error_value = $request->incorrect_username;
                    $error_messages->page_type = $request->page_type;
                    // $error_messages->save();
                }

                if($request->has('incorrect_password') != null){
                    $error_messages->error_key = 'incorrect_password';
                    $error_messages->error_value = $request->incorrect_password;
                    $error_messages->page_type = $request->page_type;
                    // $error_messages->save();
                }

                if($request->has('google_login_error') != null){
                    $error_messages->error_key = 'google_login_error';
                    $error_messages->error_value = $request->google_login_error;
                    $error_messages->page_type = $request->page_type;
                    // $error_messages->save();
                }

                if($request->has('fb_login_error') != null){
                    $error_messages->error_key = 'fb_login_error';
                    $error_messages->error_value = $request->fb_login_error;
                    $error_messages->page_type = $request->page_type;
                    // $error_messages->save();
                }

                if($request->has('success_message') != null){
                    $error_messages->error_key = 'success_message';
                    $error_messages->error_value = $request->success_message;
                    $error_messages->page_type = $request->page_type;
                    // $error_messages->save();
                }

            }
        }catch(Exception $e){
            saveLog("Error:", "AdminController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        
    }
}
