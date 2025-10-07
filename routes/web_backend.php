<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InfoDocumentController;
use App\Http\Controllers\MenuController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['CheckAuth']], function () {

    Route::redirect('/', '/admin/articles');

    # Banners
    Route::resource('banners', BannerController::class)->parameters(['banners' => 'entity']);
    Route::group(['prefix' => 'banners', 'as' => 'banners.'], function () {
        Route::controller(BannerController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });

    # Article Categories
    Route::resource('article_categories', ArticleCategoryController::class)->parameters(['article_categories' => 'entity']);
    Route::group(['prefix' => 'article_categories', 'as' => 'article_categories.'], function () {
        Route::controller(ArticleCategoryController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });

    # Articles
    Route::resource('articles', ArticleController::class)->parameters(['articles' => 'entity']);
    Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
        Route::controller(ArticleController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });
    
    # Menu
    Route::resource('menus', MenuController::class)->parameters(['menus' => 'entity']);
    Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
        Route::controller(MenuController::class)->group(function () {
            Route::post('delete', 'delete')->name('delete');
            Route::post('changeStatus', 'changeStatus')->name('changeStatus');
        });
    });
});