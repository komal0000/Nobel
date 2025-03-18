<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Technology;
use App\Models\TechnologySection;
use App\Models\TechnologySectionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {

        $technologies = DB::table('technologies')->get();
        // dd($technologies);
        return view('admin.technology.index', compact('technologies'));
    }
    public function add(Request $request)
    {
        if (Helper::G()) {
            $technologySectionTypes = DB::table('technology_section_types')->get();
            $specialities = DB::table('specialties')->get();
            return view('admin.technology.add', compact('specialities', 'technologySectionTypes'));
        } else {
            // dd($request->all());
            $technology = new Technology();
            $technology->title = $request->technology_title;
            $technology->short_description = $request->technology_short_description;
            $technology->specialty_id = $request->specialty_id;
            $technology->save();
            if ($request->has('sections') && is_array($request->sections)) {
                foreach ($request->sections as $typeId => $sectionData) {
                    $section = new TechnologySection();
                    $section->technology_id = $technology->id;
                    $section->technology_section_type_id = $typeId;
                    $section->title = $sectionData['title'];
                    $section->short_description = $sectionData['short_description'];
                    $section->design_type = $sectionData['designType'];

                    if ($request->hasFile("sections.$typeId.image")) {
                        $section->image = $request->file("sections.$typeId.image")
                            ->store('uploads/technology_sections', 'public');
                    }
                    $section->save();

                    if (
                        isset($sectionData['section_title']) ||
                        isset($sectionData['section_short_description']) ||
                        isset($sectionData['section_long_description']) ||
                        $request->hasFile("sections.$typeId.section_image")
                    ) {
                        $sectionDataRecord = new TechnologySectionData();
                        $sectionDataRecord->technology_id = $technology->id;
                        $sectionDataRecord->technology_section_type_id = $typeId;
                        $sectionDataRecord->technology_section_id = $section->id;
                        $sectionDataRecord->title = $sectionData['section_title'] ?? $sectionDataRecord->section_title;
                        $sectionDataRecord->short_description = $sectionData['section_short_description'] ?? $sectionDataRecord->section_short_description;
                        $sectionDataRecord->long_description = $sectionData['section_long_description'] ?? $sectionDataRecord->section_long_description;

                        if ($request->hasFile("sections.$typeId.section_image")) {
                            $sectionDataRecord->image = $request->file("sections.$typeId.section_image")
                                ->store('uploads/technology_section_data', 'public');
                        }
                        $sectionDataRecord->save();
                    }
                }
            }

            session()->flash('success', 'Technology Successfully Added');
            return response()->json(['success' => true]);
        }
    }

    public function edit(Request $request, $technology_id)
    {
        $technology = Technology::findOrFail($technology_id);

        if (Helper::G()) {
            $specialities = DB::table('specialties')->get();
            $technologySectionTypes = DB::table('technology_section_types')->get();
            return view('admin.technology.edit', compact('technology', 'technology_id', 'specialities', 'technologySectionTypes'));
        } else {
            $technology->title = $request->technology_title;
            $technology->short_description = $request->technology_short_description;
            $technology->specialty_id = $request->specialty_id;
            $technology->save();
            if ($request->has('sections') && is_array($request->sections)) {
                foreach ($request->sections as $typeId => $sectionData) {
                    // Find the existing section or create a new one if it doesn't exist
                    $section = TechnologySection::where('technology_section_type_id', $typeId)
                                ->where('technology_id', $technology->id)
                                ->first();
                    $section->title = $sectionData['title'];
                    $section->short_description = $sectionData['short_description'];
                    $section->design_type = $sectionData['designType'];

                    if ($request->hasFile("sections.$typeId.image")) {
                        $section->image = $request->file("sections.$typeId.image")
                            ->store('uploads/technology_sections', 'public');
                    }
                    $section->save();

                    // Update or create additional section data in technology_section_datas table
                    if (
                        isset($sectionData['section_title']) ||
                        isset($sectionData['section_short_description']) ||
                        isset($sectionData['section_long_description']) ||
                        $request->hasFile("sections.$typeId.section_image")
                    ) {
                        $sectionDataRecord = TechnologySectionData::where('technology_section_id', $section->id)
                            ->where('technology_id', $technology->id)
                            ->where('technology_section_type_id', $typeId)
                            ->first();
                        $sectionDataRecord->title = $sectionData['section_title'] ?? $sectionDataRecord->section_title;
                        $sectionDataRecord->short_description = $sectionData['section_short_description'] ?? $sectionDataRecord->section_short_description;
                        $sectionDataRecord->long_description = $sectionData['section_long_description'] ?? $sectionDataRecord->section_long_description;

                        if ($request->hasFile("sections.$typeId.section_image")) {
                            $sectionDataRecord->image = $request->file("sections.$typeId.section_image")
                                ->store('uploads/technology_section_data', 'public');
                        }

                        $sectionDataRecord->technology_section_id = $section->id;
                        $sectionDataRecord->save();
                    }
                }
            }
            session()->flash('success', 'Technology Successfully updated');
            return response()->json(['success' => true]);
        }
    }


    public function del($technology_id)
    {
        TechnologySectionData::where('technology_id',$technology_id)->delete();
        TechnologySection::where('technology_id',$technology_id)->delete();
        Technology::where('id', $technology_id)->delete();
        return redirect()->back()->with('delete_success', 'Successfully Technology Deleted');
    }
}
