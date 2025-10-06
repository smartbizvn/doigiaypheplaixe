<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['CheckAuth']], function () {

    # Permissions
    Route::resource('permissions', PermissionController::class)->parameters(['permissions' => 'entity']);
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::controller(PermissionController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });
   
    # Roles
    Route::resource('roles', RoleController::class)->parameters(['roles' => 'entity']);
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::controller(RoleController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });

    # Users
    Route::resource('users', UserController::class)->parameters(['users' => 'entity']);
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::controller(UserController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });

    # Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::controller(SettingController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store', 'store')->name('store');
        });
    });

    # Logs
    Route::resource('logs', AuditLogController::class)->parameters(['logs' => 'entity']);
    Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
        Route::controller(AuditLogController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
        });
    });
    
    # Change Profile and Password
    Route::controller(UserController::class)->group(function () {
        Route::get('change-profile', 'changeProfile')->name('changeProfile');
        Route::post('postChangeProfile', 'postChangeProfile')->name('postChangeProfile');
        Route::get('change-password', 'changePassword')->name('changePassword');
        Route::post('postChangePassword', 'postChangePassword')->name('postChangePassword');
    });
});