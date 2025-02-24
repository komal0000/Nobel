<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Speciality;
use App\Models\SpecialityGallery;
use App\Models\SpecialityGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialties = Speciality::whereNull('parent_speciality_id')->get(['id', 'title', 'short_description']);
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
                $speciality->icon = $request->file('icon')->store('uploads/images', 'public');
            }
            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images', 'public');
            }
            $speciality->save();
            return redirect()->back();
        }
    }

    public function del($speciality_id)
    {
        $SpecialityGalleries = SpecialityGallery::where('specialty_id', $speciality_id)->get();
        if ($SpecialityGalleries->isNotEmpty()) {
            foreach ($SpecialityGalleries as $gallery) {
                SpecialityGalleryItem::where('speciality_gallery_id', $gallery->id)->delete();
                $gallery->delete();
            }
        }
        Speciality::where("id", $speciality_id)->delete();
        return redirect()->back();
    }

    public function subspecialityIndex($speciality_id)
    {
        $subspecialties = Speciality::where('parent_speciality_id', $speciality_id)->get();
        return view('admin.speciality.subspeciality.index', compact('subspecialties'));
    }

    public function subspecialityAdd(Request $request, $speciality_id)
    {
        if (Helper::G($request)) {
            return view('admin.speciality.subspeciality.add', compact('speciality_id'));
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
            $speciality->parent_speciality_id = $speciality_id;
            $speciality->save();

            return redirect()->back();
        }
    }
    public function subspecialityEdit(Request $request, $subspeciality_id)
    {
        $subspeciality = Speciality::where('id', $subspeciality_id)->first();
        $specility = Speciality::where('id', $subspeciality->parent_speciality_id)->first(['id']);
        if (Helper::G($request)) {
            return view('admin.speciality.subspeciality.edit', compact('subspeciality', 'specility'));
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

            return redirect()->back();
        }
    }
    public function subspecialityDel($subspeciality_id)
    {
        Speciality::where('id', $subspeciality_id)->delete();
        return redirect()->back();
    }
}
