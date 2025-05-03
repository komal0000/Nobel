<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Doctor;
use App\Models\DoctorSpeciality;
use App\Models\Milestone;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = DB::table(Doctor::table_name)->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
            return view('admin.doctor.add', compact('specialties'));
        } else {
            $doctor = new Doctor();
            $doctor->title = $request->input('title');
            $doctor->position = $request->input('position');
            $doctor->location = $request->input('location');
            $doctor->qualification = json_encode(array_filter($request->input('qualification', [])));
            $doctor->short_description = $request->input('short_description');
            if ($request->hasFile('image')) {
                $doctor->image = $request->file('image')->store('uploads/doctors', 'public');
            }
            $doctor->save();
            if ($request->has('doctorSpeciality')) {
                foreach ($request->doctorSpeciality as $specialityId) {
                    $doctorSpeciality = new DoctorSpeciality();
                    $doctorSpeciality->doctor_id = $doctor->id;
                    $doctorSpeciality->speciality_id = $specialityId;
                    $doctorSpeciality->speciality_name = DB::table('specialties')->where('id', $specialityId)->value('title');
                    $doctorSpeciality->save();
                }
            }

            $this->render();
            $this->singleRender($doctor->id);
            return redirect()->back()->with('success', 'Doctor added successfully');
        }
    }

    public function edit(Request $request, $doctor_id)
    {
        $doctor = Doctor::where('id', $doctor_id)->first();
        if (Helper::G()) {
            $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
            $doctorSpecialities = DB::table('doctor_specialities')->where('doctor_id', $doctor_id)->get();
            return view('admin.doctor.edit', compact('doctor', 'specialties', 'doctorSpecialities'));
        } else {
            $doctor->title = $request->input('title');
            $doctor->position = $request->input('position');
            $doctor->location = $request->input('location');
            $doctor->qualification = json_encode(array_filter($request->input('qualification', [])));
            $doctor->short_description = $request->input('short_description');
            if ($request->hasFile('image')) {
                $doctor->image = $request->file('image')->store('uploads/doctors', 'public');
            }

            $doctor->save();
            if ($request->has('doctorSpeciality')) {
                foreach ($request->doctorSpeciality as $specialityId) {
                    $doctorSpeciality = DoctorSpeciality::where('doctor_id', $doctor->id)->where('speciality_id', $specialityId)->first();
                    if (!$doctorSpeciality) {
                        $doctorSpeciality = new DoctorSpeciality();
                    }
                    $doctorSpeciality->doctor_id = $doctor->id;
                    $doctorSpeciality->speciality_id = $specialityId;
                    $doctorSpeciality->speciality_name = DB::table('specialties')->where('id', $specialityId)->value('title');
                    $doctorSpeciality->save();
                }
            }
            $this->render();
            $this->singleRender($doctor->id);
            return redirect()->back()->with('success', 'Doctor updated successfully');
        }
    }
    public function del($doctor_id)
    {
        Doctor::where('id', $doctor_id)->delete();
        $this->render();
        $this->singleRender($doctor_id);
        return redirect()->back()->with('delete_success', 'Doctor deleted successfully');
    }

    public function specialityDel($doctor_id, $speciality_id)
    {
        DoctorSpeciality::where('doctor_id', $doctor_id)->where('speciality_id', $speciality_id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function milestoneIndex(Request $request, $doctor_id)
    {
        if (Helper::G()) {
            $doctor = Doctor::where('id', $doctor_id)->first();
            $milestones = DB::table('milestones')->where('doctor_id', $doctor_id)->get();
            return view('admin.doctor.milestone.index', compact('doctor', 'milestones'));
        } else {
            $milestone = new Milestone();
            $milestone->doctor_id = $doctor_id;
            $milestone->year = $request->input('year');
            $milestone->description = $request->input('description');
            $milestone->save();
            return redirect()->back()->with('success', 'Milestone added successfully');
        }
    }
    public function milestoneEdit(Request $request, $milestone_id)
    {
        $milestone = Milestone::where('id', $milestone_id)->first();
        $milestone->year = $request->input('year');
        $milestone->description = $request->input('description');
        $milestone->save();
        return response()->json([
            'success' => true,
        ]);
    }

    public function milestoneDel($milestone_id)
    {
        Milestone::where('id', $milestone_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Milestone deleted successfully'
        ]);
    }

    public function singleRender($doctor_id)
    {
        $doctor = Doctor::where('id', $doctor_id)->first();
        Helper::putMetaCache('doctor.'.$doctor->slug, $data = [
            'title' => $doctor->title,
            'description' => $doctor->short_description,
            'image' => asset(asset($doctor->image)),
            'url' => route('doctor.single', ['slug' => $doctor->slug]),
        ]);
        $doctorSpecialities = DB::table('doctor_specialities')->where('doctor_id', $doctor_id)->get();
        $doctorMilestones = DB::table('milestones')->where('doctor_id', $doctor_id)->get();
        $videoType = DB::table('video_types')->where('doctor_id', $doctor_id)->first();
        if ($videoType) {
            $videos = DB::table('videos')->where('video_type_id', $videoType->id)->get();
            Helper::putCache('doctor.videos.' . $doctor->slug, view('admin.template.doctor.videos', compact('videos'))->render());
        }
        Helper::putCache('doctor.single.' . $doctor->slug, view('admin.template.doctor.single', compact('doctor', 'doctorSpecialities', 'doctorMilestones'))->render());
    }
    public function render()
    {
        $doctors = DB::table(Doctor::table_name)->get();
        $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
        $doctorSpecialities = DB::table('doctor_specialities')->get();
        Helper::putCache('doctor.index', view('admin.template.doctor.index', compact('doctors', 'specialties', 'doctorSpecialities'))->render());
    }
    
}
