<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
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
            $award = new Award();
            $award->year = $request->year;
            $award->short_description = $request->short_description;
            $award->save();
            return redirect()->back()->with('success', 'Successfully Addded Award');
        }
    }

    public function edit(Request $request, $award_id)
    {
        $award = Award::where('id', $award_id)->first();
        $award->year = $request->input('year');
        $award->short_description = $request->input('short_description');
        $award->save();
        session()->flash('success', 'Award Successfully updated');
        return response()->json(['success' => true]);
    }

    public function del($award_id)
    {
        Award::where('id', $award_id)->delete();
        return response()->json(['success' => true]);
    }
}
