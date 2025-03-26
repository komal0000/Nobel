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
}
