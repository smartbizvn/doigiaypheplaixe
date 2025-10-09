<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('tim-kiem', 'search')->name('search');
        Route::get('chia-se-kien-thuc/{slug}', 'article')->name('article');
        Route::get('chia-se-kien-thuc', 'articles')->name('articles');
        Route::get('lien-he', 'contact')->name('contact');
        Route::any('{any}', 'page')->where('any', '.*');
    });
?>