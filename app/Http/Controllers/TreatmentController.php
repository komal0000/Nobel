<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Speciality;
use App\Models\Treatment;
use App\Models\TreatmentSection;
use App\Models\TreatmentStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function index(Request $request)
    {
        $speciality_id = $request->speciality_id;
        if ($speciality_id) {
            $speciality = Speciality::where('id', $speciality_id)->first();
            $treatments = DB::table('treatments')->where('specialty_id', $speciality_id)->get(['id', 'title', 'short_description']);
            return view('admin.treatment.index', compact('treatments', 'speciality_id', 'speciality'));
        } else {
            $treatments = DB::table('treatments')->get(['id', 'title', 'short_description']);
            return view('admin.treatment.index', compact('treatments', 'speciality_id'));
        }
    }

    public function add(Request $request)
    {
        $speciality_id = $request->speciality_id;
        if (Helper::G($request)) {
            $speciality = Speciality::where('id', $speciality_id)->first();
            return view('admin.treatment.add', compact('speciality_id', 'speciality'));
        } else {
            // dd($request->all());
            $treatment = new Treatment();
            $treatment->title = $request->title;
            $treatment->short_description = $request->short_description;
            $treatment->specialty_id = $request->specialty_id;
            if ($request->has("icon")) {
                $treatment->icon = $request->file('icon')->store('uploads/treatments', 'public');
            }
            if ($request->has("single_page_image")) {
                $treatment->single_page_image = $request->file('single_page_image')->store('uploads/treatments', 'public');
            }
            $treatment->save();
            return redirect()->back()->with("success", "Treatment Successfully Added");
        }
    }

    public function edit(Request $request, $treatment_id)
    {
        $treatment = Treatment::where('id', $treatment_id)->first();
        if (Helper::G($request)) {
            $speciality_id = $request->speciality_id;
            $speciality = Speciality::where('id', $speciality_id)->first();
            return view('admin.treatment.edit', compact('treatment','speciality','speciality_id'));
        } else {
            $treatment->title = $request->title;
            $treatment->short_description = $request->short_description;
            if ($request->has("icon")) {
                $treatment->icon = $request->file('icon')->store('uploads/treatments', 'public');
            }
            if ($request->has("single_page_image")) {
                $treatment->single_page_image = $request->file('single_page_image')->store('uploads/treatments', 'public');
            }
            $treatment->save();
            return redirect()->back()->with("success", "Treatment Successfully Updated");
        }
    }

    public function del($treatment_id)
    {
        $treatmentSections = TreatmentSection::where('treatment_id', $treatment_id)->get();

        if ($treatmentSections->isNotEmpty()) {
            foreach ($treatmentSections as $section) {
                TreatmentStep::where('treatment_section_id', $section->id)->delete();
                $section->delete();
            }
        }
        Treatment::where('id', $treatment_id)->delete();

        return redirect()->back()->with("delete_success", "Treatment Successfully Deleted");
    }
}
