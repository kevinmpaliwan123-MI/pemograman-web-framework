<?php

<<<<<<< HEAD
use App\Http\Controllers\BookController;
=======
>>>>>>> 0c914c26a0772b837ebed69c6dd4d7149e030f4f
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD

Route::get('/buku',[BookController::class,'index']);
Route::get('/buku/{id}',[BookController::class,'show']);
=======
>>>>>>> 0c914c26a0772b837ebed69c6dd4d7149e030f4f
