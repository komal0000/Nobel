<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Download;
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
            return view('admin.downloadcategory.add', compact('parent_id'));
        } else {
            $downloadcategory = new DownloadCategory();
            $downloadcategory->title = $request->title;
            if ($request->has('icon')) {
                $downloadcategory->icon = $request->file('icon')->store('uploads/dowloads', 'public');
            }
            $downloadcategory->parent_id = $request->parent_id;
            $downloadcategory->save();
            $this->render();
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
            $this->render();
            return redirect()->back()->with('success', 'Download Category Successfully updated');
        }
        return view('admin.downloadcategory.edit', compact('downloadcategory'));
    }

    public function del($category)
    {
        $this->deleteCategoryRecursively($category);
        $this->render();
        return redirect()->back()->with('delete_success', 'Download Category Successfully Deleted');
    }

    private function deleteCategoryRecursively($categoryId)
    {
        $childCategories = DownloadCategory::where('parent_id', $categoryId)->get();
        foreach ($childCategories as $child) {
            $this->deleteCategoryRecursively($child->id);
        }
        Download::where('download_category_id', $categoryId)->delete();
        DownloadCategory::where('id', $categoryId)->delete();
    }

    public function downloadIndex(Request $request, $category)
    {
        $parent_id = $request->parent_id;
        $downloads = DB::table('downloads')->where('download_category_id', $category)->get(['id', 'title']);
        if ($parent_id) {
            $downloadCategory = DB::table('download_categories')->where('id', $category)->where('parent_id', $parent_id)->first();
        } else {
            $downloadCategory = DownloadCategory::whereNull('parent_id')->where('id', $category)->first(['id', 'title']);
        }
        return view('admin.downloadcategory.download.index', compact('category', 'parent_id', 'downloads', 'downloadCategory'));
    }

    public function downloadAdd(Request $request, $category)
    {
        $parent_id = $request->parent_id;
        if (Helper::G()) {
            if ($parent_id) {
                $downloadCategory = DB::table('download_categories')->where('id', $category)->where('parent_id', $parent_id)->first();
            } else {
                $downloadCategory = DownloadCategory::whereNull('parent_id')->where('id', $category)->first(['id', 'title']);
            }
            return view('admin.downloadcategory.download.add', compact('category', 'parent_id', 'downloadCategory'));
        } else {
            $download = new Download();
            $download->title = $request->title;
            if ($request->hasFile('link')) {
                $download->link = $request->file('link')->store('uploads/link', 'public');
            }
            $download->uploaded_date = Helper::convertDateToInteger($request->uploaded_date);
            $download->download_category_id = $category;
            $download->save();
            $this->render();
            return redirect()->back()->with('success', 'Download successfully added');
        }
    }

    public function downloadEdit(Request $request, $download)
    {
        $parent_id = $request->parent_id;
        $download = Download::where('id', $download)->first();
        if (Helper::G()) {
            if ($parent_id) {
                $downloadCategory = DB::table('download_categories')->where('parent_id', $parent_id)->first();
            } else {
                $downloadCategory = DownloadCategory::whereNull('parent_id')->first(['id', 'title']);
            }
            return view('admin.downloadcategory.download.edit', compact('download', 'parent_id', 'downloadCategory'));
        } else {
            $download->title = $request->title;
            if ($request->hasFile('link')) {
                $download->link = $request->file('link')->store('uploads/link', 'public');
            }
            $download->uploaded_date = Helper::convertDateToInteger($request->uploaded_date);
            $download->save();
            $this->render();
            return redirect()->back()->with('success', 'Download successfully updated ');
        }
    }

    public function downloadDel($download)
    {
        Download::where('id', $download)->delete();
        return redirect()->back()->with('delete_success', 'Download Successfully Deleted');
    }

    public function render(){
        $downloadMainType = DB::table('download_categories')->where('parent_id', null)->get();
        $downloads = DB::table('downloads')->get();

         Helper::putMetaCache('download', $data = [
            'title' => 'All Downloads',
            'description' => 'All Downloads section available in Nobel Hospital.',
            'keywords' => 'downloads',
            'url' => route('download.index')
         ]);
        Helper::putCache('health.download',view('admin.template.health.download',compact('downloads'))->render());
        Helper::putCache('download.index',view('admin.template.download.index',compact('downloadMainType','downloads'))->render());
    }
}
