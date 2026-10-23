<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('buku', BookController::class);

Route::resource('kategori', CategoryController::class)->except('show');

Route::resource('penerbit', PublisherController::class)->except('show');

