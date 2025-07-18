<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EmployeeTestimonialController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeCareController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicePackageController;
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


Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('event', [FrontController::class, 'eventIndex'])->name('event');
Route::get('contact', [FrontController::class, 'contact'])->name('contact');
Route::get('careers', [FrontController::class, 'careers'])->name('careers');

Route::get('update/{slug}', [FrontController::class, 'updateSingle'])->name('update.single');
Route::get('academic/{slug}', [FrontController::class, 'academicSingle'])->name('academic.single');
Route::get('policy', [FrontController::class, 'policy'])->name('policy');

Route::get('news/list/{slug}', [FrontController::class, 'newsList'])->name('news.list');
Route::get('event/list/{slug}', [FrontController::class, 'eventList'])->name('event.list');
Route::get('news/{slug}', [FrontController::class, 'newsSingle'])->name('news.single');
Route::get('event/{slug}', [FrontController::class, 'eventSingle'])->name('event.single');

Route::prefix('jobs')->name('jobs.')->group(function() {
   Route::get('', [FrontController::class, 'jobCategory'])->name('jobcategory');
   Route::prefix('{slug}')->name('jobDetail.')->group(function() {
      Route::get('', [FrontController::class, 'jobDetail'])->name('jobDetail');
      Route::get('show-form', [FrontController::class, 'jobForm'])->name('show-form');
      Route::post('form', [SettingController::class, 'jobRequest'])->name('form');
   });
});


Route::prefix('speciality')->name('speciality.')->group(function () {
    Route::get('', [FrontController::class, 'specialityIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'specialitySingle'])->name('single');
});

Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('', [FrontController::class, 'doctorIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'doctorSingle'])->name('single');
});
Route::prefix('treatment')->name('treatment.')->group(function () {
    Route::get('', [FrontController::class, 'treatmentIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'treatmentSingle'])->name('single');
});

Route::prefix('aliment')->name('aliment.')->group(function () {
    Route::get('', [FrontController::class, 'alimentIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'alimentSingle'])->name('single');
});

Route::prefix('download')->name('download.')->group(function () {
    Route::get('', [FrontController::class, 'downloadIndex'])->name('index');
});
Route::prefix('healthlibrary')->name('healthlibrary.')->group(function () {
    Route::get('', [FrontController::class, 'healthIndex'])->name('index');
});
Route::prefix('technology')->name('technology.')->group(function () {
    Route::get('', [FrontController::class, 'technologyIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'technologySingle'])->name('single');
});
Route::prefix('service')->name('service.')->group(function () {
    Route::get('', [FrontController::class, 'serviceIndex'])->name('index');
    Route::get('{slug}', [FrontController::class, 'serviceSingle'])->name('single');
   Route::get('{serviceSlug}/{slug}', [FrontController::class, 'packageSingle'])->name('packageSingle');
});
Route::prefix('academicprogram')->name('academicprogram.')->group(function () {
    Route::get('', [FrontController::class, 'academicIndex'])->name('index');
    Route::get('list', [FrontController::class, 'academicAll'])->name('list');
    Route::get('{slug}', [FrontController::class, 'academicSingle'])->name('single');
});

Route::prefix('knowledge')->name('knowledge.')->group(function () {
    // Route::get('blog', [FrontController::class, 'blogIndex'])->name('blog');
    Route::prefix('blog')->name('blog.')->group(function() {
        Route::get('index', [FrontController::class, 'blogIndex'])->name('index');
        Route::get('{slug}', [FrontController::class, 'blogSingle'])->name('single');
    });
    Route::get('video', [FrontController::class, 'videoIndex'])->name('video');
    Route::get('videos', [FrontController::class, 'videoAll'])->name('videos');
    Route::prefix('casestudy')->name('casestudy.')->group(function () {
        Route::get('index', [FrontController::class, 'caseStudyIndex'])->name('index');
        Route::get('{slug}', [FrontController::class, 'caseStudySingle'])->name('single');
    });
    Route::get('newsletter', [FrontController::class, 'newsLetterIndex'])->name('newsletter');
});

Route::get('about', [FrontController::class, 'about'])->name('about');

Route::get('gallery', [FrontController::class, 'galleryIndex'])->name('gallery.index');
Route::get('gallery/{slug}', [FrontController::class, 'gallerySingle'])->name('gallery.single');
Route::get('irc', [FrontController::class, 'irc'])->name('irc');
Route::get('admission', [FrontController::class, 'admission'])->name('admission');

Route::post('add', [SettingController::class, 'addCallbackRequest'])->name('setting.addRequestCallBack');
Route::post('add-feedback', [SettingController::class, 'addFeedback'])->name('addFeedback');

Route::match(["GET", "POST"], 'login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
        Route::prefix('teamHead')->name('teamHead.')->group(function () {
            Route::match(['GET', 'POST'], 'index/{speciality_id}', [SpecialityController::class, 'teamHeadIndex'])->name('index');
            Route::post('edit/{team_head_id}', [SpecialityController::class, 'teamHeadEdit'])->name('edit');
            Route::get('del/{team_head_id}/{speciality_id}', [SpecialityController::class, 'teamHeadDel'])->name('del');
        });
    });

    Route::prefix('slider')->name('slider.')->group(function () {
        Route::prefix('type')->name('type.')->group(function () {
            Route::match(['GET', 'POST'], '', [SliderController::class, 'typeIndex'])->name('index');
            Route::get('del/{type_id}', [SliderController::class, 'typeDel'])->name('del');
        });
        Route::get('index/{type_id}', [SliderController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add/{type_id}', [SliderController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{slider_id}', [SliderController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{slider_id}', [SliderController::class, 'del'])->name('del');
        Route::prefix('navigation')->name('navigation.')->group(function () {
            Route::get('index', [SliderController::class, 'navigationIndex'])->name('index');
            Route::match(["GET", "POST"], 'add', [SliderController::class, 'navigationAdd'])->name('add');
            Route::match(["GET", "POST"], 'edit/{navigation_id}', [SliderController::class, 'navigationEdit'])->name('edit');
            Route::match(["GET", "POST"], 'del/{navigation_id}', [SliderController::class, 'navigationDel'])->name('del');
        });
    });
    Route::prefix('popup')->name('popup.')->group(function () {
        Route::get('', [PopupController::class, 'index'])->name('index');
        Route::match(["GET", "POST"], 'add', [PopupController::class, 'add'])->name('add');
        Route::match(["GET", "POST"], 'edit/{popup_id}', [PopupController::class, 'edit'])->name('edit');
        Route::match(["GET", "POST"], 'del/{popup_id}', [PopupController::class, 'del'])->name('del');
        Route::match(["GET", "POST"], 'activate/{popup_id}', [PopupController::class, 'activate'])->name('activate');
        Route::match(["GET", "POST"], 'deactivate/{popup_id}', [PopupController::class, 'deactivate'])->name('deactivate');
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
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::prefix('type')->name('type.')->group(function () {
            Route::match(['GET', 'POST'], 'index', [GalleryController::class, 'typeIndex'])->name('index');
            Route::post('edit/{type_id}', [GalleryController::class, 'typeEdit'])->name('edit');
            Route::get('del/{type_id}', [GalleryController::class, 'typeDel'])->name('del');
        });
        Route::get('index/{type_id}', [GalleryController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add/{type_id}', [GalleryController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{gallery_id}', [GalleryController::class, 'edit'])->name('edit');
        Route::get('del/{gallery_id}', [GalleryController::class, 'del'])->name('del');
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
        Route::match(['GET', 'POST'], 'del/{jobCategory_id}', [JobController::class, 'delete'])->name('del');
        Route::prefix('job')->name('job.')->group(function () {
            Route::get('index/{jobCategory_id}', [JobController::class, 'jobIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{jobCategory_id}', [JobController::class, 'jobAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{job_id}', [JobController::class, 'jobEdit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{job_id}', [JobController::class, 'jobDelete'])->name('del');
            Route::get('manage/{job_id}', [JobController::class, 'jobRequest'])->name('manage');
            Route::get('manage/del/{jobRequestId}', [JobController::class, 'delJobRequest'])->name('delRequest');
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
        Route::match(['GET', 'POST'], 'index/{type}', [SettingController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], '/contact', [SettingController::class, 'contact'])->name('contact');
        Route::match(['GET', 'POST'], '/colorscheme', [SettingController::class, 'colorScheme'])->name('colorscheme');
        Route::match(['GET', 'POST'], '/request-callback', [SettingController::class, 'RequestCallBack'])->name('requestCallBack');
        
        Route::match(['GET', 'POST'], '/feedback', [SettingController::class, 'feedback'])->name('feedback');
        
        Route::prefix('national-image')->name('nationalImage.')->group(function () {
          Route::get( 'index', [SettingController::class, 'nationalImageIndex'])->name('index');
          Route::match(['GET', 'POST'], 'add', [SettingController::class, 'nationalImageAdd'])->name('add');
          Route::match(['GET', 'POST'], 'edit', [SettingController::class, 'nationalImageEdit'])->name('edit');
          Route::get( 'del', [SettingController::class, 'nationalImageDel'])->name('del');
       });
       Route::match(['GET', 'POST'], '/healthLibrary', [SettingController::class, 'healthLibrary'])->name('healthLibrary');
       Route::match(['GET', 'POST'], 'irc', [SettingController::class, 'irc'])->name('irc');
        Route::match(['GET', 'POST'], 'admission', [SettingController::class, 'admission'])->name('admission');
        Route::match(['GET', 'POST'], 'meta', [SettingController::class, 'meta'])->name('metaData');
    });
    Route::prefix('technology')->name('technology.')->group(function () {
        Route::match(['GET'], '', [TechnologyController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [TechnologyController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{technology_id}', [TechnologyController::class, 'edit'])->name('edit');
        Route::get('del/{technology_id}', [TechnologyController::class, 'del'])->name('del');
        Route::prefix('section')->name('section.')->group(function () {
            Route::get('index/{technology_id}', [TechnologySectionController::class, 'index'])->name('index');
            Route::match(['GET', 'POST'], 'add/{technology_id}', [TechnologySectionController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{section_id}', [TechnologySectionController::class, 'edit'])->name('edit');
            Route::match(['GET', 'POST'], 'del/{section_id}', [TechnologySectionController::class, 'del'])->name('del');
        });
        Route::prefix('sectiontype')->name('sectiontype.')->group(function () {
            Route::match(['GET', 'POST'], '/index', [TechnologySectionController::class, 'typeIndex'])->name('index');
            Route::post('edit/{type_id}', [TechnologySectionController::class, 'typeEdit'])->name('edit');
            Route::get('de//{type_id}', [TechnologySectionController::class, 'typeDel'])->name('del');
        });
    });
    Route::prefix('leadership')->name('leadership.')->group(function () {
        Route::match(['GET'], '', [LeadershipController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [LeadershipController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{leadership_id}', [LeadershipController::class, 'edit'])->name('edit');
        Route::get('del/{leadership_id}', [LeadershipController::class, 'del'])->name('del');
    });
    Route::prefix('video')->name('video.')->group(function () {
        Route::prefix('type')->name('type.')->group(function () {
            Route::match(['GET', 'POST'], 'index', [VideoController::class, 'indexType'])->name('index');
            Route::post('edit/{type_id}', [VideoController::class, 'editType'])->name('edit');
            Route::get('del/{type_id}', [VideoController::class, 'delType'])->name('del');
        });
        Route::match(['GET', 'POST'], 'index/{type_id}', [VideoController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add/{type_id}', [VideoController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{video_id}', [VideoController::class, 'edit'])->name('edit');
        Route::match(['GET'], 'del/{video_id}', [VideoController::class, 'del'])->name('del');
    });
    Route::prefix('homeCare')->name('homeCare.')->group(function () {
        Route::get('', [HomeCareController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [HomeCareController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{homeCare_id}', [HomeCareController::class, 'edit'])->name('edit');
        Route::get('del/{homeCare_id}', [HomeCareController::class, 'del'])->name('del');
    });
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('', [ServiceController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [ServiceController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{service_id}', [ServiceController::class, 'edit'])->name('edit');
        Route::get('del/{service_id}', [ServiceController::class, 'del'])->name('del');
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('index/{service_id}', [ServiceController::class, 'faqIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{service_id}', [ServiceController::class, 'faqAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{faq_id}', [ServiceController::class, 'faqEdit'])->name('edit');
            Route::get('del/{faq_id}', [ServiceController::class, 'faqDel'])->name('del');
        });
        Route::prefix('benefit')->name('benefit.')->group(function () {
            Route::get('index/{service_id}', [ServiceController::class, 'benefitIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{service_id}', [ServiceController::class, 'benefitAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{benefit_id}', [ServiceController::class, 'benefitEdit'])->name('edit');
            Route::get('del/{benefit_id}', [ServiceController::class, 'benefitDel'])->name('del');
        });
        Route::prefix('section')->name('section.')->group(function () {
            Route::get('index/{service_id}', [ServiceController::class, 'sectionIndex'])->name('index');
            Route::match(['GET', 'POST'], 'add/{service_id}', [ServiceController::class, 'sectionAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{section_id}', [ServiceController::class, 'sectionEdit'])->name('edit');
            Route::get('del/{section_id}', [ServiceController::class, 'sectionDel'])->name('del');
        });
        Route::prefix('package')->name('package.')->group(function () {
            Route::prefix('type')->name('type.')->group(function () {
                Route::match(['GET', 'POST'], 'index/{service_id}', [ServicePackageController::class, 'typeIndex'])->name('index');
                Route::get('del/{type_id}', [ServicePackageController::class, 'typeDel'])->name('del');
            });
            Route::prefix('category')->name('category.')->group(function () {
                Route::match(['GET', 'POST'], 'index', [ServicePackageController::class, 'categoryIndex'])->name('index');
                Route::get('del/{category_id}', [ServicePackageController::class, 'categoryDel'])->name('del');
            });
            Route::get('index/{type_id}', [ServicePackageController::class, 'index'])->name('index');
            Route::match(['GET', 'POST'], 'add/{type_id}', [ServicePackageController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{package_id}', [ServicePackageController::class, 'edit'])->name('edit');
            Route::get('del/{package_id}', [ServicePackageController::class, 'del'])->name('del');
        });

    });
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('', [DoctorController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [DoctorController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{doctor_id}', [DoctorController::class, 'edit'])->name('edit');
        Route::get('del/{doctor_id}', [DoctorController::class, 'del'])->name('del');
        Route::prefix('speciality')->name('speciality.')->group(function () {
            Route::get('del/{doctor_id}/{speciality_id}', [DoctorController::class, 'specialityDel'])->name('del');
        });
        Route::prefix('milestone')->name('milestone.')->group(function () {
            Route::match(['GET', 'POST'], 'index/{doctor_id}', [DoctorController::class, 'milestoneIndex'])->name('index');
            Route::post('edit/{milestone_id}', [DoctorController::class, 'milestoneEdit'])->name('edit');
            Route::get('del/{milestone_id}', [DoctorController::class, 'milestoneDel'])->name('del');
        });
    });
    Route::prefix('poilicy')->name('policy.')->group(function () {
        Route::match(['GET', 'POST'], 'index', [PolicyController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'edit/{policy_id}', [PolicyController::class, 'edit'])->name('edit');
        Route::get('del/{policy_id}', [PolicyController::class, 'del'])->name('del');
    });

    Route::prefix('about')->name('about.')->group(function () {
        Route::get('index', [AboutController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [AboutController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{about_id}', [AboutController::class, 'edit'])->name('edit');
        Route::get('del/{about_id}', [AboutController::class, 'del'])->name('del');
    });
});
