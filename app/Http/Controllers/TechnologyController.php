<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {

        $technologies = DB::table('technologies')->get();
        return view('admin.technology.index', compact('technologies'));
    }
    public function add(Request $request)
    {
        if (Helper::G()) {
            $specialities = DB::table('specialties')->get();
            return view('admin.technology.add',compact('specialities'));
        } else {
            $technology = new Technology();
            $technology->title = $request->title;
            $technology->short_description = $request->short_description;
            $technology->specialty_id = $request->specialty_id;
            $technology->save();
            return redirect()->back()->with('success', 'Successfully Technology Added');
        }
    }

    public function edit(Request $request, $technology_id)
    {
        $technology = Technology::where('id', $technology_id)->first();
        if (Helper::g()) {
            $specialities = DB::table('specialties')->get();
            return view('admin.technology.edit', compact('technology','specialities'));
        } else {
            $technology->title = $request->title;
            $technology->short_description = $request->short_description;
            $technology->save();
            return redirect()->back()->with('success', 'Successfully Technology Updated');
        }
    }

    public function del($technology_id)
    {
        Technology::where('id', $technology_id)->delete();
        return redirect()->back()->with('delete_success', 'Successfully Technology Deleted');
    }
}
