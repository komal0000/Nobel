<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Gallery;
use App\Models\GalleryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
   public function typeIndex(Request $request)
   {
      if (Helper::G()) {
         $gallery_types = DB::table('gallery_types')->get();
         return view('admin.gallery.type.index', compact('gallery_types'));
      } else {
         $type = new GalleryType();
         $type->title = $request->title;
         $type->save();
         $this->render();
         return redirect()->back()->with('success', 'Successfully Added Gallery Type');
      }
   }

   public function typeEdit(Request $request, $type_id)
   {
      $type = GalleryType::where('id', $type_id)->first();
      $type->title = $request->input('title');
      $type->save();
      $this->render();
      session()->flash('success', 'Gallery Type Successfully updated');
      return response()->json(['success' => true]);
   }

   public function typeDel($type_id)
   {
      GalleryType::where('id', $type_id)->delete();
      session()->flash('delete_success', 'Gallery Type Successfully deleted');
      $this->render();
      return response()->json(['success' => true]);
   }

   public function index($type_id)
   {
      $galleries = DB::table('galleries')->where('gallery_type_id', $type_id)->get();
      $type = DB::table('gallery_types')->where('id', $type_id)->first();
      return view('admin.gallery.index', compact('galleries', 'type'));
   }

   public function add(Request $request, $type_id)
   {
      if (Helper::G()) {
         $type = DB::table('gallery_types')->where('id', $type_id)->first();
         return view('admin.gallery.add', compact('type'));
      } else {
         $gallery = new Gallery();
         if ($request->hasFile('image')) {
            $gallery->image = $request->file('image')->store('uploads/gallery', 'public');
         }
         $gallery->title = $request->title;
         $gallery->description = $request->description;
         $gallery->gallery_type_id = $type_id;
         $gallery->save();
         $this->render();
         $this->renderSingle($type_id);
         return redirect()->back()->with('success', 'Gallery Successfully Added');
      }
   }

   public function edit(Request $request, $gallery_id)
   {
      $gallery = Gallery::find($gallery_id);
      if (Helper::G()) {
         $type = DB::table('gallery_types')->where('id', $gallery->gallery_type_id)->first();
         return view('admin.gallery.edit', compact('gallery', 'type'));
      } else {
         $gallery->title = $request->title;
         $gallery->description = $request->description;
         if ($request->has('image')) {
            $gallery->image = $request->file('image')->store('uploads/gallery', 'public');
         }
         $gallery->save();
         $this->render();
         $this->renderSingle($gallery->gallery_type_id);
         return redirect()->back()->with('success', 'Gallery Successfully Updated');
      }
   }

   public function del($gallery_id)
   {
      $gallery = Gallery::find($gallery_id);
      $gallery->delete();
      $this->render();
      $this->renderSingle($gallery->gallery_type_id);
      return redirect()->back()->with('success', 'Gallery Successfully Deleted');
   }
   public function render()
   {
      $galleryTypes = DB::table('gallery_types')
      ->select(
          'gallery_types.*',
          DB::raw('(SELECT image FROM galleries WHERE galleries.gallery_type_id = gallery_types.id ORDER BY galleries.id ASC LIMIT 1) as image')
      )
      ->get();
      Helper::putCache('gallery.index', view('admin.template.gallery.index', compact('galleryTypes')));
      Helper::putMetaCache('gallery.index', $data = [
         'title' => 'Gallery',
         'description' => 'Galleries of Nobel Hospital.',
         'keywords' => 'nobel gallery, nobel',
         'url' => route('gallery.index')
      ]);
   }

   public function renderSingle($typeId)
   {
      $galleries = Gallery::where('gallery_type_id', $typeId)->get();
      $galleryType = GalleryType::where('id', $typeId)->first();
      
      Helper::putMetaCache('gallery.' . $galleryType->slug, $data = [
         'title' => $galleryType->title,
         'description' => $galleryType->title . ' of Nobel Hospital.',
         'keywords' => $galleryType->title . ', nobel gallery, nobel',
         'url' => route('gallery.single', $galleryType->slug)
      ]);
      Helper::putCache('gallery.' . $galleryType->slug, view('admin.template.gallery.single', compact('galleries')));
   }

}