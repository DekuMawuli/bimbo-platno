<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix("/")
    ->controller(\App\Http\Controllers\AuthController::class)
    ->as("auth.")
    ->group(function (){
       Route::get("", "signIn")->name("login");
       Route::get("register/", "signUp")->name("signup");
       Route::post("process-sign-in/", "processsignIn")->name("process-sign-in");
       Route::post("process-sign-up/", "processSignUp")->name("process-sign-up");
    });


Route::prefix("admin/")
    ->controller(\App\Http\Controllers\AdminController::class)
    ->middleware("auth_only")
    ->name("admin.")
    ->group(function (){
        Route::get("", "dashboard")->name("dashboard");
        Route::post("sign-out/", "signOut")->name("sign-out");
    });
