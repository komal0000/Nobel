<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        if (Helper::G()) {
            $policies = DB::table('policies')->get();
            return view('admin.policy.index', compact('policies'));
        } else {
            $policy = new Policy();
            $policy->title = $request->title;
            $policy->description = $request->description;
            $policy->save();
            $this->render();
            return redirect()->back()->with('success', 'Policy added successfully');
        }
    }

    public function edit(Request $request, $policy_id)
    {
        $policy = Policy::where('id', $policy_id)->first();
        $policy->title = $request->title;
        $policy->description = $request->description;
        $policy->save();
        $this->render();
        return response()->json([
            'status' => 'success',
            'message' => 'Policy updated successfully'
        ]);
    }

    public function del($policy_id)
    {

        Policy::where('id', $policy_id)->delete();
        $this->render();
        return redirect()->back()->with('success', 'Policy deleted successfully');
    }


    public function render()
    {
        $policies = DB::table('policies')->get();
        Helper::putCache('policy.index', view('admin.template.policy.index', compact('policies'))->render());
      Helper::putMetaCache('policy', $data = [
         'title' => 'Policy',
         'description' => 'Polices of Kathmandu Medical College.',
         'keywords' => 'policy kmc',
         'url' => route('policy')
      ]);
    }
}
