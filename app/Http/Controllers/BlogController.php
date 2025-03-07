<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request){
        $parent_id = $request->parent_id;
        if($parent_id){
            $blogCategories = DB::table('blog_categories')->where('parent_id',$parent_id)->get(['id','title']);
        }
        else{
            $blogCategories = DB::table('blog_categories')->whereNull('parent_id')->get(['id','title']);

        }
        return view('admin.blogCategory.index',compact('blogCategoriess'));
    }

     public function add(Request $request){
        $parent_id = $request->parent_id;
        if(Helper::G()){
            return view('admin.blogCategory.add',compact($parent_id));
        }else{
            $BlogCategory = New BlogCategory();
            $BlogCategory->title = $request->title;
            $BlogCategory->type = $request->type;
            $BlogCategory->parent_id = $request->$parent_id;
            $BlogCategory->save();
            return redirect()->back()->with('success','BlogCategory Successfully Added');
        }
    }
    public function edit(Request $request ,$category){
        $BlogCategory = BlogCategory::where('id',$category)->first();
        if(Helper::G()){
            return view('admin.blogCategory.edit',compact('BlogCategory'));
        }else{
            $BlogCategory = New BlogCategory();
            $BlogCategory->title = $request->title;
            $BlogCategory->type = $request->type;
            $BlogCategory->save();
            return redirect()->back()->with('success','BlogCategory Successfully Updated');
        }
    }
    public function del($category){
        BlogCategory::where('id',$category)->delete();
        return redirect()->back()->with('success','BlogCategory Successfully Deleted');
    }
}
