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

});//->middleware('auth:sanctum');




