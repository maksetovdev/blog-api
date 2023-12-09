<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//!Routes for Users
Route::prefix('users')->group(function()
{
    Route::post('/sign_in',[UserController::class,'store'])->name('sign_in');
    Route::post('/sign_up',[UserController::class,'login'])->name('login');
    Route::get('/getme',[UserController::class,'show'])->name('getme')->middleware('auth:sanctum');
});
//!Routes for Blogs





