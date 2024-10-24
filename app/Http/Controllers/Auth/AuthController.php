<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginRegister;
use App\Models\User;
use Hash;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\PasswordResetToken;
class AuthController extends Controller
{

    public function login(){
        $login = LoginRegister::where('key','login')->first();
        return view('auth.adminLogin',compact('login'));
    }

    public function loginProcc(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/admin-dashboard')->with('sucess','Login Successfully');
        }else{
            return redirect()->back()->with('error','Login failed !!');
        }
    }

    public function adminLogout(){
        Auth::logout();

        return redirect('/')->with('success',"You have logged out succesfully");
    }

    public function register(){
        $register = LoginRegister::where('key','register')->first();
     
        return view('auth.register',compact('register'));
    }

    public function registerProcc(Request $request){

       try {
            // Validate the incoming request
            $request->validate([
                'first_name' => 'required|string|max:255', // Added validation for first name
                'last_name' => 'required|string|max:255',  // Added validation for last name
                'email' => 'required|email|unique:users,email', // Ensure email is unique in the users table
                'password' => 'required|string|min:6|confirmed', // Use 'confirmed' for password confirmation
            ]);

            // Create a new user instance
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hash the password

            // Save the user to the database
            $user->save();

            // Attempt to log the user in
            if (Auth::attempt($request->only('email', 'password'))) {
                // Check if the user is an admin
                if (auth()->user()->is_admin == 1) {
                    return redirect('/admin-dashboard')->with('success', 'Welcome to Admin Dashboard');
                } else {
                    return redirect('/')->with('success', 'Login Successfully');
                }
            }

            return redirect()->back()->with('success', "Registration Successfully, but login failed. Please try again.");
        } catch (Exception $e) {
            // Log the error
            saveLog("Error:", "AuthController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function loginUser()
    {
        $login = LoginRegister::where('key','login')->first();
        return view('auth.login',compact('login'));
    }

    public function loginProcess(Request $request)
    {
        
        $request->validate([
        'email' => 'required|email', // Added email format validation
        'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the user is an admin
            if (auth()->user()->is_admin == 1) {
                return redirect('/admin-dashboard')->with('success', 'Welcome to Admin Dashboard');
            } else {
                return redirect('/')->with('success', 'Login Successfully');
            }
        };

        // If login attempt fails, redirect back with an error message
        return redirect()->back()->with('error', 'The provided credentials do not match our records.');
        // return redirect()->back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);

    }
    public function logout(){

        Auth::logout();

        return redirect('/')->with('success',"You have logged out succesfully");
    }

    public function forgetPassword(){
     
      
        return view('auth.forget_password');
    }

    public function forgetPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
           
            saveLog("No account found for email: ");
            return redirect()->back()->with('error', 'No account found with that email address.');
        }

        Password::sendResetLink($request->only('email'));
        // saveLog("Password reset link sent!");
        return back()->with('success', 'Password reset link sent!');
        
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.password_reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
     
        $request->validate([
            // 'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            // 'token' => 'required',
        ]);

        // saveLog('Reset request data: ');

        $resetStatus = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            if (!$user) {
                // saveLog("User not found during reset.");
                   return redirect()->back()->with('error', 'No user found with that email address.');
                return;
            }

            // saveLog("User found: ");
            $user->password = Hash::make($password);
            // saveLog("New password hash: "); // Log the hashed password
            $user->save();
        });

        // Log the reset status
        // saveLog("Reset status: ");
        if ($resetStatus == Password::PASSWORD_RESET) {
            return redirect()->route('login.user')->with('status', trans($resetStatus));
        }

        return back()->withErrors(['email' => trans($resetStatus)]);
    }
 
}
