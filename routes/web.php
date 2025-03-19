<?php

use App\Http\Controllers\AlimentController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EmployeeTestimonialController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SpecialityGalleryController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TechnologySectionController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentSectionController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


Route::get('/',[FrontController::class,'index'])->name('index');

Route::get('specialties',[FrontController::class,'specialties'])->name('specialties');

// Route::

Route::match(["GET", "POST"], 'login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::prefix('speciality')->name('speciality.')->group(function () {
        Route::get('', [SpecialityController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add', [SpecialityController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{speciality_id}', [SpecialityController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{speciality_id}', [SpecialityController::class, 'del'])->name('del');
        Route::prefix('gallery')->name("gallery.")->group(function () {
            Route::get('index/{speciality_id}', [SpecialityGalleryController::class, 'index'])->name('index');
            Route::match(["GET", "POST"], 'add/{speciality_id}', [SpecialityGalleryController::class, 'add'])->name('add');
            Route::match(["GET", "POST"], 'edit/{gallery_id}', [SpecialityGalleryController::class, 'edit'])->name('edit');
            Route::match(["GET", "POST"], 'del/{gallery_id}', [SpecialityGalleryController::class, 'del'])->name('del');
            Route::prefix('item')->name('item.')->group(function () {
                Route::match(['GET', 'POST'], 'index/{gallery_id}', [SpecialityGalleryController::class, 'itemIndex'])->name('index');
                Route::match(['POST'], 'edit/{item_id}', [SpecialityGalleryController::class, 'itemEdit'])->name('edit');
                Route::match(['GET'], 'delete/{item_id}', [SpecialityGalleryController::class, 'itemDelete'])->name('delete');
            });
        });
    });

    Route::prefix('slider')->name('slider.')->group(function () {
        Route::get('', [SliderController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add', [SliderController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{slider_id}', [SliderController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{slider_id}', [SliderController::class, 'del'])->name('del');
    });
    Route::prefix('treatment')->name('treatment.')->group(function () {
        Route::get('', [TreatmentController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add', [TreatmentController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{treatment_id}', [TreatmentController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{treatment_id}', [TreatmentController::class, 'del'])->name('del');

        Route::prefix('section')->name('section.')->group(function () {
            Route::get('index/{treatment_id}', [TreatmentSectionController::class, 'index'])->name('index');
            Route::match(["GET", "POST"], 'add/{treatment_id}', [TreatmentSectionController::class, 'add'])->name('add');
            Route::match(["GET", "POST"], 'edit/{section_id}', [TreatmentSectionController::class, 'edit'])->name('edit');
            Route::match(["GET", "POST"], 'del/{section_id}', [TreatmentSectionController::class, 'del'])->name('del');
            Route::prefix('step')->name('step.')->group(function () {
                Route::get('index/{section_id}', [TreatmentSectionController::class, 'stepIndex'])->name('index');
                Route::match(["GET", "POST"], 'add/{section_id}', [TreatmentSectionController::class, 'stepAdd'])->name('add');
                Route::match(["GET", "POST"], 'edit/{step_id}', [TreatmentSectionController::class, 'stepEdit'])->name('edit');
                Route::match(["GET", "POST"], 'del/{step_id}', [TreatmentSectionController::class, 'stepDel'])->name('del');
            });
        });
    });
    Route::prefix('aliment')->name('aliment.')->group(function () {
        Route::get('index', [AlimentController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add', [AlimentController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{aliment_id}', [AlimentController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{aliment_id}', [AlimentController::class, 'del'])->name('del');
        Route::prefix('section')->name('section.')->group(function () {
            Route::match(['GET'], 'index/{aliment_id}', [AlimentController::class, 'sectionIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{aliment_id}', [AlimentController::class, 'sectionAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{section_id}', [AlimentController::class, 'sectionEdit'])->name('edit');
            Route::match(['GET'], 'del/{section_id}', [AlimentController::class, 'sectionDel'])->name('del');
        });
        Route::prefix('sectionType')->name('sectionType.')->group(function () {
            Route::get('index', [AlimentController::class, 'typeIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add', [AlimentController::class, 'typeAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{type_id}', [AlimentController::class, 'typeEdit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{type_id}', [AlimentController::class, 'typeDel'])->name('del');
        });
    });
    Route::prefix('downloadCategory')->name('downloadCategory.')->group(function () {
        Route::get('index', [DownloadController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [DownloadController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{category}', [DownloadController::class, 'edit'])->name('edit');
        Route::match(['GET', 'POST'], 'del/{category}', [DownloadController::class, 'del'])->name('del');
        Route::prefix('download')->name('download.')->group(function () {
            Route::get('index/{category}', [DownloadController::class, 'downloadIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{category}', [DownloadController::class, 'downloadAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{download}', [DownloadController::class, 'downloadEdit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{download}', [DownloadController::class, 'DownloadDel'])->name('del');
        });
    });

    Route::prefix('blogCategory')->name('blogCategory.')->group(function () {
        Route::get('index/{type}', [BlogController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add/{type}', [BlogController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{category}', [BlogController::class, 'edit'])->name('edit');
        Route::match(['GET', 'POST'], 'del/{category}', [BlogController::class, 'del'])->name('del');
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('index/{blogCategory_id}/{type}', [BlogController::class, 'blogindex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{blogCategory_id}/{type}', [BlogController::class, 'blogAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{blog_id}', [BlogController::class, 'blogEdit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{blog_id}', [BlogController::class, 'blogDel'])->name('del');
        });
    });

    Route::prefix('jobCategory')->name('jobCategory.')->group(function () {
        Route::get('', [JobController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [JobController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{jobCategory_id}', [JobController::class, 'edit'])->name('edit');
        Route::match(['GET', 'POST'], 'del/{jobCategory_id}', [JobController::class, 'del'])->name('del');
        Route::prefix('job')->name('job.')->group(function () {
            Route::get('index/{jobCategory_id}', [JobController::class, 'jobIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{jobCategory_id}', [JobController::class, 'jobAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{job_id}', [JobController::class, 'jobEdit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{job_id}', [JobController::class, 'jobDel'])->name('del');
        });
    });

    Route::prefix('employeeTestimonial')->name('employeeTestimonial.')->group(function () {
        Route::get('', [EmployeeTestimonialController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [EmployeeTestimonialController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{testimonial_id}', [EmployeeTestimonialController::class, 'edit'])->name('edit');
        Route::match(['GET', 'POST'], 'del/{testimonial_id}', [EmployeeTestimonialController::class, 'del'])->name('del');
    });
    Route::prefix('award')->name('award.')->group(function () {
        Route::match(['get', 'post'], '', [AwardController::class, 'index'])->name('index');
        Route::post('edit/{award_id}', [AwardController::class, 'edit'])->name('edit');
        Route::get('del/{award_id}', [AwardController::class, 'del'])->name('del');
    });
    Route::prefix('settings')->name('setting.')->group(function () {
        Route::match(['GET','POST'],'index/{type}',[SettingController::class,'index'])->name('index');
        Route::match(['GET', 'POST'], '/contact', [SettingController::class, 'contact'])->name('contact');
    });
    Route::prefix('technology')->name('technology.')->group(function () {
        Route::match(['GET'], '', [TechnologyController::class, 'index'])->name('index');
        Route::match(['GET','POST'],'add', [TechnologyController::class, 'add'])->name('add');
        Route::match(['GET','POST'],'edit/{technology_id}', [TechnologyController::class, 'edit'])->name('edit');
        Route::get('del/{technology_id}', [TechnologyController::class, 'del'])->name('del');
        Route::prefix('section')->name('section.')->group(function () {
            Route::get('index/{technology_id}',[TechnologySectionController::class,'index'])->name('index');
            Route::match(['GET', 'POST'], 'add/{technology_id}', [TechnologySectionController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{section_id}', [TechnologySectionController::class, 'edit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{section_id}', [TechnologySectionController::class, 'del'])->name('del');
        });
        Route::prefix('sectiontype')->name('sectiontype.')->group(function(){
            Route::match(['GET','POST'],'/index',[TechnologySectionController::class,'typeIndex'])->name('index');
            Route::post('edit/{type_id}',[TechnologySectionController::class,'typeEdit'])->name('edit');
            Route::get('de//{type_id}',[TechnologySectionController::class,'typeDel'])->name('del');
        });
    });
    Route::prefix('leadership')->name('leadership.')->group(function(){
        Route::match(['GET'], '', [LeadershipController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [LeadershipController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{leadership_id}', [LeadershipController::class, 'edit'])->name('edit');
        Route::get('del/{leadership_id}', [LeadershipController::class, 'del'])->name('del');
    });
    Route::prefix('video')->name('video.')->group(function(){
        Route::prefix('type')->name('type.')->group(function(){
            Route::match(['GET','POST'],'index',[VideoController::class,'indexType'])->name('index');
            Route::post('edit/{type_id}',[VideoController::class,'editType'])->name('edit');
            Route::get('del/{type_id}',[VideoController::class,'delType'])->name('del');
        });
        Route::get('index/{type_id}',[VideoController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add/{type_id}',[VideoController::class,'add'])->name('add');
        Route::match(['GET','POST'],'edit/{video_id}',[VideoController::class,'edit'])->name('edit');
        Route::match(['GET'],'del/{video_id}',[VideoController::class,'del'])->name('del');
    });
});
