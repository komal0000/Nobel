<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SpecialityGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialityGalleryController extends Controller
{
    public function index($speciality_id)
    {
        $specialityGallery = DB::table('speciality_galleries')->get(['id','title','description']);
        return view('admin.speciality.gallery.index', compact("speciality_id",'specialityGallery'));
    }

    public function add(Request $request, $speciality_id)
    {
        if (Helper::G($request)) {
            return view('admin.speciality.gallery.add',compact('speciality_id'));
        } else {
            $specialityGallery = new SpecialityGallery();
            $specialityGallery->title = $request->title;
            $specialityGallery->description = $request->description;
            $specialityGallery->specialty_id = $speciality_id;
            if(request()->has('file')){
                $specialityGallery->icon = $request->file('icon')->store('uploads/images', 'public');
            }
            $specialityGallery->save();
            return redirect()->route('admin.speciality.gallery.index',['speciality_id'=>$speciality_id]);
        };
    }
    public function edit(Request $request, $gallery_id)
    {
        $specialityGallery = SpecialityGallery::where("id", $gallery_id)->first();

        if (Helper::G($request)) {
            return view('admin.speciality.gallery.edit', compact('specialityGallery'));
        } else {
            $specialityGallery->title = $request->title;
            $specialityGallery->description = $request->description;
            if ($request->hasFile('icon')) {
                $specialityGallery->icon = $request->file('icon')->store('uploads/images', 'public');
            }
            $specialityGallery->save();
            return redirect()->route('admin.speciality.gallery.index', ['speciality_id' => $specialityGallery->specialty_id])->with('success', 'Gallery updated successfully.');
        }
    }

    public function del($gallery_id)
    {
        SpecialityGallery::where("id", $gallery_id)->delete();
        return redirect()->back();
    }
}
