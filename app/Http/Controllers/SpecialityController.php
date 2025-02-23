<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialties = DB::table('specialties')->get(['id', 'title', 'short_description']);
        return view('admin.speciality.index', compact('specialties'));
    }
    public function add(Request $request)
    {
        if (Helper::G($request)) {
            return view('admin.speciality.add');
        } else {
            $speciality = new Speciality();
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;

            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images', 'public');
            }

            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images', 'public');
            }
            $speciality->save();
            $speciality->parent_speciality_id = $speciality->id;
            $speciality->save();

            return redirect()->back();
        }
    }


    public function edit(Request $request, $speciality_id)
    {
        $speciality = Speciality::where("id", $speciality_id)->first();

        if (Helper::G($request)) {
            return view('admin.speciality.edit', compact('speciality'));
        } else {
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;
            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images','public');
            }
            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images','public');
            }
            $speciality->save();
            return redirect()->back();
        }
    }

    public function del($speciality_id)
    {
        Speciality::where("id", $speciality_id)->delete();
        return redirect()->back();
    }
}
