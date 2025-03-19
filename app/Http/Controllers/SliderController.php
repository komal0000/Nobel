<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = DB::table('sliders')->get(['id','mobile_image']);
        return view('admin.slider.index', compact('sliders'));
    }

    public function add(Request $request)
    {
        if (Helper::G($request)) {
            return view('admin.slider.add');
        } else {
            $slider = new Slider();
            if ($request->hasFile('desktop_image')) {
                $slider->desktop_image = $request->file('desktop_image')->store('uploads/slider', "public");
            }
            if ($request->hasFile('mobile_image')) {
                $slider->mobile_image = $request->file('mobile_image')->store('uploads/slider', 'public');
            }
            $slider->has_link = $request->has_link;
            $slider->link_url = $request->link_url;
            $slider->link_text = $request->link_text;
            $slider->extra_data = $request->extra_data;
            $slider->save();
            $this->render();
            return redirect()->back()->with("success", "Slider Successfully Added");
        }
    }

    public function edit(Request $request, $slider_id)
    {
        $slider = Slider::where("id", $slider_id)->first();
        if (Helper::G($request)) {
            return view('admin.slider.edit', compact('slider'));
        } else {
            if ($request->hasFile('desktop_image')) {
                $slider->desktop_image = $request->file('desktop_image')->store('uploads/sliders', "public");
            }
            if ($request->hasFile('mobile_image')) {
                $slider->mobile_image = $request->file('mobile_image')->store('uploads/sliders', 'public');
            }
            $slider->has_link = $request->has_link;
            $slider->link_url = $request->link_url;
            $slider->link_text = $request->link_text;
            $slider->extra_data = $request->extra_data;
            $slider->save();
            $this->render();
            return redirect()->back()->with("success", "Slider Successfully Updated");
        }
    }

    public function del($slider_id)
    {
        Slider::where('id', $slider_id)->delete();
        $this->render();
        return redirect()->back()->with("delete_success", "Slider Successfully Deleted");
    }

    public function render(){
        $slider = DB::table('sliders')->first(['id','desktop_image','mobile_image']);
        Helper::putCache('home.slider',view('admin.template.slider',compact('slider'))->render());
    }
}
