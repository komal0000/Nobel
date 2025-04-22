<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->get(['id', 'title']);
        return view('admin.service.index', compact('services'));
    }

    public function add(Request $request)
    {
        if (Helper::G()) {
            return view('admin.service.add');
        } else {
            $service = new Service();
            $service->title = $request->title;
            $service->short_desc = $request->short_desc;
            $service->has_package = $request->has_package;
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
            $this->renderSingle($service->id);
            return redirect()->back()->with('success', 'Service added successfully');
        }
    }
    public function edit(Request $request, $service_id)
    {
        $service = Service::where('id', $service_id)->first();
        if (Helper::G()) {
            return view('admin.service.edit', compact('service'));
        } else {
            // dd($request->all());
            $service->title = $request->title;
            $service->short_desc = $request->short_desc;
            $service->has_package = $request->has_package;
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
            $this->renderSingle($service->id);
            return redirect()->back()->with('success', 'Service updated successfully');
        }
    }

    public function del($service_id)
    {
        Service::where('id', $service_id)->delete();
        $this->reder();
        $this->renderSingle($service_id);
        return redirect()->back()->with('delete_success', 'Service deleted successfully');
    }

    public function faqIndex($service_id)
    {
        $service = Service::where('id', $service_id)->first();
        $faqs = DB::table('service_faqs')->where('service_id', $service_id)->get();
        return view('admin.service.faq.index', compact('service', 'faqs'));
    }

    public function faqAdd(Request $request, $service_id)
    {
        $service = Service::where('id', $service_id)->first();
        if (Helper::G()) {
            return view('admin.service.faq.add', compact('service'));
        } else {
            $faq = new ServiceFaq();
            $faq->service_id = $service_id;
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            $this->renderSingle($service_id);
            return redirect()->back()->with('success', 'FAQ added successfully');
        }
    }

    public function faqEdit(Request $request, $faq_id)
    {
        $faq = DB::table('service_faqs')->where('id', $faq_id)->first();
        $service = Service::where('id', $faq->service_id)->first();
        if (Helper::G()) {
            return view('admin.service.faq.edit', compact('faq', 'service'));
        } else {
            $faq->service_id = $service->id;
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            $this->renderSingle($service->id);
            return redirect()->back()->with('success', 'FAQ updated successfully');
        }
    }

    public function faqDel($faq_id)
    {
        $faq = DB::table('service_faqs')->where('id', $faq_id)->first();
        $service = Service::where('id', $faq->service_id)->first();
        ServiceFaq::where('id', $faq_id)->delete();
        $this->renderSingle($service->id);
        return redirect()->back()->with('delete_success', 'FAQ deleted successfully');
    }

    public function renderSingle($service_id)
    {
        $service = Service::where('id', $service_id)->first();
        if ($service) {
            $faqs = DB::table('service_faqs')->where('service_id', $service_id)->get();
            // Helper::putMetaCache('service.service', $data = [
            //     'title' => 'Services | Nobel Hospital',
            //     'description' => 'Services offered by Nobel Hospital',
            //     'image' => asset('front/assets/img/meta-image.png'),
            //     'url' => route('service.index'),
            // ]);
            Helper::putCache('service.' . $service_id, view('admin.template.service.single', compact('service', 'faqs'))->render());
        }
    }
    public function reder()
    {
        $homeServices = DB::table('services')->get(['id', 'slug', 'icon', 'title', 'image', 'short_desc', 'single_page_image']);
        Helper::putCache('home.headerService', view('admin.template.home.headerService', compact('homeServices'))->render());
        Helper::putCache('home.services', view('admin.template.home.services', compact('homeServices'))->render());
        foreach ($homeServices as $service) {
            Helper::putMetaCache('service.' . $service->slug, $data = [
                'title' => $service->title,
                'description' => $service->short_desc,
                'image' => asset(Storage::url($service->single_page_image)),
                'url' => route('service.single', ['slug' => $service->slug]),
            ]);
        }
    }
}
