<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    {
        $jobcategories = DB::table('job_categories')->get(['id', 'title']);
        return view('admin.jobCategory.index', compact('jobcategories'));
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            return view('admin.jobCategory.add');
        } else {
            $jobcategory = new JobCategory();
            $jobcategory->title = $request->title;
            $jobcategory->short_description = $request->short_description;
            if ($request->hasFile('icon')) {
                $jobcategory->icon = $request->file('icon')->store('uploads/jobs', 'public');
            }
            $jobcategory->save();
            return redirect()->back()->with('success', 'Successfully Added Job Category');
        }
    }

    public function edit(Request $request, $jobcategory_id)
    {
        $jobCategory = JobCategory::where('id', $jobcategory_id)->first();
        if (Helper::G($request)) {
            return view('admin.jobCategory.edit', compact('jobCategory'));
        } else {
            $jobCategory->title = $request->title;
            $jobCategory->short_description = $request->short_description;
            if ($request->hasFile('icon')) {
                $jobCategory->icon = $request->file('icon')->store('uploads/jobs', 'public');
            }
            $jobCategory->save();
            return redirect()->back()->with('success', 'Successfully Updated Job Category');
        }
    }
    public function delete($jobcategory_id)
    {
        JobCategory::where('id', $jobcategory_id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted Job Category');
    }
}
