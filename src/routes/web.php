<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;


Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);

Route::resource('products', ProductController::class);


/*

Route::get('/', function () {
    return 'Hello World';
});

Route::get('/about', function () {
    return 'เกี่ยวกับเรา';
});

*/

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/info', function () {
    return view('info');
});