<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = $request->parent_id;
        if ($parent_id) {
            $downloadcategories = DownloadCategory::where('parent_id', $parent_id)->get(['id', 'title']);
        } else {
            $downloadcategories = DownloadCategory::whereNull('parent_id')->get(['id', 'title']);
        }
        return view('admin.downloadcategory.index', compact('downloadcategories', 'parent_id'));
    }
    public function add(Request $request)
    {
        $parent_id = $request->parent_id;
        if (Helper::G()) {
            return view('admin.downloadcategory.add',compact('parent_id'));
        } else {
            $downloadcategory = new DownloadCategory();
            $downloadcategory->title = $request->title;
            if ($request->has('icon')) {
                $downloadcategory->icon = $request->file('icon')->store('uploads/dowloads', 'public');
            }
            $downloadcategory->parent_id = $request->parent_id;
            $downloadcategory->save();
            return redirect()->back()->with('success', 'Download Category Successfully added');
        }
    }
    public function edit(Request $request, $category)
    {
        $downloadcategory = DownloadCategory::findOrFail($category);
        if (Helper::P()) {
            $downloadcategory->title = $request->title;
            if ($request->has('icon')) {
                $downloadcategory->icon = $request->file('icon')->store('uploads/dowloads', 'public');
            }
            $downloadcategory->save();
            return redirect()->back()->with('success', 'Download Category Successfully updated');
        }
        return view('admin.downloadcategory.edit', compact('downloadcategory'));
    }

    public function del($category)
    {
        DownloadCategory::where('id', $category)->delete();
        return redirect()->back()->with('success', 'Download Category Successfully Deleted');
    }

    public function downloadIndex(Request $request, $category){

    }
    public function downloadAdd(Request $request,$category){
        if(Helper::G()){
            return view('admin.downloadcategory.download.add',compact('category'));
        }else{

        }
    }
}
