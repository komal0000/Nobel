<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->get(['id','title']);
        return view('admin.service.index',compact('services'));
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            return view('admin.service.add');
        } else {
            $service = new Service();
            $service->title = $request->title;
            $service->short_desc = $request->short_desc;
            if ($request->hasFile('icon')) {
                $service->icon = $request->file('icon')->store('uploads/service', 'public');
            }
            if ($request->hasFile('image')) {
                $service->image = $request->file('image')->store('uploads/service', 'public');
            }
            if ($request->hasFile('single_page_image')) {
                $service->single_page_image = $request->file('single_page_image')->store('uploads/service/single', 'public');
            }
            $service->save();
            $this->reder();
            return redirect()->back()->with('success', 'Service added successfully');
        }
    }
    public function edit(Request $request, $service_id)
    {
        $service = Service::where('id', $service_id)->first();
        if (Helper::G()) {
            return view('admin.service.edit', compact('service'));
        } else {
            $service->title = $request->title;
            $service->short_desc = $request->short_desc;

            if ($request->hasFile('icon')) {
                $service->icon = $request->file('icon')->store('uploads/service', 'public');
            }

            if ($request->hasFile('image')) {
                $service->image = $request->file('image')->store('uploads/service', 'public');
            }

            if ($request->hasFile('single_page_image')) {
                $service->single_page_image = $request->file('single_page_image')->store('uploads/service/single', 'public');
            }

            $service->save();
            $this->reder();
            return redirect()->back()->with('success', 'Service updated successfully');
        }
    }

    public function del($service_id)
    {
        Service::where('id', $service_id)->delete();
        $this->reder();
        return redirect()->back()->with('delete_success', 'Service deleted successfully');
    }

    public function reder(){
        $homeServices = DB::table('services')->get(['id', 'icon', 'title', 'image', 'short_desc']);
        Helper::putCache('home.headerService',view('admin.template.home.headerService',compact('homeServices'))->render());
        Helper::putCache('home.services',view('admin.template.home.services',compact('homeServices'))->render());
    }
}
