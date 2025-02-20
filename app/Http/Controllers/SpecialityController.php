<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        return view('admin.speciality.index');
    }

    public function add(Request $request){
        if($request->isMethod("GET")){
            return view('admin.speciality.add');
        }else{
            $speciality = new Speciality();
            $speciality->save();
            return redirect()->route('admin.speciality.index')->with('success', 'Speciality added successfully.');
        }
    }


}
