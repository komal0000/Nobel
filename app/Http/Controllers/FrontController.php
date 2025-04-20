<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
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
    public function specialitySingle($id){
        $speciality = DB::table('specialties')->where('id', $id)->first(['title', 'short_description']);
        return view('front.pages.speciality.single',compact('id', 'speciality'));
    }

    public function alimentIndex(){
        return view('front.pages.aliment.index');
    }
    public function alimentSingle($id){
        $ailment = DB::table('aliments')->where('id', $id)->first(['title', 'short_description']);
        return view('front.pages.aliment.single',compact('id', 'ailment'));
    }

    public function treatmentIndex(){
        return view('front.pages.treatment.index');
    }
    public function treatmentSingle($id){
        $treatment = DB::table('treatments')->where('id', $id)->first(['title', 'short_description']);
        return view('front.pages.treatment.single',compact('id', 'treatment'));
    }

    public function technologyIndex(){
        return view('front.pages.technology.index');
    }
    public function technologySingle($id){
        $technology = DB::table('technologies')->where('id', $id)->first(['title', 'short_description']);
        return view('front.pages.technology.single',compact('id', 'technology'));
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

    public function casestudyIndex(){
        return view('front.pages.knowledge.casestudy.index');
    }

    public function casestudySingle($casestudy_id){
        $casestudy = DB::table('blogs')->where('id', $casestudy_id)->first(['title', 'image', 'short_description']);
        return view('front.pages.knowledge.casestudy.single',compact('casestudy_id', 'casestudy'));
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
        return view('front.pages.career.jobCategory');
    }

    public function updateSingle($update_id){
        $update = DB::table('blogs')->where('id', $update_id)->first(['title', 'image', 'short_description']);
        return view('front.pages.home.update.single',compact('update_id', 'update'));
    }

    public function newsSingle($news_id){
        $news = DB::table('blogs')->where('id', $news_id)->first(['title', 'image', 'short_description']);
        return view('front.pages.home.news.single',compact('news_id', 'news'));
    }
    public function eventSingle($event_id){
        $event = DB::table('blogs')->where('id', $event_id)->first(['title', 'image', 'short_description']);
        return view('front.pages.event.single',compact('event_id', 'event'));
    }

    public function academicIndex(){
        return view('front.pages.academic.index');
    }

    public function academicSingle($academic_id){
        // $academic = DB::table('academic')->where('id', $academic_id)->first(['title']);
        return view('front.pages.academic.single',compact('academic_id'));
    }
    public function videoAll(){
        return view('front.pages.knowledge.video.singleType');
    }
    public function academicAll(){
        return view('front.pages.academic.all');
    }

    public function doctorIndex(){
        return view('front.pages.doctor.index');
    }

    public function doctorSingle($slug){
        $doctor = DB::table('doctors')->where('slug', $slug)->first(['id','title', 'image', 'short_description']);
        return view('front.pages.doctor.single',compact('doctor'));
    }

    public function policy(){
        return view('front.pages.policy.index');
    }
    public function serviceSingle($service_id){
        $service = DB::table('services')->where('id',$service_id)->first(['title', 'single_page_image', 'short_desc']);
        return view('front.pages.service.single',compact('service_id','service'));
    }

    public function about(){
        return view('front.pages.about.index');
    }
}
