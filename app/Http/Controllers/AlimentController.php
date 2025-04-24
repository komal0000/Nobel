<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Aliment;
use App\Models\AlimentSection;
use App\Models\AlimentSectionType;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        if (Helper::G()) {
            $speciality = Speciality::where('id', $speciality_id)->first();
            $speciality_section_types = AlimentSectionType::get();
            return view('admin.aliment.add', compact('speciality_id', 'speciality', 'speciality_section_types'));
        } else {
            $aliment = new Aliment();
            $aliment->title = $request->aliment_title;
            $aliment->short_description = $request->aliment_short_description;
            $aliment->specialty_id = $request->specialty_id;
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
            $this->render($aliment->id, $aliment->specialty_id);
            session()->flash('success', 'Ailment Successfully Added');
            return response()->json(['success' => true]);
        }
    }


    public function edit(Request $request, $aliment_id)
    {
        $aliment = Aliment::where('id', $aliment_id)->first();

        if (Helper::G()) {
            $speciality_id = $request->speciality_id;
            $speciality_section_types = AlimentSectionType::get();
            $speciality = Speciality::where('id', $aliment->specialty_id)->first();
            return view('admin.aliment.edit', compact('aliment', 'speciality', 'speciality_id', 'speciality_section_types'));
        } else {
            $aliment->title = $request->aliment_title;
            $aliment->short_description = $request->aliment_short_description;

            if ($request->hasFile("aliment_icon")) {
                $aliment->icon = $request->file('aliment_icon')->store('uploads/aliments', 'public');
            }
            if ($request->hasFile("aliment_single_page_image")) {
                $aliment->single_page_image = $request->file('aliment_single_page_image')->store('uploads/aliments', 'public');
            }
            $aliment->save();

            if ($request->has('sections') && is_array($request->sections)) {
                foreach ($request->sections as $typeId => $sectionData) {
                    $section = AlimentSection::where('aliment_section_type_id', $typeId)->where('aliment_id', $aliment->id)->first();
                    if (!$section) {
                        $section = new AlimentSection();
                        $section->aliment_id = $aliment->id;
                        $section->aliment_section_type_id = $typeId;
                    }
                    $section->title = $sectionData['title'];
                    $section->description = $sectionData['description'];
                    $section->show_on_frontend = isset($sectionData['show_on_frontend']) ? $sectionData['show_on_frontend'] : 0;

                    if ($request->hasFile("sections.$typeId.image")) {
                        $section->image = $request->file("sections.$typeId.image")->store('uploads/aliment_sections', 'public');
                    }

                    $section->save();
                }
            }
            $this->render($aliment->id, $aliment->specialty_id);
            session()->flash('success', 'Award Successfully updated');
            return response()->json(['success' => true]);
        }
    }


    public function del($aliment_id)
    {
        $aliment = Aliment::where('id', $aliment_id)->first();
        AlimentSection::where('aliment_id', $aliment_id)->delete();
        $aliment->delete();
        $this->render($aliment_id, $aliment->specialty_id);
        return redirect()->back()->with("delete_success", "Aliment Successfully Deleted");
    }

    public function typeIndex()
    {
        $alimentTypes = DB::table('aliment_section_types')->get();
        return view('admin.aliment.sectionType.index', compact('alimentTypes'));
    }

    public function typeAdd(Request $request)
    {
        if (Helper::G()) {
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
        if (Helper::G()) {
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

    public function render($aliment_id, $speciality_id)
    {
        if ($speciality_id) {
            $specialityAliments = Aliment::where('specialty_id', $speciality_id)->get();
            Helper::putCache('speciality.single.' . $speciality_id . '.aliment.', view('admin.template.speciality.single.aliment', compact('specialityAliments'))->render());
        }
        $aliments = Aliment::get();
        $aliment = Aliment::where('id', $aliment_id)->first();
        if ($aliment) {
            $alimentTypes = DB::table('aliment_section_types')->get();

            Helper::putMetaCache('aliment.' . $aliment->slug, $data = [
                'title' => $aliment->title,
                'description' => $aliment->short_description,
                'image' => asset(asset($aliment->single_page_image)),
                'url' => route('aliment.single', ['slug' => $aliment->slug]),
            ]);

            Helper::putCache('aliment.single.' . $aliment->id, view('admin.template.aliment.single', compact('aliment','alimentTypes'))->render());
        }
        Helper::putCache('aliment.index', view('admin.template.aliment.index', compact('aliments'))->render());
    }
}
