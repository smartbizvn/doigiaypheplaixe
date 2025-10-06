<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    # Route auth
    Route::controller(AuthController::class)->group(function () {
        Route::get('login',  'login')->name('login');
        Route::post('postLogin',  'postLogin')->name('postLogin')->middleware("throttle:5,1");
        Route::get('forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('postForgotPassword',  'postForgotPassword')->name('postForgotPassword');
        Route::get('reset-password/{token}',  'resetPassword')->name('resetPassword');
        Route::post('postResetPassword',  'postResetPassword')->name('postResetPassword');
        Route::post('logout', 'logout')->name('logout');
    });
    
    # Route system
    include('web_system.php');
    # Route backend
    include('web_backend.php');
    # Route frontend
    include('web_frontend.php');