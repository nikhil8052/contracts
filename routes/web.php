<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\ContactUsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'home']);
Route::get('/contact-us',[ContactUsController::class,'index']);
Route::post('/contactusProcc',[ContactUsController::class,'contactUsProcc']);

Route::middleware('admin.redirect')->group(function () {
     Route::get('/admin-login',[AuthController::class,'login'])->name('login');;
     Route::post('/loginprocc',[AuthController::class,'loginProcc']);
});
Route::get('/admin-logout',[AuthController::class,'adminLogout']);

Route::group(['middleware' =>['auth']],function(){
     Route::get('/admin-dashboard',[AdminController::class,'index']);
     Route::get('/admin-dashboard/documents',[AdminController::class,'documents']);
     Route::get('/admin-dashboard/country',[AdminController::class,'country']);
});


