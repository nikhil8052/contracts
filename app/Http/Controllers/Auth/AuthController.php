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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Mail\Mailable;
use Session;

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

    public function loginUser(){
        $login = LoginRegister::where('key','login')->first();
        return view('auth.login',compact('login'));
    }

    public function loginProcess(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            // Check if the user is not an admin
            if(auth()->user()->is_admin == 0){
                // Check if a redirect URL is provided
                if($request->has('redirect_url') && !empty($request->redirect_url)){
                    return redirect($request->redirect_url)->with('success', 'Login Successfully');
                }
                return redirect('/')->with('success', 'Login Successfully');
            }
        }
        return redirect()->back()->with('error', 'The provided credentials do not match our records.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success',"You have logged out succesfully");
    }

    public function forgetPassword(){
        $login = LoginRegister::where('key','login')->first();
        return view('auth.forget_password',compact('login'));
    }

    public function forgetPasswordEmail(Request $request){
        $request->validate(['email' => 'required|email']);
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if(!$user){
            saveLog("No account found for email: ");
            return redirect()->back()->with('error', 'No account found with that email address.');
        }
        Password::sendResetLink($request->only('email'));
        // saveLog("Password reset link sent!");
        return back()->with('success', 'Password reset link sent!');
        
    }
    public function showResetForm(Request $request, $token = null){
        return view('auth.password_reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request){
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


    // login with google  function define

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
      
    }
        
    // public function handleGoogleCallback()
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->stateless()->user();
          
    //         // Check if the user already exists in the database by Google ID
    //         $user = User::where('google_id', $googleUser->getId())->first();
          
    //         if ($user) {
    //             // Check if the email matches
    //             if ($user->email != $googleUser->getEmail()) {
    //                 return redirect('/')->with('error', 'Email mismatch. Please contact support.');
    //             }

    //             // If the user exists, log them in
    //             if (Auth::login($user)) {

    //                 if ($user->email_verified == 1) {
    //                     switch ($user->is_admin) {
    //                         case 1:
    //                             return redirect('/admin-dashboard')->with('success', 'Welcome ' . $user->first_name . ' to Admin Dashboard.');
    //                         case 0:
    //                             return redirect('/')->with('success', 'Welcome ' . $user->first_name . ' to the home page.');
    //                         default:
    //                             Auth::logout();
    //                             abort(401, 'Invalid user.');
    //                     }
    //                 } else {
    //                     Auth::logout();
    //                     return redirect('/')->with('error', 'not verify your email address');
    //                 }
    //             }
    //         } else {
    //             // User does not exist, check if a user with the same email exists
    //             $existingUser = User::where('email', $googleUser->getEmail())->first();
            
    //             if ($existingUser) {
    //                 // If the user exists but doesn't have a Google ID, store the Google ID
    //                 $existingUser->google_id = $googleUser->getId();
    //                 $existingUser->save();

    //                 // Redirect to email verification if necessary
    //                 $login_email = Crypt::encryptString($existingUser->email);
    //                 return redirect('/verify-email/' . $login_email);
    //             }

    //             // Create a new user
    //             $newUser = User::create([
    //                 'first_name' => $googleUser->name,
    //                 'email' => $googleUser->getEmail(),
    //                 'google_id' => $googleUser->getId(),
    //                 'password' => Hash::make($googleUser->id), // Use a random password
    //                 'is_admin' => 0, // Default role
    //                 'email_verified' => 1, // Assume verified by default
    //                 'status' => 1, // Set status as active
    //             ]);

    //             if ($newUser->email_verified == 1) {
    //                 switch ($newUser->is_admin) {
    //                     case 1: // Admin
    //                         return redirect('/admin-dashboard')->with('success', 'Welcome ' . $newUser->first_name . ' to Admin Dashboard.');
    //                     case 0: // Regular user
    //                         return redirect('/')->with('success', 'Welcome ' . $newUser->first_name . ' to the home page.');
    //                     default:
    //                         Auth::logout();
    //                         abort(401, 'Invalid user.');
    //                 }
    //             } else {
    //                 Auth::logout();
    //                 return redirect('/')->with('error', 'Your email address has not been verified.');
    //             }
    //             return redirect('/')->with('success', 'Welcome ' . $newUser->first_name . ' to the home page.');
    //         }
    //     } catch (\Throwable $th) {
    //         // Log the exception message
          
    //         return redirect('/')->with('error', 'Something went wrong. Please try again.');
    //     }
    // }
    public function handleGoogleCallback()
    {
        try {
            $googleUser  = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in the database by Google ID
            $user = User::where('google_id', $googleUser->getId())->first();
           
            if ($user) {
                // Check if the email matches
                if ($user->email != $googleUser->getEmail()) {
                    return redirect('/')->with('error', 'Email mismatch. Please contact support.');
                }

                // If the user exists, log them in
                if (Auth::login($user)) {
                    // Check if the user's email is verified
                    if ($user->email_verified_at == 1) {
                        switch ($user->is_admin) {
                            case 1:
                                return redirect('/admin-dashboard')->with('success', 'Welcome ' . $user->first_name . ' to Admin Dashboard.');
                            case 0:
                                return redirect('/')->with('success', 'Welcome ' . $user->first_name . ' to the home page.');
                            default:
                                Auth::logout();
                                abort(401, 'Invalid user.');
                        }
                    } else {
                        Auth::logout();
                        return redirect('/')->with('error', 'Your email address has not been verified.');
                    }
                }
            } else {
                // User does not exist, check if a user with the same email exists
                $existingUser  = User::where('email', $googleUser->getEmail())->first();
            
                if ($existingUser ) {
                    // If the user exists but doesn't have a Google ID, store the Google ID
                    $existingUser->google_id = $googleUser->getId();
                    $existingUser->save();

                    // Redirect to email verification if necessary
                    $login_email = Crypt::encryptString($existingUser ->email);
                    return redirect('/verify-email/' . $login_email);
               } 
               else {
                    $newUser = new User();
                    $newUser->first_name = $googleUser->name;
                    $newUser->last_name = $googleUser->name;
                    $newUser->email = $googleUser->email;
                    $newUser->google_id = $googleUser->getId();
                    $newUser->password = Hash::make(Str::random(16)); // Use a random password
                    $newUser->email_verified_at	 = 1; // Assume verified by default
                    $newUser->is_admin = 0;
                    $newUser->status = 1; // Set status as active
                   
                    // Save the new user
                    if ($newUser->save()) {
                        // Check email verification
                        if ($newUser->email_verified_at	 == 1) {
                            switch ($newUser->is_admin) {
                                case 1: // Admin
                                    return redirect('/admin-dashboard')->with('success', 'Welcome ' . $newUser->first_name . ' to Admin Dashboard.');
                                case 0: // Regular user
                                    return redirect('/')->with('success', 'Welcome ' . $newUser->first_name . ' to the home page.');
                                default:
                                    Auth::logout();
                                    abort(401, 'Invalid user.');
                            }
                        } else {
                            Auth::logout();
                            return redirect('/')->with('error', 'Your email address has not been verified.');
                        }
                    } else {
                        Auth::logout();
                        return redirect('/')->with('error', 'Failed to create user. Please try again.');
                    }
                }
            }
        } catch (\Throwable $th) {
            // Log the exception message
            \Log::error('Google Callback Error: ' . $th->getMessage());
            return redirect('/')->with('error', 'Something went wrong. Please try again.');
        }
    }

 
}
