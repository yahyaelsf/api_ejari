<?php

use App\Http\Controllers\Api\Auth\GoogleAuthController;
use App\Http\Controllers\Api\V1\AboutController;
use App\Http\Controllers\Api\V1\AlertController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\BodyController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ConditionController;
use App\Http\Controllers\Api\V1\ExerciseController;
use App\Http\Controllers\Api\V1\FocusController;
use App\Http\Controllers\Api\V1\GeneralContrller;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ProfilePrivacyController;
use App\Http\Controllers\Api\V1\GoalController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\MusicController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\RecordController;
use App\Http\Controllers\Api\V1\RentRequestController;
use App\Http\Controllers\Api\V1\SupportController;
use App\Http\Controllers\Api\V1\UserDetialsController;
use App\Http\Controllers\Api\V1\WalkthroughController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;





Route::group(['prefix' => ''], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('check_email', [AuthController::class, 'checkEmail']);
    Route::post('forget_password', [AuthController::class, 'forgetPassword']);
    Route::post('confirm_code', [AuthController::class, 'confirmCode']);
    Route::post('create_new_password', [AuthController::class, 'createNewPassword']);


    Route::prefix('google')->group(function () {
        Route::get('/login', [GoogleAuthController::class, 'loginWithGoogle']);
        Route::get('/callback', [GoogleAuthController::class, 'callbackFromGoogle']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('categories', [GeneralContrller::class, 'categoris']);
        Route::get('user_type', [GeneralContrller::class, 'selectUserType']);
        Route::get('profile', [GeneralContrller::class, 'profile']);
        Route::post('update_profile', [GeneralContrller::class, 'update_profile']);
        // Route::post('change_password', [GeneralContrller::class, 'change_password']);

        Route::get('rent_requests', [RentRequestController::class, 'index']);
        Route::post('/rent_requests', [RentRequestController::class, 'store']);
        Route::get('rent_requests/{rent_request}', [RentRequestController::class, 'show']);

        Route::get('properties', [PropertyController::class, 'index']);
        Route::post('properties', [PropertyController::class, 'store']);
        Route::get('properties/{property}', [PropertyController::class, 'show']);

        Route::post('propertySchedule', [PropertyController::class, 'propertySchedule']);
        Route::get('propertySchedule/{propertyId}', [PropertyController::class, 'getPropertySchedule']);
        Route::delete('/deletePropertySchedules/{id}', [PropertyController::class, 'deletePropertySchedule']);
        Route::get('/location_search', [PropertyController::class, 'location_search']);
        Route::post('/properties/filter', [PropertyController::class, 'filter']);


        Route::post('/favorite', [GeneralContrller::class, 'toggleFavorite']);
        Route::get('/favorites', [GeneralContrller::class, 'favorites']);
        Route::post('/rating', [GeneralContrller::class, 'rating']);


        Route::get('home', [HomeController::class, 'home'])->name('auth.home');
         Route::get('settinges', [HomeController::class, 'settinges'])->name('settinges');



         Route::post('change_password', [AuthController::class, 'changePassword']);
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('me', [AuthController::class, 'me']);

        Route::post('me', [ProfileController::class, 'update'])->name('auth.profile.update');

        Route::get('notifications', [NotificationController::class, 'index']);
        Route::get('notifications/count', [NotificationController::class, 'count']);
        // Route::post('notifications/settings', [NotificationController::class, 'settings']);




    });
});





    // Doesn't need authorization
    // Route::get('walkthroughs', [WalkthroughController::class, 'index']);
    // Route::get('plans', [PlanController::class, 'index']);
    // Route::post('contact-us', [ContactUsController::class, 'store']);
    // Route::get('faqs', [FaqController::class, 'index']);


