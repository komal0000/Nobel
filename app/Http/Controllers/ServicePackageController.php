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
            $type = new ServicePackageType();
            $type->service_id = $service_id;
            $type->type = $request->type;
            $type->save();
            return redirect()->back()->with('success', 'Service package type added successfully');
        }
    }

    public function typeDel($type_id)
    {
        ServicePackage::where('service_package_type_id', $type_id)->delete();
        ServicePackageType::where('id', $type_id)->first();
        session()->flash('delete_success', 'Service Type Successfully deleted');
        return response()->json(['success' => true]);
    }


    public function index($type_id)
    {
        $packageType = ServicePackageType::where('id', $type_id)->first();
        $packages = DB::table('service_packages')->get(['id', 'title', 'price', 'description', 'age']);
        return view('admin.service.package.index', compact('packages', 'packageType'));
    }
    public function add(Request $request,$type_id)
    {
        if (Helper::G()) {
            $packageType = DB::table('service_package_types')->where('id',$type_id)->first();
            $services = DB::table('services')->where('has_package', 1)->get(['id', 'title']);
            return view('admin.service.package.add', compact('services', 'packageType'));
        } else {
            $servicePackage = new ServicePackage();
            $servicePackage->title = $request->title;
            $servicePackage->service_id = $request->service_id;
            $servicePackage->service_package_type_id = $request->service_package_type_id;
            $servicePackage->price = $request->price;
            $servicePackage->description = $request->description;
            $servicePackage->age = $request->age;
            $servicePackage->labtest = $request->labtest;
            $servicePackage->gender = $request->gender;
            if ($request->hasFile('image')) {
                $servicePackage->image = $request->file('image')->store('uploads/service/package', 'public');
            }
            $servicePackage->save();
            return redirect()->back()->with('success', 'Service package created successfully');
        }
    }
    public function edit(Request $request, $package_id)
    {
        if (Helper::G()) {
            $package = ServicePackage::where('id', $package_id)->first();
            return view('admin.service.package.edit', compact('package'));
        } else {
            $servicePackage = ServicePackage::where('id', $package_id)->first();
            $servicePackage->title = $request->title;
            $servicePackage->price = $request->price;
            $servicePackage->description = $request->description;
            $servicePackage->age = $request->age;
            $servicePackage->labtest = $request->labtest;
            $servicePackage->gender = $request->gender;
            if ($request->hasFile('image')) {
                $servicePackage->image = $request->file('image')->store('uploads/service/package', 'public');
            }
            $servicePackage->save();
            return redirect()->back()->with('success', 'Service package updated successfully');
        }
    }

    public function destroy($package_id)
    {
        ServicePackage::where('id', $package_id)->delete();
        return redirect()->back()->with('delete_success', 'Service package deleted successfully');
    }
}
