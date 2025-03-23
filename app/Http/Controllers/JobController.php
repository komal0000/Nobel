<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Job;
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
        Job::where('job_category_id',$jobcategory_id)->delete();
        JobCategory::where('id', $jobcategory_id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted Job Category');
    }

    public function jobIndex($jobCategory_id)
    {
        $jobs = DB::table('jobs')->where('job_category_id', $jobCategory_id)->get();
        $jobCategory = DB::table('job_categories')->where('id', $jobCategory_id)->first();
        return view('admin.jobCategory.job.index', compact('jobs','jobCategory'));
    }
    public function jobAdd(Request $request, $jobCategory_id)
    {
        $jobCategory = DB::table('job_categories')->where('id', $jobCategory_id)->first();
        if (Helper::G()) {
            return view('admin.jobCategory.job.add', compact('jobCategory'));
        } else {
            $job = new Job();
            $job->title = $request->title;
            $job->type = $request->type;
            $job->location = $request->location;
            $job->date = $request->date;
            $job->description = $request->description;
            $job->qualification = $request->qualification;
            $job->experience = $request->experience;
            $job->job_category_id = $jobCategory->id;
            $job->save();
            return redirect()->back()->with('success', 'Successfully Added Job');
        }
    }
    public function jobEdit(Request $request, $job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $jobCategory = DB::table('job_categories')->where('id', $job->job_category_id)->first();
        if (Helper::G($request)) {
            return view('admin.jobCategory.job.edit', compact('job','jobCategory'));
        } else {
            $job->title = $request->title;
            $job->type = $request->type;
            $job->location = $request->location;
            $job->date = $request->date;
            $job->description = $request->description;
            $job->qualification = $request->qualification;
            $job->experience = $request->experience;
            $job->save();
            return redirect()->back()->with('success', 'Successfully Updated Job');
        }
    }

    public function jobDelete($job_id)
    {
        Job::where('id', $job_id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted Job');
    }


    public function render()
    {
        $jobcategories = DB::table('job_categories')->get(['id', 'title']);
        Helper::putCache('career.job',view('admin.template.career.jobs',compact('jobcategories'))->render());
    }
}
