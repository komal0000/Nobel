<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SpecialityController;
use Illuminate\Support\Facades\Route;

Route::match(["GET","POST"],'login',[LoginController::class,'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('',[DashboardController::class,'index'])->name('index');

    Route::prefix('speciality')->name('speciality.')->group(function(){
        Route::get('',[SpecialityController::class,'index'])->name('index');
    });
});

