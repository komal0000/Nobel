<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Treatment;
use App\Models\TreatmentSection;
use App\Models\TreatmentStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentSectionController extends Controller
{
    public function index($treatment_id)
    {
        $treatmentSections = DB::table('treatment_sections')->get(['id','title','style_type']);
        return view('admin.treatment.section.index', compact('treatmentSections','treatment_id'));
    }

    public function add(Request $request, $treatment_id)
    {
        if (Helper::G($request)) {
            return view('admin.treatment.section.add',compact('treatment_id'));
        } else {
            $treatmentSection = new TreatmentSection();
            $treatmentSection->title = $request->title;
            $treatmentSection->description = $request->description;
            $treatmentSection->style_type = $request->style_type;
            $treatmentSection->treatment_id = $treatment_id;
            $treatmentSection->save();
            return redirect()->back();
        }
    }
    public function edit(Request $request, $section_id)
    {
        $treatmentSection = TreatmentSection::where("id",$section_id)->first();

        if (Helper::G($request)) {
            return view('admin.treatment.section.edit', compact('treatmentSection'));
        } else {
            $treatmentSection->title = $request->title;
            $treatmentSection->description = $request->description;
            $treatmentSection->style_type = $request->style_type;
            $treatmentSection->save();
            return redirect()->back();
        }
    }
    public function del($section_id){
        TreatmentSection::where('id',$section_id)->delete();
        return redirect()->back();
    }

    public function stepIndex($section_id){
        $section = TreatmentSection::where('id',$section_id)->first();
        $SectionSteps = DB::table('treatment_steps')->get(['id','title','short_description']);
        return view('admin.treatment.section.step.index',compact('section_id','section','SectionSteps'));
    }

    public function stepAdd(Request  $request , $section_id)
    {
        $section = TreatmentSection::where('id',$section_id)->first();
        if(Helper::G($request)){
            return view('admin.treatment.section.step.add',compact('section_id','section'));
        }else{
            $SectionStep = new TreatmentStep();
            $SectionStep->title = $request->title;
            $SectionStep->slug = $request->slug;
            if($request->has('icon')){
                $SectionStep->icon = $request->file('icon')->store('uploads/steps','public');
            }
            $SectionStep->short_description = $request->short_description;
            $SectionStep->long_description = $request->long_description;
            $SectionStep->treatment_section_id = $section_id;
            $SectionStep->save();
            return redirect()->back();
        }
    }
    public function stepEdit(Request $request, $step_id)
    {
        $SectionStep = TreatmentStep::where("id", $step_id)->first();

        if (Helper::G($request)) {
            $section = TreatmentSection::where('id',$SectionStep->treatment_section_id)->first();
            return view('admin.treatment.section.step.edit', compact('SectionStep','section'));
        } else {
            $SectionStep->title = $request->title;
            $SectionStep->slug = $request->slug;
            if ($request->has('icon')) {
                $SectionStep->icon = $request->file('icon')->store('uploads/steps', 'public');
            }
            $SectionStep->short_description = $request->short_description;
            $SectionStep->long_description = $request->long_description;
            $SectionStep->save();
            return redirect()->back();
        }
    }
    public function stepDel($step_id){
        TreatmentStep::where("id", $step_id)->delete();
    }
}
