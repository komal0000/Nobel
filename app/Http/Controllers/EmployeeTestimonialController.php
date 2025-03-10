<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\EmployeeTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeTestimonialController extends Controller
{
    public function index()
    {
        $EmployeeTestimonials = DB::table('employee_testimonials')->get(['id', 'title']);
        return view('admin.employeeTestimonial.index', compact('EmployeeTestimonials'));
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            return view('admin.employeeTestimonial.add');
        } else {
            $EmployeeTestimonial = new EmployeeTestimonial();
            $EmployeeTestimonial->title  = $request->title;
            $EmployeeTestimonial->short_description  = $request->short_description;
            if ($request->hasFile('image')) {
                $EmployeeTestimonial->image = $request->file('image')->store('uploads/employeetestimonial', 'public');
            }
            $EmployeeTestimonial->save();

            return redirect()->back()->with('success', 'Successfully Testimonial Added');
        }
    }
    public function edit(Request $request, $testimonial_id)
    {
        $EmployeeTestimonial = EmployeeTestimonial::where('id', $testimonial_id)->first();
        if (Helper::G()) {
            return view('admin.employeeTestimonial.edit', compact('EmployeeTestimonial'));
        } else {
            $EmployeeTestimonial->title = $request->title;
            $EmployeeTestimonial->short_description = $request->short_description;
            if ($request->hasFile('image')) {
                $EmployeeTestimonial->image = $request->file('image')->store('uploads/employeetestimonial', 'public');
            }
            $EmployeeTestimonial->save();
            return redirect()->back()->with('success', 'Successfully Testimonial updated');
        }
    }

    public function del($testimonial_id)
    {
        EmployeeTestimonial::where('id', $testimonial_id)->delete();
        return redirect()->back()->with('delete_success', 'Successfully Testimonial Deleted');
    }
}
