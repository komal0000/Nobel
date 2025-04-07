<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors for a specific service.
     */
    public function index($service_id)
    {
        $service = Service::where('id', $service_id)->first();
        $doctors = Doctor::where('specialty_id', $service_id)->get();
        return view('admin.doctor.index', compact('doctors', 'service'));
    }

    /**
     * Show the form for creating a new doctor and store it.
     */
    public function add(Request $request, $service_id)
    {
        $service = Service::where('id', $service_id)->first();
        if (Helper::G()) {
            return view('admin.doctor.add', compact('service'));
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'qualification' => 'nullable|array',
                'short_description' => 'nullable|string',
            ]);

            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->position = $request->position;
            $doctor->location = $request->location;
            $doctor->qualification = $request->qualification ? json_encode($request->qualification) : null;
            $doctor->short_description = $request->short_description;
            $doctor->specialty_id = $service_id;

            if ($request->hasFile('image')) {
                $doctor->image = $request->file('image')->store('uploads/doctors', 'public');
            }

            $doctor->save();

            return redirect()->route('admin.doctor.index', $service_id)->with('success', 'Doctor added successfully');
        }
    }

    /**
     * Show the form for editing and update the specified doctor.
     */
    public function edit(Request $request, $doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        if (Helper::G()) {
            return view('admin.doctor.edit', compact('doctor'));
        } else {
            $doctor->name = $request->name;
            $doctor->position = $request->position;
            $doctor->location = $request->location;
            $doctor->qualification = $request->qualification ? json_encode($request->qualification) : null;
            $doctor->short_description = $request->short_description;

            if ($request->hasFile('image')) {
                $doctor->image = $request->file('image')->store('uploads/doctors', 'public');
            }

            $doctor->save();

            return redirect()->route('admin.doctor.index', $doctor->specialty_id)->with('success', 'Doctor updated successfully');
        }
    }

    /**
     * Remove the specified doctor from storage.
     */
    public function del($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        $service_id = $doctor->specialty_id;
        $doctor->delete();

        return redirect()->route('admin.doctor.index', $service_id)->with('delete_success', 'Doctor deleted successfully');
    }
}
