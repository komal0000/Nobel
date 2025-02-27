<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Aliment;
use App\Models\AlimentSection;
use App\Models\AlimentSectionType;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlimentController extends Controller
{
    public function index(Request $request)
    {
        $speciality_id = $request->speciality_id;
        $speciality = $speciality_id ? Speciality::find($speciality_id) : null;

        $aliments = $speciality_id
            ? Aliment::where('specialty_id', $speciality_id)->get(['id', 'title', 'short_description'])
            : Aliment::get(['id', 'title', 'short_description']);
        return view('admin.aliment.index', compact('aliments', 'speciality_id', 'speciality'));
    }

    public function add(Request $request)
    {
        $speciality_id = $request->speciality_id;
        if (Helper::G($request)) {
            $speciality = Speciality::where('id', $speciality_id)->first();
            $speciality_section_types = AlimentSectionType::get();
            return view('admin.aliment.add', compact('speciality_id', 'speciality', 'speciality_section_types'));
        } else {

            $aliment = new Aliment();
            $aliment->title = $request->aliment_title;
            $aliment->short_description = $request->aliment_short_description;
            $aliment->specialty_id = $speciality_id ?: null;

            if ($request->hasFile('aliment_icon')) {
                $aliment->icon = $request->file('aliment_icon')->store('uploads/aliments', 'public');
            }

            if ($request->hasFile('aliment_single_page_image')) {
                $aliment->single_page_image = $request->file('aliment_single_page_image')->store('uploads/aliments', 'public');
            }

            $aliment->save();
            if ($request->has('sections') && is_array($request->sections)) {
                foreach ($request->sections as $typeId => $sectionData) {
                    $section = new AlimentSection();
                    $section->aliment_id = $aliment->id;
                    $section->aliment_section_type_id = $typeId;
                    $section->title = isset($sectionData['title']) ? $sectionData['title'] : null;
                    $section->description = isset($sectionData['description']) ? $sectionData['description'] : null;
                    $section->show_on_frontend = isset($sectionData['show_on_frontend']) ? $sectionData['show_on_frontend'] : 0;
                    if ($request->hasFile("sections.$typeId.image")) {
                        $section->image = $request->file("sections.$typeId.image")->store('uploads/aliment_sections', 'public');
                    }

                    $section->save();
                }
            }

            return redirect()->back()->with('success','Aliment Successfully Added');
        }

    }


    public function edit(Request $request, $aliment_id)
    {
        $aliment = Aliment::where('id', $aliment_id)->first();
        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $speciality = Speciality::where('id', $aliment->specialty_id)->first();
            return view('admin.aliment.edit', compact('aliment', 'speciality', 'speciality_id'));
        } else {
            $aliment->title = $request->title;
            $aliment->short_description = $request->short_description;
            if ($request->has("icon")) {
                $aliment->icon = $request->file('icon')->store('uploads/aliments', 'public');
            }
            if ($request->has("single_page_image")) {
                $aliment->single_page_image = $request->file('single_page_image')->store('uploads/aliments', 'public');
            }
            $aliment->save();
            return redirect()->back()->with("success", "Aliment Successfully Updated");
        }
    }

    public function del($aliment_id)
    {
        AlimentSection::where('aliment_id', $aliment_id)->delete();
        Aliment::where('id', $aliment_id)->delete();
        return redirect()->back()->with("delete_success", "Aliment Successfully Deleted");
    }

    public function typeIndex()
    {
        $alimentTypes = DB::table('aliment_section_types')->get();
        return view('admin.aliment.sectionType.index', compact('alimentTypes'));
    }

    public function typeAdd(Request $request)
    {
        if (Helper::g($request)) {
            return view('admin.aliment.sectionType.add');
        } else {
            $alimentType = new AlimentSectionType();
            $alimentType->title = $request->title;
            if ($request->has("icon")) {
                $alimentType->icon = $request->file('icon')->store('uploads/aliment_types', 'public');
            }
            $alimentType->description = $request->description;
            $alimentType->save();
            return redirect()->back()->with("success", "Aliment Type Successfully Added");
        }
    }

    public function typeEdit(Request $request, $type_id)
    {
        $alimentType = AlimentSectionType::where('id', $type_id)->first();
        if (Helper::G($request)) {
            return view('admin.aliment.sectionType.edit', compact('alimentType'));
        } else {
            $alimentType->title = $request->title;
            if ($request->has("icon")) {
                $alimentType->icon = $request->file('icon')->store('uploads/aliment_types', 'public');
            }
            $alimentType->description = $request->description;
            $alimentType->save();
            return redirect()->back()->with("success", "Aliment Type Successfully Updated");
        }
    }

    public function typeDel($type_id)
    {
        AlimentSectionType::where('id', $type_id)->delete();
        return redirect()->back()->with("delete_success", "Aliment Type Successfully Deleted");
    }

    public function sectionIndex($aliment_id, Request $request)
    {
        $speciality_id = $request->speciality_id;
        $sections = AlimentSection::where('aliment_id', $aliment_id)->get();
        $aliment = Aliment::where('id', $aliment_id)->first();
        $speciality = Speciality::where('id', $speciality_id)->first();

        return view('admin.aliment.section.index', compact('sections', 'speciality_id', 'speciality', 'aliment_id', 'aliment'));
    }

    public function sectionAdd(Request $request, $aliment_id)
    {
        if (Helper::G($request)) {
            $alimentSectionTypes = DB::table('aliment_section_types')->get();
            $speciality_id = $request->speciality_id;
            $aliment = Aliment::where('id', $aliment_id)->first();
            $speciality = Speciality::where('id', $aliment->specialty_id)->first();
            return view('admin.aliment.section.add', compact('aliment_id', 'speciality_id', 'alimentSectionTypes', 'speciality', 'aliment'));
        } else {
            $section = new AlimentSection();
            $section->title = $request->title;
            $section->description = $request->description;
            $section->show_on_frontend = $request->show_on_frontend;
            $section->aliment_id = $aliment_id;
            $section->aliment_section_type_id = $request->section_type_id;
            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('uploads/section', 'public');
            }
            $section->save();
            return redirect()->back()->with("success", "Aliment Section Successfully Added");
        }
    }

    public function sectionEdit(Request $request, $section_id)
    {
        $section = AlimentSection::where('id', $section_id)->first();
        if (Helper::G($request)) {
            $alimentSectionTypes = DB::table('aliment_section_types')->get();
            $speciality_id = $request->speciality_id;
            $aliment = Aliment::where('id', $section->aliment_id)->first();
            $speciality = Speciality::where('id', $aliment->specialty_id)->first();
            return view('admin.aliment.section.edit', compact('section_id', 'section', 'speciality_id', 'alimentSectionTypes', 'aliment', 'speciality'));
        } else {
            $section->title = $request->title;
            $section->description = $request->description;
            $section->show_on_frontend = $request->show_on_frontend;
            $section->aliment_section_type_id = $request->section_type_id;
            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('uploads/section', 'public');
            }
            $section->save();
            return redirect()->back()->with("success", "Aliment Section Successfully Updated");
        }
    }

    public function sectionDel($section_id)
    {
        DB::table('aliment_sections')->where('id', $section_id)->delete();
        return redirect()->back()->with("delete_success", "Aliment Section Successfully Deleted");
    }
}
