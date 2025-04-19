<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use App\Models\About;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        if (Helper::G()) {
            $abouts = DB::table('abouts')->get();
            return view('admin.about.index', compact('abouts'));
        }
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            return view('admin.about.add');
        } else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $about = new About();
            $about->title = $request->title;
            $about->description = $request->description;


            if ($request->hasFile('image')) {
                $about->image = $request->file('image')->store('uploads/about', 'public');
            }
            $about->save();
            $this->render();
            return redirect()->back()->with('success', 'About Section Successfully Added');
        }
    }

    public function edit(Request $request, $about_id)
    {
        $about = About::where('id', $about_id)->first();

        if (Helper::G()) {
            return view('admin.about.edit', compact('about'));
        } else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $about->title = $request->title;
            $about->description = $request->description;

            if ($request->hasFile('image')) {
                $about->image = $request->file('image')->store('uploads/about', 'public');
            }

            $about->save();
            $this->render();
            return redirect()->back()->with('success', 'About Section Successfully Updated');
        }
    }

    public function del($about_id)
    {
        About::where('id', $about_id)->delete();
        $this->render();
        return redirect()->back()->with('delete_success', 'About Section Successfully Deleted');
    }

    public function render()
    {
        $abouts = DB::table('abouts')->get();
        $awards = DB::table('awards')->get(['id','year', 'short_description']);
        Helper::putCache('about.index', view('admin.template.about.sections', compact('abouts','awards'))->render());
    }
}
