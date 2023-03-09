<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    LandingpageController,
    AuthenticationController,
    ApplicationController,
    DocumentationController,
    SendMailController,
    SubscriptionController,
    TryoutControllerler,
    ManagekeysController,
    ProfileController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LandingpageController::class, 'landingpage'])->name('landingpage');
Route::get('/Loginaccount', [AuthenticationController::class, 'login'])->name('login');
Route::post('/Authentication', [AuthenticationController::class, 'authentication'])->name('authentication');
Route::get('/Registeraccount', [AuthenticationController::class, 'register'])->name('register');
Route::post('/Authregister', [AuthenticationController::class, 'authregister'])->name('authregister');
Route::get('/Forgetaccount', [AuthenticationController::class, 'forget'])->name('forget');
Route::post('/SendEmail',[SendMailController::class, 'sendmail'])->name('sendmail');
Route::get('/NewPassword', [AuthenticationController::class, 'newpassword'])->name('newpassword');
Route::post('/ResetPassword',[AuthenticationController::class, 'resetpassword'])->name('resetpassword');
Route::get('/Documentation', [DocumentationController::class, 'documentation'])->name('documentation');
Route::get('/ListDocumentation', [DocumentationController::class, 'listdocumentation'])->name('listdocumentation');
Route::get('/ResultDocumentation', [DocumentationController::class, 'resultdocumentation'])->name('resultdocumentation');


Route::middleware(['haslogin'])->group(function () { 
    Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/Application', [ApplicationController::class, 'application'])->name('application');
    Route::get('/CreateApplication', [ApplicationController::class, 'createapplication'])->name('createapplication');
    Route::post('/StoreApplication', [ApplicationController::class, 'storeapplication'])->name('storeapplication');
    Route::get('/EditApplication/{id}', [ApplicationController::class, 'editapplication'])->name('editapplication');
    Route::post('/UpdateApplication/{id}', [ApplicationController::class, 'updateapplication'])->name('updateapplication');
    Route::get('/DeleteApplication/{id}', [ApplicationController::class, 'deleteapplication'])->name('deleteapplication');
    Route::get('/Subscription/{id}', [SubscriptionController::class, 'subscription'])->name('subscription');
    Route::get('/CreateSubscription/{id}', [SubscriptionController::class, 'createsubscription'])->name('createsubscription');
    Route::post('/StoreSubscription', [SubscriptionController::class, 'storesubscription'])->name('storesubscription');
    Route::get('/EditSubscription', [SubscriptionController::class, 'editsubscription'])->name('editsubscription');
    Route::post('/UpdateSubscription', [SubscriptionController::class, 'updatesubscription'])->name('updatesubscription');
    Route::get('/DeleteSubscription/{id}', [SubscriptionController::class, 'deletesubscription'])->name('deletesubscription');
    Route::get('/LoadImgApi', [SubscriptionController::class, 'loadimgapi'])->name('loadimgapi');
    Route::get('/TryOut/{id}',[TryoutControllerler::class, 'tryout'])->name('tryout');
    Route::get('/Swaggerjson', [TryoutControllerler::class, 'jsontryout'])->name('swaggerjson');
    Route::get('/DownloadjsonOpenapi', [TryoutControllerler::class, 'downloadformatopenapi'])->name('downloadjsonopenapi');
    Route::post('/GenerateTestKeyOauth' ,[TryoutControllerler::class, 'generatetestkeyoauth'])->name('generatetestkeyoauth');
    Route::post('/GenerateTestKeyApikey' ,[TryoutControllerler::class, 'generatetestkeyapikey'])->name('generatetestkeyapikey');
    Route::get('/Sandbox/{id}', [ManageKeysController::class, 'sandbox'])->name('sandbox');
    Route::get('/Production/{id}', [ManageKeysController::class, 'production'])->name('production');
    Route::post('/GenerateKeyOauth' ,[ManageKeysController::class, 'oauthgenerate'])->name('oauthgenerate');
    Route::post('/UpdateOauthKey' ,[ManageKeysController::class, 'updateoauth'])->name('updategenerate');
    Route::post('/Accesstoken' ,[ManageKeysController::class, 'generateaccesstoken'])->name('accesstoken');
    Route::post('/ApiKeys' ,[ManageKeysController::class, 'genapikey'])->name('genapikey');
    Route::get('/Profile',[ProfileController::class, 'profile'])->name('profile');
    Route::post('/ChangePassword',[ProfileController::class, 'changepassword'])->name('changepassword');


    Route::get('/Logout', [AuthenticationController::class, 'logout'])->name('logout');  
});







