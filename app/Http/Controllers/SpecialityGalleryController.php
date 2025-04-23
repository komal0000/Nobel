<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\SpecialityGallery;
use App\Models\SpecialityGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityGalleryController extends Controller
{
    public function index( Request $request ,$speciality_id)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        $speciality = DB::table('specialties')->where('id',$speciality_id)->first(['id','title']);
        if($parent_speciality_id){
            $specialityGallery = DB::table('speciality_galleries')->where('specialty_id',$parent_speciality_id)->get(['id', 'title', 'description']);
        }else{
            $specialityGallery = DB::table('speciality_galleries')->where("specialty_id",$speciality_id)->get(['id', 'title', 'description']);
        }
        return view('admin.speciality.gallery.index', compact("parent_speciality_id",'speciality','specialityGallery'));
    }

    public function add(Request $request, $speciality_id)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        $speciality = DB::table('specialties')->where('id',$speciality_id)->first(['id','title']);
        if (Helper::G($request)) {
            return view('admin.speciality.gallery.add', compact('speciality','parent_speciality_id'));
        } else {
            $specialityGallery = new SpecialityGallery();
            $specialityGallery->title = $request->title;
            $specialityGallery->description = $request->description;
            $specialityGallery->specialty_id = $speciality_id;
            $specialityGallery->save();
            $this->GalleryItemRender($speciality_id);
            return redirect()->back()->with("success", "Speciality Gallery Successfully Added");
        }
    }

    public function edit(Request $request, $gallery_id)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        $specialityGallery = SpecialityGallery::where("id", $gallery_id)->first();
        $speciality = DB::table('specialties')->where('id',$specialityGallery->specialty_id)->first();
        if (Helper::G($request)) {
            return view('admin.speciality.gallery.edit', compact('specialityGallery','parent_speciality_id','speciality'));
        } else {
            $specialityGallery->title = $request->title;
            $specialityGallery->description = $request->description;
            $specialityGallery->save();
            $this->GalleryItemRender($specialityGallery->specialty_id);
            return redirect()->back()->with("success", "Speciality Gallery Successfully Updated");
        }
    }

    public function del($gallery_id)
    {
        $specialityGallery = SpecialityGallery::where("id", $gallery_id)->first();
        SpecialityGalleryItem::where('speciality_gallery_id', $gallery_id)->delete();
        $specialityGallery->delete();
        $this->GalleryItemRender($specialityGallery->specialty_id);
        return redirect()->back()->with("delete_success", "Speciality Gallery Successfully Deleted");
    }

    public function itemIndex(Request $request, $gallery_id)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        $specialityGallery = DB::table('speciality_galleries')->where('id', $gallery_id)->first(['id','title','specialty_id']);
        $speciality = DB::table('specialties')->where('id',$specialityGallery->specialty_id)->first();
        if (Helper::G($request)) {
            $galleryItems = DB::table('speciality_gallery_items')->where('speciality_gallery_id', $gallery_id)->get();
            return view('admin.speciality.gallery.item.index', compact('gallery_id','specialityGallery','speciality', 'galleryItems','parent_speciality_id'));
        } else {
            $galleryItem = new SpecialityGalleryItem();
            $galleryItem->title = $request->input('title');
            $galleryItem->description = $request->input('description');
            if ($request->hasFile('icon')) {
                $galleryItem->icon = $request->file('icon')->store('uploads/gallery_items', 'public');
            }
            $galleryItem->speciality_gallery_id = $gallery_id;
            $galleryItem->specialty_id = $specialityGallery->specialty_id;
            $galleryItem->save();
            $this->GalleryItemRender($specialityGallery->specialty_id);
            session()->flash('success', 'Award Successfully Added');
            return response()->json(['success' => true]);
        }
    }

    public function itemEdit(Request $request, $item_id)
    {
        $item = SpecialityGalleryItem::where('id',$item_id)->first();
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
        $this->GalleryItemRender($item->specialty_id);
        session()->flash('success', 'Award Successfully updated');
        return response()->json(['success' => true]);
    }

    public function itemDelete($item_id)
    {
        $galleryItem = SpecialityGalleryItem::where('id', $item_id)->first();
        $galleryItem->delete();
        $this->GalleryItemRender($galleryItem->specialty_id);
        return redirect()->back()->with("delete_success", "Gallery Item Successfully Deleted");
    }

    public function GalleryItemRender($speciality_id){
        $specialityGallery = DB::table('speciality_galleries')->where('specialty_id', $speciality_id)->first(['id','title','specialty_id','description']);
        $galleryItems = DB::table('speciality_gallery_items')->where('speciality_gallery_id', $specialityGallery->id)->get();
        Helper::putCache('speciality.single.'.$speciality_id.'.team',view('admin.template.speciality.single.team',compact('specialityGallery','galleryItems'))->render());
    }
}
