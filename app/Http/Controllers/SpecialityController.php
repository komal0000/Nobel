<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialties = DB::table('specialties')->get(['title','short_description']);
        return view('admin.speciality.index',compact('specialties'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view('admin.speciality.add');
        } else {
            $speciality = new Speciality();
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;
            $speciality->span = $request->title;
            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images');
            }
            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images');
            }
            $speciality->save();
            return redirect()->route('admin.speciality.index')->with('success', 'Speciality added successfully.');
        }
    }

    public function edit(Request $request, $speciality_id)
    {
        $speciality = Speciality::where("id",$speciality_id)->first();

        if ($request->isMethod("GET")) {
            return view('admin.speciality.edit', compact('speciality'));
        } else {
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;
            $speciality->span = $request->title;
            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images');
            }
            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images');
            }
            $speciality->save();
            return redirect()->route('admin.speciality.index')->with('success', 'Speciality updated successfully.');
        }
    }


}
