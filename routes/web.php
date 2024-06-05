<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form',[IndexController::class,'index'])->name('index');
Route::post('/form',[IndexController::class,'store'])->name('store');
Route::get('/show',[IndexController::class,'show'])->name('show');
Route::get('/edit/{user}',[IndexController::class,'edit'])->name('edit');
Route::post('/update/{user}',[IndexController::class,'update'])->name('update');