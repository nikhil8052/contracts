<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DocumentRightController;
use App\Http\Controllers\Admin\SiteMetaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AllPagesController;
use App\Http\Controllers\Users\SitePagesController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\ContactUsController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\ContractController;
use App\Http\Controllers\Users\CheckoutController;
use App\Http\Controllers\Users\PaymentController;
use App\Http\Controllers\Users\WebhookController;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

Route::group(['middleware' => ['front']], function() {
     Route::get('/',[HomeController::class,'home']);
     Route::get('/document/{slug}',[HomeController::class,'getDocument']);
     Route::get('/contacto',[ContactUsController::class,'index']);
     Route::post('/contactusProcc',[ContactUsController::class,'contactUsProcc']);
     Route::get('/register',[AuthController::class,'register'])->name('register');
     Route::get('/login',[AuthController::class,'loginUser'])->name('login.user');
     Route::post('login-process',[AuthController::class,'loginProcess'])->name('login.process');
     Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('recover.password');
     Route::post('/forget-password-email',[AuthController::class,'forgetPasswordEmail']);
     Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
     Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');
     Route::post('/get-contract',[ContractController::class,'getContract']);

     Route::get('/documentos-legales',[ContractController::class,'legalDocument']);
     // Route::get('/category_detail',[ContractController::class,'categoryDetail']);
     Route::get('/category_detail/{slug}',[ContractController::class,'categoryDetail']);

     Route::post('/registerProcc',[AuthController::class,'registerProcc']);
     Route::get('logout',[AuthController::class,'logout'])->name('logout');

     // Login with Google Route
     Route::get('login-google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
     Route::get('auth-google-callback', [AuthController::class, 'handleGoogleCallback']);
     // end login with google route

     // ****************** SitePagesController Start**********************//
     Route::get('/asi-funciona',[SitePagesController::class,'howItWork']);
     Route::get('/preguntas-frecuentes',[SitePagesController::class,'Faq']);
     Route::get('/terminos-y-condiciones',[SitePagesController::class,'termsAndConditions']);
     Route::get('/aviso-de-privacidad',[SitePagesController::class,'privacyNotice']);
     Route::get('/precios',[SitePagesController::class,'prices']);
     Route::post('/ckeditor/upload',[SitePagesController::class,'upload'])->name('ckeditor.upload');
     Route::get('/centro-de-ayuda',[SitePagesController::class,'HelpCenter'])->name('help.center');
     Route::get('/sobre-nosotros',[SitePagesController::class,'whoWeAre']);
     // ****************** SitePagesController End **********************//

     // ******************** Checkout Page ************************* //
     Route::get('/checkout',[CheckoutController::class,'checkout'])->name('user.checkout');
     Route::post('/charge-customer',[CheckoutController::class,'order_confirm'])->name('checkout.customer');
     Route::post('/place-order',[CheckoutController::class,'placeOrder'])->name('user.place_order');
     Route::get('/order-confirmation',[CheckoutController::class,'order_confirm'])->name('user.order_confirmation');
     Route::get('/contracts/{slug}',[ContractController::class,'contracts'])->name('user.contracts');
     Route::post('/save/steps',[ContractController::class,'saveContractsQuestions'])->name('user.save_steps');
});

Route::middleware('admin.redirect')->group(function () {
     Route::get('/admin-login',[AuthController::class,'login'])->name('login');
     Route::post('/loginprocc',[AuthController::class,'loginProcc']);
});
Route::get('/admin-logout',[AuthController::class,'adminLogout']);

Route::group(['middleware' =>['admin']],function(){
     Route::get('/admin-dashboard',[AdminController::class,'index']);
     Route::get('/admin-dashboard/country',[AdminController::class,'country']);

     //************************Documents Urls **********************//
     Route::get('/admin-dashboard/documents',[DocumentController::class,'documents']);
     Route::post('/admin-dashboard/add-documents',[DocumentController::class,'addDocuments']);
     Route::get('/admin-dashboard/all/documents',[DocumentController::class,'allDocuments']);
     Route::get('/admin-dashboard/edit-document/{slug}',[DocumentController::class,'editDocument']);
     Route::post('/admin-dashboard/update-document',[DocumentController::class,'updateDocument']);
     Route::post('/update/documentField/image',[DocumentController::class,'updateFieldImage']);
     Route::get('/admin-dashboard/general-section',[DocumentController::class,'generalSection']);
     Route::post('/admin-dashboard/add/general-section',[DocumentController::class,'addGeneralSection']);
     Route::post('/update/agreement/image',[DocumentController::class,'updateAgreementImage']);
     //*************************End Documents Urls ***********************//

     //*************************Document Questions ***********************//
     Route::get('/admin-dashboard/all-document-questions',[DocumentController::class,'allQuestion']);
     Route::get('/admin-dashboard/document-questions',[DocumentController::class,'documentQuestion']);
     Route::post('/admin-dashboard/add/document-questions',[DocumentController::class,'addDocumentQuestion']);
     Route::get('/admin-dashboard/all-question-type',[DocumentController::class,'allquestionType']);
     Route::get('/admin-dashboard/question-type',[DocumentController::class,'questionType']);
     Route::post('/admin-dashboard/add-question-type',[DocumentController::class,'addTypes']);
     Route::get('/admin-dashboard/edit-question-type/{slug}',[DocumentController::class,'editQuestionType']);

     //*************************End Document Questions *******************//

     //*************************Document Right Section *******************//
     Route::get('/admin-dashboard/all-document-right-content',[DocumentRightController::class,'allRightContent']);
     Route::get('/admin-dashboard/document-right-content',[DocumentRightController::class,'documentRightContent']);
     Route::post('/admin-dashboard/add-document-right-content',[DocumentRightController::class,'addDocumentRightContent']);
     Route::get('/admin-dashboard/edit-document-right-content/{id}',[DocumentRightController::class,'editRightContent']);
     Route::post('/admin-dashboard/update-document-right-content',[DocumentRightController::class,'updateRightContent']);
     //*************************End Document Right Section ***************//

     Route::get('/admin-dashboard/reviews',[DocumentController::class,'reviews']);
     Route::post('/admin-dashboard/add-review',[DocumentController::class,'addReview']);
     Route::get('/admin-dashboard/published-reviews',[DocumentController::class,'publishedReview']);
     Route::get('/admin-dashboard/edit-review/{id}',[DocumentController::class,'editReview']);
     Route::post('/admin-dashboard/delete-review',[DocumentController::class,'deleteReview']);
     Route::post('/admin-dashboard/publish-review',[DocumentController::class,'reviewStatus']);
     Route::get('/admin-dashboard/pending-reviews',[DocumentController::class,'pendingReviews']);
     Route::post('/admin-dashboard/reject-reviews',[DocumentController::class,'rejectReviews']);  

     Route::get('/admin-dashboard/add-document-category',[DocumentController::class,'addDocumentCategory'])->name('add.category');
     Route::post('/admin-dashboard/category-process',[DocumentController::class,'CategoryProcess'])->name('category.process');
     Route::get('/admin-dashboard/document/categories',[DocumentController::class,'allCategories'])->name('document.categories');
     Route::get('/admin-dashboard/edit-category/{slug}',[DocumentController::class,'editCategory'])->name('edit.category');
     //************************End Urls******************//

     Route::get('/admin-dashboard/how-it-works',[SiteMetaController::class,'howItWorks']);
     Route::post('/admin-dashboard/add-how-it-works',[SiteMetaController::class,'addHowItWorks']);
     Route::post('/update/work/image',[SiteMetaController::class,'updateWorkImage']);
     Route::post('/admin-dashboard/deleteworkSec',[SiteMetaController::class,'deleteWorks']);
     
     Route::get('/admin-dashboard/terms-and-conditions',[SiteMetaController::class,'termsConditions']);
     Route::post('/admin-dashboard/add-terms-process',[SiteMetaController::class,'addTermsAndCondition']);

     Route::get('/admin-dashboard/help-center',[SiteMetaController::class,'helpCenter']);
     Route::post('/admin-dashboard/help-center-proccess',[SiteMetaController::class,'helpProcc']);
     Route::post('/update/help/image',[SiteMetaController::class,'updateHelpImage']);

     Route::get('/admin-dashboard/who-we-are',[AllPagesController::class,'aboutUs']);
     Route::post('/admin-dashboard/add/who-we-are',[AllPagesController::class,'whoWeAre']);
     Route::post('/update/vision/image',[AllPagesController::class,'updateVisionImage']);

     Route::get('/admin-dashboard/login',[SiteMetaController::class,'login']);
     Route::post('/admin-dashboard/add-login',[SiteMetaController::class,'addLogin']);
     Route::get('/admin-dashboard/register',[SiteMetaController::class,'register']);
     Route::post('/admin-dashboard/add-register',[SiteMetaController::class,'addRegister']);

     Route::get('/admin-dashboard/prices',[SiteMetaController::class,'prices']);
     Route::post('/admin-dashboard/add-price',[SiteMetaController::class,'addPriceContent']);

     Route::get('/admin-dashboard/faq',[AllPagesController::class,'faq']);
     Route::post('/admin-dashboard/faq-process',[AllPagesController::class,'faqAdd']);
     Route::get('/admin-dashboard/faq-category',[AllPagesController::class,'allFaqCategory']);
     Route::get('/admin-dashboard/add/faq-category',[AllPagesController::class,'faqCategory']);
     Route::post('/admin-dashboard/add/procc',[AllPagesController::class,'addCategory']);
     Route::get('/admin-dashboard/edit/faq-category/{slug}',[AllPagesController::class,'editFaqCategory']);

     Route::get('/admin-dashboard/privacy-policy',[AllPagesController::class,'privecyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-process',[AllPagesController::class,'addPrivacyPolicy']);
     Route::post('/admin-dashboard/privacy-policy-remove',[AllPagesController::class,'removePolicy']);

     Route::get('/admin-dashboard/contact-us',[SiteMetaController::class,'contactUs']);
     Route::post('/admin-dashboard/contact-us-procc',[SiteMetaController::class,'addContactProcc']);

     Route::get('/admin-dashboard/prepare-contract',[SiteMetaController::class,'prepareContract']);
     Route::post('/admin-dashboard/prepare-contract-procc',[SiteMetaController::class,'prepareContractprocc']);

     Route::get('/admin-dashboard/home-content',[SiteMetaController::class,'homepage']);
     Route::post('/admin-dashboard/add/home-content',[SiteMetaController::class,'addHomeContent']);
     Route::post('/update/homecategory/image',[SiteMetaController::class,'updateCategoryImage']);

     Route::get('/admin-dashboard/web-setting',[SiteMetaController::class,'webSetting']);
     Route::post('/admin-dashboard/add/web-setting',[SiteMetaController::class,'addWebsetting']);

     Route::get('/admin-dashboard/messages',[AdminController::class,'messages']);
     Route::post('/admin-dashboard/save/messages',[AdminController::class,'saveMesage']);

     Route::get('/admin-dashboard/legal-document',[SiteMetaController::class,'legal_document']);
     Route::post('/admin-dashboard/add-legal-document',[SiteMetaController::class,'addLegal']);

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
     Route::get('/admin-dashboard/orders',[AllPagesController::class,'orders'])->name('admin.orders');
     Route::get('/admin-dashboard/edit-user/{id?}',[AllPagesController::class,'EditUser']);
     Route::post('/admin-dashboard/update-user',[AllPagesController::class,'updateUser'])->name('update.user');
     Route::get('/admin-dashboard/delete-user/{id}',[AllPagesController::class,'deleteUser'])->name('delete.user');

     //*********************End Users Sections***************//

});



Route::get('/testing',function (){


     $paypal = new PayPalClient();
     $paypal->setApiCredentials(config('paypal')); // Load credentials from config
     $token = $paypal->getAccessToken();
     $paypal->setAccessToken($token);



     $order = $paypal->createOrder([
          "intent" => "CAPTURE", // One-time payment
          "purchase_units" => [
              [
                  "amount" => [
                      "currency_code" => "USD", // Change currency if needed
                      "value" => "100.00" // Replace with dynamic amount
                  ]
              ]
          ],
          "application_context" => [
              "return_url" => route('paypal.success'),
              "cancel_url" => route('paypal.cancel'),
          ]
      ]);

      foreach ($order['links'] as $link) {
          if ($link['rel'] === 'approve') {
              return redirect()->away($link['href']);
          }
      }

      return redirect()->back()->with('error', 'Unable to create PayPal order.');
      

});


Route::get('/paypal-success',[HomeController::class,'question_testing'])->name('paypal.success');
Route::get('/paypal-cancel_url',[HomeController::class,'question_testing'])->name('paypal.cancel');



Route::get('/question-testing',[HomeController::class,'question_testing'])->name('question_testing');



Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);
