<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SpecialityGalleryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentSectionController;
use Illuminate\Support\Facades\Route;

Route::match(["GET","POST"],'login',[LoginController::class,'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
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
            Route::prefix('item')->name('item.')->group(function(){
                Route::match(['GET','POST'],'itemIndex/{gallery_id}',[SpecialityGalleryController::class,'itemIndex'])->name('itemIndex');
                Route::match(['POST'],'itemEdit/{item_id}',[SpecialityGalleryController::class,'itemEdit'])->name('itemEdit');
                Route::match(['GET'],'itemDelete/{item_id}',[SpecialityGalleryController::class,'itemDelete'])->name('itemDelete');
            });
        });
    });

    Route::prefix('slider')->name('slider.')->group(function(){
        Route::get('',[SliderController::class,'index'])->name('index');
        Route::match(["GET","POST"],'add',[SliderController::class,'add'])->name('add');
        Route::match(["GET","POST"],'edit/{slider_id}',[SliderController::class,'edit'])->name('edit');
        Route::match(["GET","POST"],'del/{slider_id}',[SliderController::class,'del'])->name('del');

    });
    Route::prefix('treatment')->name('treatment.')->group(function(){
        Route::get('',[TreatmentController::class,'index'])->name('index');
        Route::match(["GET","POST"],'add',[TreatmentController::class,'add'])->name('add');
        Route::match(["GET","POST"],'edit/{treatment_id}',[TreatmentController::class,'edit'])->name('edit');
        Route::match(["GET","POST"],'del/{treatment_id}',[TreatmentController::class,'del'])->name('del');

        Route::prefix('section')->name('section.')->group(function(){
            Route::get('index/{treatment_id}',[TreatmentSectionController::class,'index'])->name('index');
            Route::match(["GET","POST"],'add/{treatment_id}',[TreatmentSectionController::class,'add'])->name('add');
            Route::match(["GET","POST"],'edit/{section_id}',[TreatmentSectionController::class,'edit'])->name('edit');
            Route::match(["GET","POST"],'del/{section_id}',[TreatmentSectionController::class,'del'])->name('del');
        });
    });
});

