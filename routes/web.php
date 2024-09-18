<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\ContactUsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SiteMetaController;
use App\Http\Controllers\Users\SitePagesController;
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

Route::get('/how-it-works',[SitePagesController::class,'howItWork']);


Route::middleware('admin.redirect')->group(function () {
     Route::get('/admin-login',[AuthController::class,'login'])->name('login');;
     Route::post('/loginprocc',[AuthController::class,'loginProcc']);
});
Route::get('/admin-logout',[AuthController::class,'adminLogout']);

Route::group(['middleware' =>['auth']],function(){
     Route::get('/admin-dashboard',[AdminController::class,'index']);
     Route::get('/admin-dashboard/country',[AdminController::class,'country']);

     Route::get('/admin-dashboard/documents',[DocumentController::class,'documents']);
     Route::post('/admin-dashboard/add-documents',[DocumentController::class,'addDocuments']);

     Route::get('/admin-dashboard/how-it-works',[SiteMetaController::class,'howItWorks']);
     Route::post('/admin-dashboard/add-how-it-works',[SiteMetaController::class,'addHowItWorks']);
});


