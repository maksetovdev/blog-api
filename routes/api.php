<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//!Routes for Users
Route::prefix('user')->group(function()
{
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::get('/profile',[UserController::class,'show'])->middleware('auth:sanctum');
});
//!Routes for Blogs
Route::prefix('blogs')->group(function()
{   
    Route::get('/show_all',[BlogController::class,'index'])->middleware('auth:sanctum');
    Route::get('/show/{id}',[BlogController::class,'show'])->middleware('auth:sanctum');
    Route::post('/store',[BlogController::class,'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}',[BlogController::class,'update'])->middleware('auth:sanctum');
    Route::get('/delete/{id}',[BlogController::class,'destroy'])->middleware('auth:sanctum');

});




