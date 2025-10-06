<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('tim-kiem', 'search')->name('search');
        Route::get('bai-viet/{slug}', 'article')->name('article');
        Route::get('chuyen-muc/{slug}', 'articles')->name('articles');
    });
?>