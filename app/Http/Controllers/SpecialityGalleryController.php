<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SpecialityGallery;
use App\Models\SpecialityGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityGalleryController extends Controller
{
    public function index($speciality_id)
    {
        $specialityGallery = DB::table('speciality_galleries')->get(['id', 'title', 'description']);
        return view('admin.speciality.gallery.index', compact("speciality_id", 'specialityGallery'));
    }

    public function add(Request $request, $speciality_id)
    {
        if (Helper::G($request)) {
            return view('admin.speciality.gallery.add', compact('speciality_id'));
        } else {
            $specialityGallery = new SpecialityGallery();
            $specialityGallery->title = $request->title;
            $specialityGallery->description = $request->description;
            $specialityGallery->specialty_id = $speciality_id;
            if (request()->has('file')) {
                $specialityGallery->icon = $request->file('icon')->store('uploads/images', 'public');
            }
            $specialityGallery->save();
            return redirect()->back();
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
            return redirect()->back();
        }
    }

    public function del($gallery_id)
    {
        SpecialityGallery::where("id", $gallery_id)->delete();
        return redirect()->back();
    }

    public function itemIndex(Request $request, $gallery_id)
    {
        $speciality = DB::table('speciality_galleries')->where('id', $gallery_id)->first(['id']);
        if (Helper::G($request)) {
            $galleryItems = DB::table('speciality_gallery_items')->where('specialty_gallery_id',$gallery_id)->get();
            return view('admin.speciality.gallery.item.index', compact('gallery_id', 'speciality','galleryItems'));
        } else {
            if ($request->hasFile('icon')) {
                foreach ($request->file('icon') as $index => $file) {
                    $path = $file->store('uploads/gallery_items', 'public');
                    SpecialityGalleryItem::create([
                        'specialty_gallery_id' => $gallery_id,
                        'specialty_id'=>$speciality->id,
                        'icon' => $path,
                        'title' => $request->title[$index],
                        'description' => $request->description[$index] ?? null,
                        'extra_data' => $request->extra_data[$index] ?? null,
                    ]);
                }
            }
            return redirect()->back();
        }
    }
    public function itemEdit(Request $request, $item_id)
    {
        $item = SpecialityGalleryItem::findOrFail($item_id);
        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->extra_data = $request->input('extra_data');
        if ($request->hasFile('icon')) {
            if ($item->icon) {
                Storage::delete($item->icon);
            }
            $path = $request->file('icon')->store('uploads/gallery_items', 'public');
            $item->icon = $path;
        }
        $item->save();

    }
    public function itemDelete($item_id){
        SpecialityGalleryItem::where('id',$item_id)->delete();
        return redirect()->back();
    }
}
