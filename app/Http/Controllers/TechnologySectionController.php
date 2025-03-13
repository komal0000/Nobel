<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\TechnologySection;
use App\Models\TechnologySectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnologySectionController extends Controller
{
    public function typeIndex(Request $request)
    {
        if (Helper::G()) {
            $techSectionTypes = DB::table('technology_section_types')->get();
            return view('admin.technology.section.type.index', compact('techSectionTypes'));
        } else {
            $techSectionType = new TechnologySectionType();
            $techSectionType->title = $request->title;
            $techSectionType->short_description = $request->short_description;
            $techSectionType->save();
            return redirect()->back()->with('success', 'Technology Section Type Successfully Added');
        }
    }

    public function typeEdit(Request $request, $type_id)
    {
        $techSectionType = TechnologySectionType::where('id', $type_id)->first();
        $techSectionType->title = $request->title;
        $techSectionType->short_description = $request->short_description;
        $techSectionType->save();
        session()->flash('success', 'Technology Section Type Successfully updated');
        return response()->json(['success' => true]);
    }

    public function typeDel($type_id){
        TechnologySectionType::where('id', $type_id)->delete();
        return response()->json(['success' => true]);
    }
}
