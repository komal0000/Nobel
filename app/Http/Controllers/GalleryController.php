<?php

namespace App\Http\Controllers;

use App\Helper;
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
            return redirect()->back()->with('success', 'Successfully Added Gallery Type');
        }
    }

    public function typeEdit(Request $request, $type_id)
    {
        $type = GalleryType::where('id', $type_id)->first();
        $type->title = $request->input('title');
        $type->save();
        session()->flash('success', 'Gallery Type Successfully updated');
        return response()->json(['success' => true]);
    }

    public function typeDel($type_id)
    {
        GalleryType::where('id', $type_id)->delete();
        session()->flash('delete_success', 'Gallery Type Successfully deleted');
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
            // Add gallery logic would go here
            // Would need to know gallery table structure
        }
    }

    public function edit(Request $request, $gallery_id)
    {
        // Edit gallery logic would go here
        // Would need to know gallery table structure
    }

    public function del($gallery_id)
    {
        // Delete gallery logic would go here
        // Would need to know gallery table structure
    }
}
