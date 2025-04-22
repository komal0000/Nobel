<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\ServicePackage;
use App\Models\ServicePackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicePackageController extends Controller
{
    public function typeIndex(Request $request, $service_id)
    {
        if (Helper::G()) {
            $types = DB::table('service_package_types')->get(['id', 'type']);
            return view('admin.service.package.type.index', compact('service_id', 'types'));
        } else {
            $existingType = ServicePackageType::where('service_id', $service_id)->first();
            if ($existingType) {
                return redirect()->back()->with('delete_success', 'This package type already exists for this service');
            }else{
                $type = new ServicePackageType();
                $type->service_id = $service_id;
                $type->type = $request->type;
                $type->save();
                return redirect()->back()->with('success', 'Service package type added successfully');
            }
        }
    }

    public function typeDel($type_id)
    {
        ServicePackage::where('service_package_type_id', $type_id)->delete();
        ServicePackageType::where('id', $type_id)->delete();
        session()->flash('delete_success', 'Service Type Successfully deleted');
        return response()->json(['success' => true]);
    }


    public function index($type_id)
    {
        $packageType = ServicePackageType::where('id', $type_id)->first();
        $packages = DB::table('service_packages')->get(['id', 'title', 'price', 'gender', 'age']);
        return view('admin.service.package.index', compact('packages', 'packageType'));
    }
    public function add(Request $request, $type_id)
    {
        $packageType = DB::table('service_package_types')->where('id', $type_id)->first();
        if (Helper::G()) {
            $services = DB::table('services')->where('has_package', 1)->get(['id', 'title']);
            return view('admin.service.package.add', compact('services', 'packageType'));
        } else {
            $servicePackage = new ServicePackage();
            $servicePackage->title = $request->title;
            $servicePackage->service_id = $packageType->service_id;
            $servicePackage->service_package_type_id = $packageType->id;
            $servicePackage->price = $request->price;
            $servicePackage->description = $request->description;
            $servicePackage->age = $request->age;
            $servicePackage->labtest = $request->labtest;
            $servicePackage->gender = $request->gender;
            $servicePackage->type_name = $packageType->type;
            if ($request->hasFile('image')) {
                $servicePackage->image = $request->file('image')->store('uploads/service/package', 'public');
            }
            $servicePackage->save();
            $this->render($packageType->type, $packageType->service_id);
            return redirect()->back()->with('success', 'Service package created successfully');
        }
    }
    public function edit(Request $request, $package_id)
    {
        $package = ServicePackage::where('id', $package_id)->first();
        $packageType = ServicePackageType::where('id', $package->service_package_type_id)->first();
        if (Helper::G()) {
            return view('admin.service.package.edit', compact('package', 'packageType'));
        } else {
            $package->title = $request->title;
            $package->price = $request->price;
            $package->description = $request->description;
            $package->age = $request->age;
            $package->labtest = $request->labtest;
            $package->gender = $request->gender;
            if ($request->hasFile('image')) {
                $package->image = $request->file('image')->store('uploads/service/package', 'public');
            }
            $package->save();
            $this->render($packageType->type, $package->service_id);
            return redirect()->back()->with('success', 'Service package updated successfully');
        }
    }

    public function del($package_id)
    {
        ServicePackage::where('id', $package_id)->delete();
        return redirect()->back()->with('delete_success', 'Service package deleted successfully');
    }

    public function render($type_name,$service_id)
    {
        if ($type_name == 'Type 1') {
            $packages1 = DB::table('service_packages')->where('type_name', $type_name)->get();
            Helper::putCache('service.single.package.'.$service_id,view('admin.template.service.package.type1', compact('packages1'))->render());
        } else {
            $packages2 = DB::table('service_packages')->where('type_name', $type_name)->get();
            Helper::putCache('service.single.package'.$service_id,view('admin.template.service.package.type2', compact('packages2'))->render());
        }
    }
}
