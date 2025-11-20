<?php
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ImageServiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/img/{path}', [ImageServiceController::class, 'show'])->where('path', '.*');
 Route::get('/privacy_policy/ar', [HomeController::class,'privacyPolicy'])->name('privacyPolicy');
  Route::get('/privacy_policy/en',function(){
    return view("admin.privacy_policy_en");
  });
