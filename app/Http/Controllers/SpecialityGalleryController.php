<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialityGalleryController extends Controller
{
    public function index($speciality_id){
        return view('admin.speciality.gallery.index',compact("speciality_id"));
    }

    public function add(Request $request){

    }
}
