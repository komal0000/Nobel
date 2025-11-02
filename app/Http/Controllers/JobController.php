<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Traits\Dumpable;

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
         $this->render();

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
         $this->render();
         return redirect()->back()->with('success', 'Successfully Updated Job Category');
      }
   }
   public function delete($jobcategory_id)
   {
      Job::where('job_category_id', $jobcategory_id)->delete();
      JobCategory::where('id', $jobcategory_id)->delete();
      $this->render();
      return redirect()->back()->with('success', 'Successfully Deleted Job Category');
   }

   public function jobIndex($jobCategory_id)
   {
      $jobs = DB::table('jobs')->where('job_category_id', $jobCategory_id)->get();
      $jobCategory = DB::table('job_categories')->where('id', $jobCategory_id)->first();
      return view('admin.jobCategory.job.index', compact('jobs', 'jobCategory'));
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
         $job->date = Helper::convertDateToInteger($request->date);
         $job->description = $request->description;
         $job->qualification = $request->qualification;
         $job->experience = $request->experience;
         $job->job_category_id = $jobCategory->id;
         $job->save();
         $this->render();
         $this->renderSingle($job->id);

         return redirect()->back()->with('success', 'Successfully Added Job');
      }
   }
   public function jobEdit(Request $request, $job_id)
   {
      $job = Job::where('id', $job_id)->first();
      if (Helper::G($request)) {
         $jobCategory = DB::table('job_categories')->where('id', $job->job_category_id)->first();
         return view('admin.jobCategory.job.edit', compact('job', 'jobCategory'));
      } else {
         $job->title = $request->title;
         $job->type = $request->type;
         $job->location = $request->location;
         $job->date = Helper::convertDateToInteger($request->date);
         $job->description = $request->description;
         $job->qualification = $request->qualification;
         $job->experience = $request->experience;
         $job->save();
         $this->render();
         $this->renderSingle($job->id);
         return redirect()->back()->with('success', 'Successfully Updated Job');
      }
   }

   public function jobDelete($job_id)
   {
      // JobRequest::where('job_id', $job_id)->delete();
      Job::where('id', $job_id)->delete();
      $this->render();
      return redirect()->back()->with('success', 'Successfully Deleted Job');
   }

   public function jobRequest($job_id)
   {
      if (Helper::G()) {
         $job = Job::where('id', $job_id)->first();
         $jobCategory = JobCategory::where('id', $job->job_category_id)->first();
         $jobRequests = JobRequest::where('job_id', $job_id)->get();
         return view('admin.jobCategory.job.request', compact('jobRequests', 'jobCategory'));
      }
   }

   public function delJobRequest($jobRequestId)
   {
      JobRequest::where('id', $jobRequestId)->delete();
      $this->render();
      return redirect()->back()->with('success', 'Successfully Deleted Job Request.');
   }

   public function render()
   {
      $jobcategories = DB::table('job_categories')->get(['id', 'title', 'icon', 'short_description']);
      Helper::putCache('career.jobcategory', view('admin.template.career.jobCategory', compact('jobcategories'))->render());
      Helper::putCache('career.job', view('admin.template.career.jobs', compact('jobcategories'))->render());
      Helper::putMetaCache('career.jobCategory', $data = [
         'title' => 'Job Category',
         'description' => 'Job categories available in Kathmandu Medical College.',
         'keywords' => 'job, jobs, kmc job',
         'url' => route('jobs.jobcategory')
      ]);
      Helper::putMetaCache('career', $data = [
         'title' => 'Career',
         'description' => 'Reach out to Kathmandu Medical College for career opportunities.',
         'keywords' => 'career, career kmc',
         'url' => route('careers')
      ]);
   }

   public function renderSingle($jobId)
   {
      $job = Job::where('id', $jobId)->first();
      $jobCategory = JobCategory::where('id', $job->job_category_id)->value('title');

      Helper::putMetaCache('career.job.' . $job->slug, $data = [
         'title' => $job->title,
         'description' => $job->short_description,
         'url' => route('jobs.jobDetail.jobDetail', ['slug' => $job->slug]),
      ]);
        Helper::putMetaCache('career.job.' . $job->slug . '-form', $data = [
            'title' => $job->title,
            'description' => $job->short_description,
            'url' => route('jobs.jobDetail.show-form', ['slug' => $job->slug]),
        ]);
      Helper::putCache('career.job.' . $job->slug, view('admin.template.career.job.jobDetail', compact('job', 'jobCategory'))->render());
      Helper::putCache('career.job.' . $job->slug . '-form', view('admin.template.career.job.jobForm', compact('job', 'jobCategory'))->render());
   }
}
