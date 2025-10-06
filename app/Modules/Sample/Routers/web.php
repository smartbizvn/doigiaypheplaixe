<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

Route::group([
    'module' => 'Sample',
    'prefix' => 'sample',
], function () {

    Route::get('/', 'SampleController@index')->name('sample.index');

});
