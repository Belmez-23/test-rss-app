<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\NewsController@index')->name('feed.index');
