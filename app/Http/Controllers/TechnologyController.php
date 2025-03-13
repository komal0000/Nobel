<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Technology;
use App\Models\TechnologySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {

        $technologies = DB::table('technologies')->get();
        return view('admin.technology.index', compact('technologies'));
    }
    public function add(Request $request)
    {
        if (Helper::G()) {
            $technologySectionTypes = DB::table('technology_section_types')->get();
            $specialities = DB::table('specialties')->get();
            return view('admin.technology.add',compact('specialities','technologySectionTypes'));
        } else {
            $technology = new Technology();
            $technology->title = $request->technology_title;
            $technology->short_description = $request->technology_short_description;
            $technology->specialty_id = $request->specialty_id;
            $technology->save();
            if ($request->has('sections') && is_array($request->sections)) {
                foreach ($request->sections as $typeId => $sectionData) {
                    $section = TechnologySection::where('technology_section_type_id', $typeId)->where('technology_id', $technology->id)->first();
                    if (!$section) {
                        $section = new TechnologySection();
                        $section->technology_id = $technology->id;
                        $section->technology_section_type_id = $typeId;
                    }
                    $section->title = $sectionData['title'];
                    $section->short_description = $sectionData['short_description'];
                    $section->design_type = $sectionData['designType'];
                    if ($request->hasFile("sections.$typeId.image")) {
                        $section->image = $request->file("sections.$typeId.image")->store('uploads/technology_sections', 'public');
                    }
                    $section->save();
                }
            }
            session()->flash('success', 'Technology Successfully updated');
            return response()->json(['success' => true]);
        }
    }

    public function edit(Request $request, $technology_id)
    {
        $technology = Technology::where('id', $technology_id)->first();
        if (Helper::g()) {
            $specialities = DB::table('specialties')->get();
            return view('admin.technology.edit', compact('technology','specialities'));
        } else {
            $technology->title = $request->title;
            $technology->short_description = $request->short_description;
            $technology->save();
            return redirect()->back()->with('success', 'Technology successf Updated');
        }
    }

    public function del($technology_id)
    {
        TechnologySection::where('technology_id',$technology_id)->delete();
        Technology::where('id', $technology_id)->delete();
        return redirect()->back()->with('delete_success', 'Successfully Technology Deleted');
    }
}
