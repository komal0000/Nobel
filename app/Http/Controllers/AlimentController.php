<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Aliment;
use App\Models\AlimentSection;
use App\Models\AlimentSectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlimentController extends Controller
{
    public function index(Request $request)
    {
        $speciality_id = $request->speciality_id;
        if ($speciality_id) {
            $aliments = DB::table('aliments')->where('specialty_id', $speciality_id)->get(['id', 'title', 'short_description']);
        } else {
            $aliments = DB::table('aliments')->get(['id', 'title', 'short_description']);
        }
        return view('admin.aliment.index', compact('aliments', 'speciality_id'));
    }

    public function add(Request $request)
    {
        $speciality_id = $request->speciality_id;
        if (Helper::G($request)) {
            return view('admin.aliment.add', compact('speciality_id'));
        } else {
            $aliment = new Aliment();
            $aliment->title = $request->title;
            $aliment->short_description = $request->short_description;
            $aliment->specialty_id = $request->speciality_id ? $request->speciality_id : null;
            if ($request->has("icon")) {
                $aliment->icon = $request->file('icon')->store('uploads/aliments', 'public');
            }
            if ($request->has("single_page_image")) {
                $aliment->single_page_image = $request->file('single_page_image')->store('uploads/aliments', 'public');
            }
            $aliment->save();
            return redirect()->back()->with("success", "Aliment Successfully Added");
        }
    }

    public function edit(Request $request, $aliment_id)
    {
        $aliment = Aliment::where('id', $aliment_id)->first();
        if (Helper::G($request)) {
            return view('admin.aliment.edit', compact('aliment'));
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
            return redirect()->back()->with("success","Aliment Successfully Updated");
        }
    }

    public function del($aliment_id)
    {
        AlimentSection::where('aliment_id',$aliment_id)->delete();
        Aliment::where('id', $aliment_id)->delete();
        return redirect()->back();
    }


    public function typeIndex()
    {
        $alimentTypes = DB::table('aliment_section_types')->get();
        return view('admin.aliment.sectionType.index', compact('alimentTypes'));
    }

    public function typeAdd(Request $request,)
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
            return redirect()->back();
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
            return redirect()->back();
        }
    }
    public function typeDel($type_id)
    {
        AlimentSectionType::where('id', $type_id)->delete();
        return redirect()->back();
    }


    public function sectionIndex($aliment_id, Request $request)
    {
        $sections = AlimentSection::where('aliment_id', $aliment_id)->get();
        return view('admin.aliment.section.index', compact('sections', 'aliment_id'));
    }
    public function sectionAdd(Request $request, $aliment_id)
    {
        if (Helper::G($request)) {
            $alimentSectionTypes = DB::table('aliment_section_types')->get();
            return view('admin.aliment.section.add', compact('aliment_id', 'alimentSectionTypes'));
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
            return redirect()->back();
        }
    }

    public function sectionEdit(Request $request, $section_id)
    {
        $section = AlimentSection::where('id', $section_id)->first();
        if (Helper::G($request)) {
            return view('admin.aliment.section.edit', compact('section_id'));
        } else {
            $section->title = $request->title;
            $section->description = $request->description;
            $section->show_on_frontend = $request->show_on_frontend;
            if ($request->hasFile('image')) {
                $section->image = $request->file('image')->store('uploads/section', 'public');
            }
            $section->save();
            return redirect()->back();
        }
    }
    public function sectionDel($section_id)
    {
        DB::table('aliment_sections')->where('id', $section_id)->delete();
        return redirect()->back();
    }
}
