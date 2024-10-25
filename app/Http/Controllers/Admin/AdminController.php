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
        $login_keys = [
            'incorrect_username',
            'incorrect_password',
            'google_login_error',
            'fb_login_error',
            'login_success_message',
        ];

        $login_results = ErrorMessage::whereIn('error_key', $login_keys)->where('page_type','login')->get()->keyBy('error_key');
        $login_data = [
            'incorrect_username' => $login_results['incorrect_username']->error_value ?? null,
            'incorrect_password' => $login_results['incorrect_password']->error_value ?? null,
            'google_login_error' => $login_results['google_login_error']->error_value ?? null,
            'fb_login_error' => $login_results['fb_login_error']->error_value ?? null,
            'login_success_message' =>  $login_results['login_success_message']->error_value ?? null,
        ];

        $register_keys = [
            'required_field_msg',
            'invalid_email_error',
            'unique_email',
            'register_success_msg',
        ];

        $register_results = ErrorMessage::whereIn('error_key', $register_keys)->where('page_type','register')->get()->keyBy('error_key');
        $register_data = [
            'required_field_msg' => $register_results['required_field_msg']->error_value ?? null,
            'invalid_email_error' => $register_results['invalid_email_error']->error_value ?? null,
            'unique_email' => $register_results['unique_email']->error_value ?? null,
            'register_success_msg' =>  $register_results['register_success_msg']->error_value ?? null,
        ];

        $contact_keys = [
            'required_field',
            'recaptcha_error',
            'contact_success_msg',
        ];

        $contact_results = ErrorMessage::whereIn('error_key', $contact_keys)->where('page_type','contact')->get()->keyBy('error_key');
        $contact_data = [
            'required_field' => $contact_results['required_field']->error_value ?? null,
            'recaptcha_error' => $contact_results['recaptcha_error']->error_value ?? null,
            'contact_success_msg' =>  $contact_results['contact_success_msg']->error_value ?? null,
        ];

        return view('admin.configurations.messages',compact('login_data','register_data','contact_data'));
    }

    public function saveMesage(Request $request){
        // return $request->all();
        try{
            if($request->has('page_type') != null){
                
                if($request->has('incorrect_username') != null){
                    $error_messages = ErrorMessage::where('error_key','incorrect_username')->first();
                    if($error_messages != null){
                        $error_messages->error_value = $request->incorrect_username;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'incorrect_username';
                        $error_messages->error_value = $request->incorrect_username;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                    
                }

                if($request->has('incorrect_password') != null){
                    $error_messages = ErrorMessage::where('error_key','incorrect_password')->first();
                    if($error_messages != null){
                        $error_messages->error_value = $request->incorrect_password;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'incorrect_password';
                        $error_messages->error_value = $request->incorrect_password;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                   
                }

                if($request->has('google_login_error') != null){
                    $error_messages = ErrorMessage::where('error_key','google_login_error')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->google_login_error;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'google_login_error';
                        $error_messages->error_value = $request->google_login_error;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('fb_login_error') != null){
                    $error_messages = ErrorMessage::where('error_key','fb_login_error')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->fb_login_error;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'fb_login_error';
                        $error_messages->error_value = $request->fb_login_error;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('login_success_message') != null){
                    $error_messages = ErrorMessage::where('error_key','login_success_message')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->login_success_message;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'login_success_message';
                        $error_messages->error_value = $request->login_success_message;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('required_field_msg') != null){
                    $error_messages = ErrorMessage::where('error_key','required_field_msg')->first();
                    if($error_messages != null){
                        $error_messages->error_value = $request->required_field_msg;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'required_field_msg';
                        $error_messages->error_value = $request->required_field_msg;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                    
                }

                if($request->has('invalid_email_error') != null){
                    $error_messages = ErrorMessage::where('error_key','invalid_email_error')->first();
                    if($error_messages != null){
                        $error_messages->error_value = $request->invalid_email_error;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'invalid_email_error';
                        $error_messages->error_value = $request->invalid_email_error;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                   
                }

                if($request->has('unique_email') != null){
                    $error_messages = ErrorMessage::where('error_key','unique_email')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->unique_email;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'unique_email';
                        $error_messages->error_value = $request->unique_email;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('register_success_msg') != null){
                    $error_messages = ErrorMessage::where('error_key','register_success_msg')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->register_success_msg;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'register_success_msg';
                        $error_messages->error_value = $request->register_success_msg;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('required_field') != null){
                    $error_messages = ErrorMessage::where('error_key','required_field')->first();
                    if($error_messages != null){
                        $error_messages->error_value = $request->required_field;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'required_field';
                        $error_messages->error_value = $request->required_field;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                    
                }

                if($request->has('recaptcha_error') != null){
                    $error_messages = ErrorMessage::where('error_key','recaptcha_error')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->recaptcha_error;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'recaptcha_error';
                        $error_messages->error_value = $request->recaptcha_error;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }

                if($request->has('contact_success_msg') != null){
                    $error_messages = ErrorMessage::where('error_key','contact_success_msg')->first();
                    if($error_messages){
                        $error_messages->error_value = $request->contact_success_msg;
                        $error_messages->update();
                    }else{
                        $error_messages = new ErrorMessage;
                        $error_messages->error_key = 'contact_success_msg';
                        $error_messages->error_value = $request->contact_success_msg;
                        $error_messages->page_type = $request->page_type;
                        $error_messages->save();
                    }
                }
                return redirect()->back()->with('success', 'Data successfully saved.')->withInput()->with('page_type', $request->input('page_type'));
            }
        }catch(Exception $e){
            saveLog("Error:", "AdminController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        
    }
}
