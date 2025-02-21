<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\TreatmentSection;
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
}
