<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\DoctorSpeciality;
use App\Models\Speciality;
use App\Models\SpecialityGallery;
use App\Models\SpecialityGalleryItem;
use App\Models\SpecialityTeamHead;
use App\Models\Technology;
use App\Models\TechnologySection;
use App\Models\TechnologySectionData;
use App\Models\Treatment;
use App\Models\TreatmentSection;
use App\Models\TreatmentStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
{
    public function index(Request $request)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        if ($parent_speciality_id) {
            $specialties = Speciality::where('parent_speciality_id', $parent_speciality_id)->get(['id', 'title', 'short_description']);
        } else {
            $specialties = Speciality::wherenull('parent_speciality_id')->get(['id', 'title', 'short_description']);
        }
        return view('admin.speciality.index', compact('specialties', 'parent_speciality_id'));
    }

    public function add(Request $request)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        if (Helper::G($request)) {
            return view('admin.speciality.add', compact('parent_speciality_id'));
        } else {
            $speciality = new Speciality();
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;
            $speciality->parent_speciality_id = $request->parent_speciality_id;

            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images', 'public');
            }

            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images', 'public');
            }
            $speciality->save();
            $this->render();
            $this->renderSingle($speciality->id);
            return redirect()->back()->with("success", "Speciality Successfully Added");
        }
    }

    public function edit(Request $request, $speciality_id)
    {
        $parent_speciality_id = $request->parent_speciality_id;
        $speciality = Speciality::where("id", $speciality_id)->first();

        if (Helper::G($request)) {
            return view('admin.speciality.edit', compact('speciality', 'parent_speciality_id'));
        } else {
            $speciality->title = $request->title;
            $speciality->short_description = $request->short_description;
            if ($request->hasFile('icon')) {
                $speciality->icon = $request->file('icon')->store('uploads/images', 'public');
            }
            if ($request->hasFile('single_page_image')) {
                $speciality->single_page_image = $request->file('single_page_image')->store('uploads/images', 'public');
            }
            $speciality->save();
            $this->render();
            $this->renderSingle($speciality->id);
            return redirect()->back()->with("success", "Speciality Successfully Updated");
        }
    }

    public function del($speciality_id)
    {
        $SpecialityGalleries = SpecialityGallery::where('specialty_id', $speciality_id)->get();
        $technology = Technology::where('specialty_id', $speciality_id)->first();
        $treatment = Treatment::where('specialty_id', $speciality_id)->first();

        if ($treatment) {
            $treatmentSection = TreatmentSection::where('treatment_id', $treatment->id)->first();
            TreatmentStep::where('treatment_section_id', $treatmentSection->id)->delete();
            $treatmentSection->delete();
            $treatment->delete();
        }
        if ($SpecialityGalleries->isNotEmpty()) {
            foreach ($SpecialityGalleries as $gallery) {
                SpecialityGalleryItem::where('speciality_gallery_id', $gallery->id)->delete();
                $gallery->delete();
            }
        }
        Speciality::where('parent_speciality_id', $speciality_id)->delete();
        if ($technology) {
            $technology_id = $technology->id;
            TechnologySectionData::where('technology_id', $technology_id)->delete();
            TechnologySection::where('technology_id', $technology_id)->delete();
            Technology::where('id', $technology_id)->delete();
        }
        DoctorSpeciality::where('speciality_id', $speciality_id)->delete();
        Speciality::where('id', $speciality_id)->delete();
        $this->render();
        $this->renderSingle($speciality_id);
        return redirect()->back()->with("delete_success", "Speciality Successfully Deleted");
    }
    public function teamHeadIndex(Request $request, $speciality_id)
    {
        $speciality = DB::table('specialties')->where('id', $speciality_id)->first();
        if (Helper::G()) {
            $doctors = DB::table('doctors')->get();
            $teamHeads = DB::table('speciality_team_heads')->where('specialty_id', $speciality_id)->get();
            return view('admin.speciality.teamHead.index', compact('speciality', 'doctors', 'teamHeads'));
        } else {
            $teamHead = new SpecialityTeamHead();
            $teamHead->specialty_id = $speciality_id;
            $teamHead->doctor_id = $request->doctor_id;
            $doctor = DB::table('doctors')->where('id', $request->doctor_id)->first();
            $teamHead->name = $doctor->title;
            $teamHead->save();
            $this->renderTeamHead($speciality_id);
            return redirect()->back()->with('success', 'Team Head Successfully Added');
        }
    }
    public function teamHeadDel($team_head_id, $speciality_id)
    {
        SpecialityTeamHead::where('id', $team_head_id)->delete();
        $this->renderTeamHead($speciality_id);
        return response()->json(['status' => 'success']);
    }

    public function renderSingle($speciality_id)
    {
        $speciality = DB::table('specialties')->find($speciality_id);
        if (!$speciality) {
            Helper::putCache('speciality.single.' . $speciality_id . '.overview', null);
            return;
        }
        if ($speciality->parent_speciality_id) {
            $parentSpeciality = DB::table('specialties')->find($speciality->parent_speciality_id);
            Helper::putCache('speciality.single.' . $speciality->parent_speciality_id . '.subspecialization', view('admin.template.speciality.subspecialization', [
                'speciality' => $parentSpeciality
            ])->render());
            $this->renderSingle($speciality->parent_speciality_id);
        }

        Helper::putCache('speciality.single.' . $speciality_id . '.overview', view('admin.template.speciality.overview', compact('speciality'))->render());
    }

    public function renderTeamHead($speciality_id)
    {
        $teamHead = DB::table('speciality_team_heads')->where('specialty_id', $speciality_id)->first();
        Helper::putCache('speciality.single.'.$speciality_id.'.message', view('admin.template.speciality.teamHead', compact('teamHead'))->render());
    }

    public function render()
    {
        $specialities = DB::table('specialties')->whereNull('parent_speciality_id')->get(['id', 'title', 'icon']);
        Helper::putCache('home.speciality', view('admin.template.home.speciality', compact('specialities'))->render());
        Helper::putCache('home.teams', view('admin.template.home.teams', compact('specialities'))->render());
        Helper::putCache('home.header', view('admin.template.home.header', compact('specialities'))->render());
        Helper::putCache('home.footer', view('admin.template.home.footer', compact('specialities'))->render());
        Helper::putCache('speciality.index', view('admin.template.speciality.index', compact('specialities'))->render());
    }
}
