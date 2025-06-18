<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Speciality;
use App\Models\Treatment;
use App\Models\TreatmentSection;
use App\Models\TreatmentStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentSectionController extends Controller
{
    public function index($treatment_id, Request $request)
    {
        $speciality_id = $request->speciality_id;
        $speciality  = Speciality::where('id', $speciality_id)->first();
        $treatment = Treatment::where('id', $treatment_id)->first();
        $treatmentSections = DB::table('treatment_sections')->where('treatment_id', $treatment_id)->get(['id', 'title', 'style_type']);
        return view('admin.treatment.section.index', compact('treatmentSections', 'speciality_id', 'speciality', 'treatment'));
    }

    public function add(Request $request, $treatment_id)
    {
        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $speciality = Speciality::where('id', $speciality_id)->first();
            $treatment = Treatment::where('id', $treatment_id)->first();
            return view('admin.treatment.section.add', compact('speciality_id', 'treatment', 'speciality'));
        } else {
            $treatmentSection = new TreatmentSection();
            $treatmentSection->title = $request->title;
            $treatmentSection->description = $request->description;
            $treatmentSection->style_type = $request->style_type;
            $treatmentSection->treatment_id = $treatment_id;
            $treatmentSection->save();
            $this->render($treatment_id);
            return redirect()->back()->with("success", "Treatment Section Successfully Added");
        }
    }

    public function edit(Request $request, $section_id)
    {
        $treatmentSection = TreatmentSection::where("id", $section_id)->first();
        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $treatment = Treatment::where('id', $treatmentSection->treatment_id)->first();
            return view('admin.treatment.section.edit', compact('treatmentSection', 'speciality_id', 'treatment'));
        } else {
            $treatmentSection->title = $request->title;
            $treatmentSection->description = $request->description;
            $treatmentSection->style_type = $request->style_type;
            $treatmentSection->save();
            $this->render($treatmentSection->treatment_id);
            return redirect()->back()->with("success", "Treatment Section Successfully Updated");
        }
    }

    public function del($section_id)
    {
        TreatmentStep::where('treatment_section_id', $section_id)->delete();
        TreatmentSection::where('id', $section_id)->delete();
        $treatment_id = TreatmentSection::where('id', $section_id)->first('treatment_id');
        $this->render($treatment_id);
        return redirect()->back()->with("delete_success", "Treatment Section Successfully Deleted");
    }

    public function stepIndex($section_id, Request $request)
    {
        $speciality_id = $request->speciality_id;
        $speciality  = Speciality::where('id', $speciality_id)->first();
        $section = TreatmentSection::where('id', $section_id)->first();
        $treatment = Treatment::where('id', $section->treatment_id)->first();
        $SectionSteps = DB::table('treatment_steps')->where('treatment_section_id', $section_id)->get(['id', 'title', 'short_description']);
        return view('admin.treatment.section.step.index', compact('speciality_id', 'speciality', 'section', 'treatment', 'SectionSteps'));
    }

    public function stepAdd(Request $request, $section_id)
    {
        $section = TreatmentSection::where('id', $section_id)->first();

        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $speciality  = Speciality::where('id', $speciality_id)->first();
            $treatment = Treatment::where('id', $section->treatment_id)->first();
            return view('admin.treatment.section.step.add', compact('speciality_id', 'speciality', 'treatment', 'section'));
        } else {
            $SectionStep = new TreatmentStep();
            $SectionStep->title = $request->title;
            $SectionStep->slug = $request->slug;
            if ($request->has('icon')) {
                $SectionStep->icon = $request->file('icon')->store('uploads/steps', 'public');
            }
            $SectionStep->short_description = $request->short_description;
            $SectionStep->description = $request->long_description;
            $SectionStep->treatment_section_id = $section_id;
            $SectionStep->save();
            $this->render($section->treatment_id);
            return redirect()->back()->with("success", "Treatment Step Successfully Added");
        }
    }

    public function stepEdit(Request $request, $step_id)
    {
        $SectionStep = TreatmentStep::where("id", $step_id)->first();
        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $section = TreatmentSection::where('id', $SectionStep->treatment_section_id)->first();
            $speciality  = Speciality::where('id', $speciality_id)->first();
            $treatment = Treatment::where('id', $section->treatment_id)->first();
            return view('admin.treatment.section.step.edit', compact('SectionStep', 'section', 'treatment', 'speciality', 'speciality_id'));
        } else {
            $SectionStep->title = $request->title;
            $SectionStep->slug = $request->slug;
            if ($request->has('icon')) {
                $SectionStep->icon = $request->file('icon')->store('uploads/steps', 'public');
            }
            $SectionStep->short_description = $request->short_description;
            $SectionStep->description = $request->long_description;
            $SectionStep->save();
            $this->render($SectionStep->treatment_section_id);
            return redirect()->back()->with("success", "Treatment Step Successfully Updated");
        }
    }

    public function stepDel($step_id)
    {
        $step = TreatmentStep::findOrFail($step_id);
        $section = TreatmentSection::findOrFail($step->treatment_section_id);
        $step->delete();
        $this->render($section->treatment_id);
        return redirect()->back()->with("delete_success", "Treatment Step Successfully Deleted");
    }


    public function render($treatment_id)
    {
        $treatment = Treatment::findOrFail($treatment_id);
        $treatmentSections = TreatmentSection::where('treatment_id', $treatment_id)->get();
        Helper::putCache('treatment.single.' . $treatment->slug, view('admin.template.treatment.single', compact('treatmentSections', 'treatment'))->render());
    }
}
