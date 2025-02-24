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
    public function index()
    {
        $aliments = DB::table('aliments')->get(['id', 'title', 'short_description']);
        return view('admin.aliment.index', compact('aliments'));
    }

    public function add(Request $request,$speciality_id)
    {
        if (Helper::G($request)) {
            return view('admin.aliment.add',compact('speciality_id'));
        } else {
            $aliment = new Aliment();
            $aliment->title = $request->title;
            $aliment->short_description = $request->short_description;
            $aliment->specialty_id = $request->speciality_id;
            if ($request->has("icon")) {
                $aliment->icon = $request->file('icon')->store('uploads/aliments', 'public');
            }
            if ($request->has("single_page_image")) {
                $aliment->single_page_image = $request->file('single_page_image')->store('uploads/aliments', 'public');
            }
            $aliment->save();
            return redirect()->back();
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
            return redirect()->back();
        }
    }

    public function del($aliment_id)
    {
        $types = AlimentSectionType::where('aliment_id', $aliment_id)->get();
        if ($types->isNotEmpty()) {
            foreach ($types as $type) {
                AlimentSection::where('aliment_section_type_id', $type->id)->delete();
                $type->delete();
            }
        }
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


    public function sectionIndex($type_id, Request $request)
    {
        $section = AlimentSection::where('aliment_section_type_id', $type_id)->first();
        $alimentType = AlimentSectionType::find($type_id);
        if (Helper::G($request)) {
            $type = AlimentSectionType::find($type_id);
            return view('admin.aliment.type.section.index', compact('section', 'type_id', 'type', 'alimentType'));
        } else {
            if ($section) {
                $section->title = $request->title;
                $section->description = $request->description;
                $section->show_on_frontend = $request->show_on_frontend;
                if ($request->hasFile('image')) {
                    $section->image = $request->file('image')->store('uploads/section', 'public');
                }

                $section->save();
            } else {
                $section = new AlimentSection();
                $section->title = $request->title;
                $section->description = $request->description;
                $section->show_on_frontend = $request->show_on_frontend;
                $section->aliment_id = $alimentType->aliment_id;
                $section->aliment_section_type_id = $type_id;

                if ($request->hasFile('image')) {
                    $section->image = $request->file('image')->store('uploads/section', 'public');
                }

                $section->save();
            }
        }

        return redirect()->back()->with('success', 'Section updated successfully.');
    }


    public function sectionDel($section_id)
    {
        DB::table('aliment_sections')->where('id', $section_id)->delete();
        return redirect()->back();
    }
}
