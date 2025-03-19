<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
        $specilities = DB::table('specialties')->get(['id','title']);
        return view('front.index',compact('specilities'));
    }
}
