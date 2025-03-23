<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
        $specilities = DB::table('specialties')->whereNull('parent_speciality_id')->get(['id','title']);
        return view('front.index',compact('specilities'));
    }

    public function contact(){
        $specilities = DB::table('specialties')->whereNull('parent_speciality_id')->get(['id','title']);
        return view('front.pages.contact.index',compact('specilities'));
    }

    public function career(){
        $specilities = DB::table('specialties')->whereNull('parent_speciality_id')->get(['id','title']);
        return view('front.pages.career.index',compact('specilities'));
    }
}
