<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwardController extends Controller
{
    public function index(Request $request)
    {
        if (Helper::G()) {
            $awards = DB::table('awards')->get();
            return view('admin.award.index', compact('awards'));
        } else {
            $request->validate([
                'year' => 'required|integer',
                'short_description' => 'required|string',
            ]);

            $award = new Award();
            $award->year = $request->year;
            $award->short_description = $request->short_description;
            $award->save();
            $this->render();
            return redirect()->back()->with('success', 'Successfully Added Award');
        }
    }

    public function edit(Request $request, $award_id)
    {
        $award = Award::where('id', $award_id)->first();
        $award->year = $request->input('year');
        $award->short_description = $request->input('short_description');
        $award->save();
        $this->render();
        session()->flash('success', 'Award Successfully updated');
        return response()->json(['success' => true]);
    }

    public function del($award_id)
    {
        Award::where('id', $award_id)->delete();
        $this->render();
        session()->flash('delete_success', 'Award Successfully deleted');
        return response()->json(['success' => true]);
    }

    public function render()
    {
        $awards = DB::table('awards')->get(['year', 'short_description']);
        Helper::putCache('home.awards', view('admin.template.home.awards', compact('awards'))->render());
    }
}
