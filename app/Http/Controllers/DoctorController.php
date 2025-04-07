<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Doctor;
use App\Models\DoctorSpeciality;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return redirect()->back()->with('success', 'Doctor added successfully');
        }
    }

    public function edit(Request $request, $doctor_id)
    {
        $doctor = Doctor::where('id', $doctor_id)->first();
        if (Helper::G()) {
            $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
            return view('admin.doctor.edit', compact('doctor', 'specialties'));
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
            return redirect()->back()->with('success', 'Doctor updated successfully');
        }
    }
    public function del($doctor_id)
    {
        Doctor::where('id', $doctor_id)->delete();
        return redirect()->back()->with('delete_success', 'Doctor deleted successfully');
    }

    public function specialityIndex(Request $request, $doctor_id)
    {
        if (Helper::G()) {
            $doctor = Doctor::where('id', $doctor_id)->first();
            $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
            $doctorSpecialities = DB::table('doctor_specialities')->where('doctor_id', $doctor_id)->get();
            dd($doctorSpecialities);
            return view('admin.doctor.speciality.index', compact('doctor', 'specialties','doctorSpecialities'));
        } else {
            $doctorSpeciality = new DoctorSpeciality();
            $doctorSpeciality->doctor_id = $doctor_id;
            $doctorSpeciality->speciality_id = $request->speciality_id;
            $doctorSpeciality->save();
            return redirect()->back()->with('success', 'Doctor speciality added successfully');
        }
    }

    public function specialityDel($doctor_speciality_id)
    {
        DoctorSpeciality::where('id', $doctor_speciality_id)->delete();
        return redirect()->back()->with('delete_success', 'Doctor speciality deleted successfully');
    }

    public function render()
    {
        $doctors = DB::table(Doctor::table_name)->get();
        $specialties = DB::table('specialties')->whereNull('parent_speciality_id')->get();
        Helper::putCache('doctor.index', view('admin.template.doctor.index', compact('doctors', 'specialties'))->render());
    }
}
