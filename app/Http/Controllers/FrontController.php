<?php

namespace App\Http\Controllers;

use App\Helper;
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
    public function specialitySingle($slug){
        return view('front.pages.speciality.single',compact( 'slug'));
    }

    public function alimentIndex(){
        
        return view('front.pages.aliment.index');
    }
    public function alimentSingle($slug){
        return view('front.pages.aliment.single',compact('slug'));
    }

    public function treatmentIndex(){
        
        return view('front.pages.treatment.index');
    }
    public function treatmentSingle($slug){
        return view('front.pages.treatment.single',compact('slug'));
    }

    public function technologyIndex(){
        
        return view('front.pages.technology.index');
    }
    public function technologySingle($slug){
        return view('front.pages.technology.single',compact('slug'));
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
        return view('front.pages.knowledge.blog.single', compact('slug'));
    }

    public function casestudyIndex(){
        return view('front.pages.knowledge.casestudy.index');
    }

    public function casestudySingle($slug){
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
        return view('front.pages.career.jobCategory');
    }

    public function jobDetail($slug) {

      return view('front.pages.career.job.jobDetail', compact('slug'));
    }

    public function jobForm( $slug) {
      
         return view('front.pages.career.job.jobForm', compact('slug'));
    }

    public function updateSingle($slug){
        return view('front.pages.home.update.single',compact('slug'));
    }

    public function newsSingle($slug){
        return view('front.pages.home.news.single',compact('slug'));
    }
    public function eventSingle($slug){
        return view('front.pages.event.single',compact('slug'));
    }

    public function academicIndex(){
        return view('front.pages.academic.index');
    }

    public function academicSingle($slug){
        return view('front.pages.academic.single',compact('slug'));
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
        return view('front.pages.doctor.single',compact('slug'));
    }

    public function policy(){
        return view('front.pages.policy.index');
    }
    public function serviceSingle($slug){
        $service = DB::table('services')->where('slug',$slug)->first();
        $sections = DB::table('service_sections')->where('service_id', $service->id)->get();
        return view('front.pages.service.single',compact('slug', 'sections'));
    }

    public function packageSingle($serviceSlug, $slug) {
      return view('front.pages.service.package.single', compact('serviceSlug','slug'));
    }

    public function about(){
        return view('front.pages.about.index');
    }
}
