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
        return view('front.pages.speciality.single',compact('id'));
    }

    public function alimentIndex(){
        return view('front.pages.aliment.index');
    }
    public function alimentSingle($id){
        return view('front.pages.aliment.single',compact('id'));
    }

    public function treatmentIndex(){
        return view('front.pages.treatment.index');
    }
    public function treatmentSingle($id){
        return view('front.pages.treatment.single',compact('id'));
    }

    public function technologyIndex(){
        return view('front.pages.technology.index');
    }
    public function technologySingle($id){
        return view('front.pages.technology.single',compact('id'));
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
        return view('front.pages.knowledge.casestudy.single',compact('casestudy_id'));
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
        return view('front.pages.home.update.single',compact('update_id'));
    }

    public function newsSingle($news_id){
        return view('front.pages.home.news.single',compact('news_id'));
    }
    public function eventSingle($event_id){
        return view('front.pages.event.single',compact('event_id'));
    }

    public function academicIndex(){
        return view('front.pages.academic.index');
    }

    public function academicSingle($academic_id){
        return view('front.pages.academic.single',compact('academic_id'));
    }
}
