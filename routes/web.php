<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\ContactUsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SiteMetaController;
use App\Http\Controllers\Users\SitePagesController;
use App\Http\Controllers\Admin\AllPagesController;
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

// ****************** SitePagesController Start**********************//
Route::get('/how-it-works',[SitePagesController::class,'howItWork']);
Route::get('/faq',[SitePagesController::class,'Faq']);
Route::get('/terms-and-conditions',[SitePagesController::class,'termsAndConditions']);
Route::get('/privacy-notice',[SitePagesController::class,'privacyNotice']);
// ****************** SitePagesController End **********************//


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
     Route::post('/admin-dashboard/deleteworkSec',[SiteMetaController::class,'deleteWorks']);
     
     Route::get('/admin-dashboard/terms-and-conditions',[SiteMetaController::class,'termsConditions']);
     Route::post('/admin-dashboard/add-terms-process',[SiteMetaController::class,'addTermsAndCondition']);

     Route::get('/admin-dashboard/faq',[AllPagesController::class,'faq']);
     Route::post('/admin-dashboard/faq-process',[AllPagesController::class,'faqAdd']);
     Route::post('/admin-dashboard/faq-remove',[AllPagesController::class,'removeFaq']);
     Route::get('/admin-dashboard/privacy-policy',[AllPagesController::class,'privecyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-process',[AllPagesController::class,'addPrivacyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-remove',[AllPagesController::class,'removePolicy']);

     Route::get('/admin-dashboard/contact-us',[SiteMetaController::class,'contactUs']);
     Route::post('/admin-dashboard/contact-us-procc',[SiteMetaController::class,'addContactProcc']);

     
});


