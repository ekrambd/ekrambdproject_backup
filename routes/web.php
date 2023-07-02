<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SettingController;

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

Route::get('/', [IndexController::class, 'loginPage']);

Route::post('admin-login', [AccessController::class, 'adminLogin']);

Route::get('/logout', [AccessController::class, 'Logout']);

 
Route::group(['middleware' => 'prevent-back-history'],function(){
	//admin dashboard

    Route::get('/dashboard', [DashboardController::class, 'Dashboard']);
    

   //categories
   Route::resource('categories', CategoryController::class);
   
   //tips
   Route::resource('tips', TipController::class);
   

   //settings
	Route::get('/app-settings', [SettingController::class, 'appSettings']);
	Route::post('settings-app', [SettingController::class, 'settingsApp']);
	Route::get('/account-settings', [SettingController::class, 'accountSettings']);
	Route::post('settings-account', [SettingController::class, 'settingAccount']);
Route::get('/change-password', [SettingController::class, 'changePassword']);
Route::post('password-change', [SettingController::class, 'passwordChange']);


});

//ajax requests
Route::get('/get-category', [AjaxController::class, 'getCategory']);

Route::post('custom-sortable', [AjaxController::class, 'customSortable']);

Route::get('get-categorytype', [AjaxController::class, 'getCategoryType']);