<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SiteMetaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AllPagesController;
use App\Http\Controllers\Users\SitePagesController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\ContactUsController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\ContractController;



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
Route::get('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'loginUser'])->name('login.user');
Route::post('login-process',[AuthController::class,'loginProcess']);
Route::get('/forget-password',[AuthController::class,'forgetPassword']);
Route::post('/forget-password-email',[AuthController::class,'forgetPasswordEmail']);
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');
Route::get('/prepare-your-contract-with-lawyer',[ContractController::class,'lawyerContract']);
Route::post('/get-contract',[ContractController::class,'getContract']);

Route::post('/registerProcc',[AuthController::class,'registerProcc']);
Route::get('logout',[AuthController::class,'logout']);


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

     //************************Documents Urls **********************//
     Route::get('/admin-dashboard/documents',[DocumentController::class,'documents']);
     Route::post('/admin-dashboard/add-documents',[DocumentController::class,'addDocuments']);
     Route::get('/admin-dashboard/add-document-category',[DocumentController::class,'addDocumentCategory'])->name('add.category');
     Route::post('/admin-dashboard/category-process',[DocumentController::class,'CategoryProcess'])->name('category.process');
     Route::get('/admin-dashboard/edit-category/{id}',[DocumentController::class,'editCategory'])->name('edit.category');
     //************************End Urls******************//

     Route::get('/admin-dashboard/how-it-works',[SiteMetaController::class,'howItWorks']);
     Route::post('/admin-dashboard/add-how-it-works',[SiteMetaController::class,'addHowItWorks']);
     Route::post('/admin-dashboard/deleteworkSec',[SiteMetaController::class,'deleteWorks']);
     
     Route::get('/admin-dashboard/terms-and-conditions',[SiteMetaController::class,'termsConditions']);
     Route::post('/admin-dashboard/add-terms-process',[SiteMetaController::class,'addTermsAndCondition']);

     Route::get('/admin-dashboard/login',[SiteMetaController::class,'login']);
     Route::post('/admin-dashboard/add-login',[SiteMetaController::class,'addLogin']);
     Route::get('/admin-dashboard/register',[SiteMetaController::class,'register']);
     Route::post('/admin-dashboard/add-register',[SiteMetaController::class,'addRegister']);

     Route::get('/admin-dashboard/faq',[AllPagesController::class,'faq']);
     Route::post('/admin-dashboard/faq-process',[AllPagesController::class,'faqAdd']);
     Route::post('/admin-dashboard/faq-remove',[AllPagesController::class,'removeFaq']);
     Route::get('/admin-dashboard/privacy-policy',[AllPagesController::class,'privecyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-process',[AllPagesController::class,'addPrivacyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-remove',[AllPagesController::class,'removePolicy']);

     Route::get('/admin-dashboard/contact-us',[SiteMetaController::class,'contactUs']);
     Route::post('/admin-dashboard/contact-us-procc',[SiteMetaController::class,'addContactProcc']);

     Route::get('/admin-dashboard/prepare-contract',[SiteMetaController::class,'prepareContract']);
     Route::post('/admin-dashboard/prepare-contract-procc',[SiteMetaController::class,'prepareContractprocc']);

     //*********************Product Sections***************//
     Route::get('/admin-dashboard/product',[ProductController::class,'product']);
     Route::post('/admin-dashboard/add-product',[ProductController::class,'addProduct']);
     Route::get('/admin-dashboard/all-products',[ProductController::class,'allproducts']);
     Route::get('/admin-dashboard/product/{id}',[ProductController::class,'editProduct']);
     //*********************End Product Sections***************//

     //*********************Product Category Sections***************//
     Route::get('/admin-dashboard/product-categories',[ProductController::class,'productCategory']);
     Route::post('/admin-dashboard/add-categories',[ProductController::class,'addProductCategory']);
     Route::get('/admin-dashboard/categories',[ProductController::class,'categories']);
     Route::get('/admin-dashboard/product-categories/{slug}',[ProductController::class,'editCategories']);
     //*********************End Product Category Sections***************//

     //*********************Users Sections***************//
     Route::get('/admin-dashboard/users',[AllPagesController::class,'allUsers'])->name('all.users');
     Route::get('/admin-dashboard/edit-user/{id}',[AllPagesController::class,'EditUser']);
     Route::post('/admin-dashboard/update-user',[AllPagesController::class,'updateUser'])->name('update.user');
     Route::get('/admin-dashboard/delete-user/{id}',[AllPagesController::class,'deleteUser'])->name('delete.user');

     //*********************End Users Sections***************//

});


