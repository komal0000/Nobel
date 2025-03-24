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

    public function speciality(){
        $specilities = DB::table('specialties')->whereNull('parent_speciality_id')->get(['id','title']);
        return view('front.pages.speciality.index',compact('specilities'));
    }
    public function specialitySingle($id){
        $speciality = DB::table('specialties')->where('id',$id)->first();
        return view('front.pages.speciality.single',compact('speciality','id'));
    }
}
