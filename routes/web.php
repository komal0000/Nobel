<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SpecialityGalleryController;
use Illuminate\Support\Facades\Route;

Route::match(["GET","POST"],'login',[LoginController::class,'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('',[DashboardController::class,'index'])->name('index');

    Route::prefix('speciality')->name('speciality.')->group(function(){
        Route::get('',[SpecialityController::class,'index'])->name('index');
        Route::match(["GET","POST"],'add',[SpecialityController::class,'add'])->name('add');
        Route::match(["GET","POST"],'edit/{speciality_id}',[SpecialityController::class,'edit'])->name('edit');
        Route::match(["GET","POST"],'del/{speciality_id}',[SpecialityController::class,'del'])->name('del');
        Route::prefix('gallery')->name("gallery.")->group(function(){
            Route::get('index/{speciality_id}',[SpecialityGalleryController::class,'index'])->name('index');
            Route::match(["GET","POST"],'add/{speciality_id}',[SpecialityGalleryController::class,'add'])->name('add');
            Route::match(["GET","POST"],'edit/{gallery_id}',[SpecialityGalleryController::class,'edit'])->name('edit');
            Route::match(["GET","POST"],'del/{gallery_id}',[SpecialityGalleryController::class,'del'])->name('del');
        });
    });
});

