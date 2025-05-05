<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
        Helper::putMetaCache('home.home', $data = []);
        return view('front.index');
    }

    public function contact(){
        
        return view('front.pages.contact.index');
    }

    public function careers(){
        
        return view('front.pages.career.index');
    }

    public function specialityIndex(){
        
        return view('front.pages.speciality.index');
    }
    public function specialitySingle($slug){
        $speciality = DB::table('specialties')->where('slug', $slug)->first(['id']);
        return view('front.pages.speciality.single',compact( 'slug'));
    }

    public function alimentIndex(){
        
        return view('front.pages.aliment.index');
    }
    public function alimentSingle($slug){
        $ailment = DB::table('aliments')->where('slug', $slug)->first(['id']);
        return view('front.pages.aliment.single',compact('slug', 'ailment'));
    }

    public function treatmentIndex(){
        
        return view('front.pages.treatment.index');
    }
    public function treatmentSingle($slug){
        $treatment = DB::table('treatments')->where('slug', $slug)->first(['id']);
        return view('front.pages.treatment.single',compact('slug', 'treatment'));
    }

    public function technologyIndex(){
        
        return view('front.pages.technology.index');
    }
    public function technologySingle($slug){
        $technology = DB::table('technologies')->where('slug', $slug)->first(['id']);
        return view('front.pages.technology.single',compact('slug', 'technology'));
    }

    public function downloadIndex(){
        
        return view('front.pages.download.index');
    }
    public function eventIndex(){
        
        return view('front.pages.event.index');
    }

    public function blogIndex(){
        return view('front.pages.knowledge.blog.index');
    }

    public function blogSingle($slug) {
        // $blog = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.knowledge.blog.single', compact('slug'));
    }

    public function casestudyIndex(){
        return view('front.pages.knowledge.casestudy.index');
    }

    public function casestudySingle($slug){
        $casestudy = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.knowledge.casestudy.single',compact('slug'));
    }

    public function newsLetterIndex(){
        return view('front.pages.knowledge.newsLetter.index');
    }

    public function videoIndex(){
        
        return view('front.pages.knowledge.video.index');
    }

    public function healthIndex(){
        
        return view('front.pages.health.index');
    }

    public function jobCategory(){
        Helper::putMetaCache('career.jobCategory', $data = [
            'title' => 'Job Category',
            'description' => 'Job categories available in Nobel Hospital.',
            'keywords' => 'job, jobs, nobel job',
            'url' => route('jobs.jobcategory')
        ]);
        return view('front.pages.career.jobCategory');
    }

    public function jobDetail($slug) {

      return view('front.pages.career.job.jobDetail', compact('slug'));
    }

    public function jobForm( $slug) {
      
         return view('front.pages.career.job.jobForm', compact('slug'));
    }

    public function updateSingle($slug){
        $update = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.home.update.single',compact('slug'));
    }

    public function newsSingle($slug){
        $news = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.home.news.single',compact('slug'));
    }
    public function eventSingle($slug){
        $event = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.event.single',compact('slug'));
    }

    public function academicIndex(){
        return view('front.pages.academic.index');
    }

    public function academicSingle($slug){
        $academic = DB::table('blogs')->where('slug', $slug)->first(['id']);
        return view('front.pages.academic.single',compact('slug'));
    }
    public function videoAll(){
        Helper::putMetaCache('knowledge.videos', $data = [
            'title' => 'All Videos',
            'description' => 'All Videos section of Nobel Hospital.',
            'keywords' => 'videos',
            'url' => route('knowledge.video')
        ]);
        return view('front.pages.knowledge.video.singleType');
    }
    public function academicAll(){
        return view('front.pages.academic.all');
    }

    public function doctorIndex(){
        Helper::putMetaCache('doctor.doctor', $data = [
            'title' => 'Doctors List',
            'description' => 'All Doctors available in Nobel Hospital.',
            'keywords' => 'doctor, doctors',
            'url' => route('doctor.index')
        ]);
        return view('front.pages.doctor.index');
    }

    public function doctorSingle($slug){
        $doctor = DB::table('doctors')->where('slug', $slug)->first(['id']);
        return view('front.pages.doctor.single',compact('slug'));
    }

    public function policy(){
        Helper::putMetaCache('policy', $data = [
            'title' => 'Policy',
            'description' => 'Polices of Nobel Hospital.',
            'keywords' => 'policy nobel',
            'url' => route('policy')
        ]);
        return view('front.pages.policy.index');
    }
    public function serviceSingle($slug){
        $service = DB::table('services')->where('slug',$slug)->first();
        return view('front.pages.service.single',compact('slug'));
    }

    public function about(){
        Helper::putMetaCache('aboutUs', $data = [
            'title' => 'About Us',
            'description' => 'About Nobel Hospital.',
            'keywords' => 'about nobel',
            'url' => route('about')
        ]);
        return view('front.pages.about.index');
    }
}
