<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $policy = new \App\Models\Policy();
            $policy->title = $request->title;
            $policy->description = $request->description;
            $policy->save();
            return redirect()->back()->with('success', 'Policy added successfully');
        }

        $policies = \App\Models\Policy::all();
        return view('admin.policy.index', compact('policies'));
    }

    public function edit(Request $request, $policy_id)
    {
        $policy = \App\Models\Policy::findOrFail($policy_id);

        if ($request->isMethod('post')) {
            $policy->title = $request->title;
            $policy->description = $request->description;
            $policy->save();
            return redirect()->back()->with('success', 'Policy updated successfully');
        }

        return view('admin.policy.edit', compact('policy'));
    }

    public function del($policy_id)
    {
        $policy = \App\Models\Policy::findOrFail($policy_id);
        $policy->delete();
        return redirect()->back()->with('success', 'Policy deleted successfully');
    }
}
