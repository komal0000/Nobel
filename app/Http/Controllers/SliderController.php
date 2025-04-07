<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Slider;
use App\Models\SliderNavigation;
use App\Models\SliderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index($type_id)
    {
        $sliderType  = DB::table('slider_types')->where('id', $type_id)->first(['id', 'title']);
        $sliders = DB::table('sliders')->where('slider_type_id', $type_id)->get(['id', 'mobile_image']);
        return view('admin.slider.index', compact('sliders', 'sliderType'));
    }

    public function add(Request $request, $type_id)
    {
        $sliderType  = DB::table('slider_types')->where('id', $type_id)->first(['id', 'title','designated_for']);
        if (Helper::G()) {
            // dd($sliderType);
            return view('admin.slider.add', compact('sliderType'));
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
            $slider->slider_type_id = $sliderType->id;
            $slider->save();
            $this->render($type_id);
            return redirect()->back()->with("success", "Slider Successfully Added");
        }
    }

    public function edit(Request $request, $slider_id)
    {
        $slider = Slider::where("id", $slider_id)->first();
        if (Helper::G()) {
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
            $slider->save();
            $this->render($slider->slider_type_id);
            return redirect()->back()->with("success", "Slider Successfully Updated");
        }
    }

    public function del($slider_id)
    {
        $slider =  Slider::where('id', $slider_id)->first();
        $slider->delete();
        $this->render($slider->slider_type_id);
        return redirect()->back()->with("delete_success", "Slider Successfully Deleted");
    }

    public function typeIndex(Request $request)
    {
        if (Helper::G()) {
            $sliderTypes = DB::table('slider_types')->get(['id', 'title', 'designated_for']);
            return view('admin.slider.type.index', compact('sliderTypes'));
        } else {
            $type = new SliderType();
            $type->title = $request->title;
            $type->designated_for = $request->designated_for;
            $type->save();
            return redirect()->back()->with('success', 'Slider Type Successfully Added');
        }
    }
    public function typeDel($type_id)
    {
        Slider::where('slider_type_id', $type_id)->delete();
        SliderType::where('id', $type_id)->delete();
        return redirect()->back()->with('delete_success', 'Slider Type Successfully Deleted');
    }

    public function navigationIndex()
    {
        $navigations = DB::table('slider_navigations')->get(['id', 'title', 'link', 'icon']);
        return view('admin.slider.navigation.index', compact('navigations'));
    }

    public function navigationAdd(Request $request)
    {
        if (Helper::G($request)) {
            return view('admin.slider.navigation.add');
        } else {
            $navigation = new SliderNavigation();
            $navigation->title = $request->title;
            $navigation->link = $request->link;
            if ($request->hasFile('icon')) {
                $navigation->icon = $request->file('icon')->store('uploads/slider/navigation', 'public');
            }
            $navigation->save();
            $this->renderNavigation();
            return redirect()->back()->with("success", "Slider Navigation Successfully Added");
        }
    }
    public function navigationEdit(Request $request, $navigation_id)
    {
        $navigation = SliderNavigation::where('id', $navigation_id)->first();
        if (Helper::G()) {
            return view('admin.slider.navigation.edit', compact('navigation'));
        } else {
            $navigation->title = $request->title;
            $navigation->link = $request->link;
            if ($request->hasFile('icon')) {
                $navigation->icon = $request->file('icon')->store('uploads/slider/navigation', 'public');
            }
            $navigation->save();
            $this->renderNavigation();
            return redirect()->back()->with("success", "Slider Navigation Successfully Updated");
        }
    }
    public function navigationDel($navigation_id)
    {
        SliderNavigation::where('id', $navigation_id)->delete();
        $this->renderNavigation();
        return redirect()->back()->with("delete_success", "Slider Navigation Successfully Deleted");
    }
    public function render($type_id)
    {
        $sliderType  = DB::table('slider_types')->where('id', $type_id)->first(['id', 'title','designated_for']);

        if ($sliderType->designated_for == 'home') {
            $sliders = DB::table('sliders')->get(['id', 'desktop_image', 'mobile_image']);
            Helper::putCache('home.slider', view('admin.template.home.slider', compact('sliders'))->render());
        } elseif ($sliderType->designated_for == 'career') {
            $sliders = DB::table('sliders')->where('slider_type_id', $type_id)->get(['id', 'desktop_image', 'mobile_image']);
            Helper::putCache('career.slider', view('admin.template.career.slider', compact('sliders'))->render());
        }elseif($sliderType->designated_for =='careerIntern'){
            $sliders = DB::table('sliders')->where('slider_type_id', $type_id)->get(['id', 'desktop_image', 'mobile_image']);
            Helper::putCache('career.internship.slider', view('admin.template.career.internship.slider', compact('sliders'))->render());
        }
    }

    public function renderNavigation()
    {
        $navigations = DB::table('slider_navigations')->get(['id', 'title', 'link', 'icon']);
        Helper::putCache('home.sliderNavigation', view('admin.template.home.sliderNavigation', compact('navigations'))->render());
    }
}
