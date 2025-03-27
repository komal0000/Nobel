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
}
