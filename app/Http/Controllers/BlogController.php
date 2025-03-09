<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request, $type)
    {
        $parent_id = $request->parent_id;
        if ($parent_id) {
            $blogCategories = DB::table('blog_categories')->where('parent_id', $parent_id)->where('type', $type)->get(['id', 'title', 'type']);
        } else {
            $blogCategories = DB::table('blog_categories')->whereNull('parent_id')->where('type', $type)->get(['id', 'title', 'type']);
        }
        return view('admin.blogCategory.index', compact('blogCategories', 'parent_id', 'type'));
    }

    public function add(Request $request, $type)
    {
        $parent_id = $request->parent_id;
        if (Helper::G()) {
            return view('admin.blogCategory.add', compact('parent_id', 'type'));
        } else {
            $BlogCategory = new BlogCategory();
            $BlogCategory->title = $request->title;
            $BlogCategory->type = $type;
            $BlogCategory->parent_id = $parent_id;
            $BlogCategory->save();
            return redirect()->back()->with('success', 'BlogCategory Successfully Added');
        }
    }
    public function edit(Request $request, $category, $type)
    {
        $BlogCategory = BlogCategory::where('id', $category)->first();
        if (Helper::G()) {
            return view('admin.blogCategory.edit', compact('BlogCategory'));
        } else {
            $BlogCategory = new BlogCategory();
            $BlogCategory->title = $request->title;
            $BlogCategory->type = $type;
            $BlogCategory->save();
            return redirect()->back()->with('success', 'BlogCategory Successfully Updated');
        }
    }
    public function del($category)
    {
        BlogCategory::where('id', $category)->delete();
        return redirect()->back()->with('delete_success', 'BlogCategory Successfully Deleted');
    }

    public function blogindex(Request $request, $blogCategory_id, $type)
    {
        $parent_id  = $request->parent_id;
        $blogCategory = DB::table('blog_categories')->where('id', $blogCategory_id)->where('type', $type)->first();
        if ($parent_id) {
            $blogs = DB::table('blogs')->where('blog_category_id', $parent_id)->get();
        } else {
            $blogs = DB::table('blogs')->where('blog_category_id', $blogCategory_id)->get();
        }
        return view('admin.blogCategory.blog.index', compact('parent_id', 'blogs', 'type', 'blogCategory_id', 'blogCategory'));
    }

    public function blogadd(Request $request, $blogCategory_id, $type)
    {
        $parent_id = $request->parent_id;
        $blogCategory = DB::table('blog_categories')->where('id', $blogCategory_id)->first();

        if (Helper::G()) {
            return view('admin.blogCategory.blog.add', compact('blogCategory', 'parent_id','type'));
        } else {
            $blog = new Blog();
            $blog->title = $request->title;

            if ($request->hasFile('image')) {
                $blog->image = $request->file('image')->store("upload/blogcategory/{$blogCategory->type}", 'public');
            }
            $blog->text = $request->text;
            $blog->blog_category_id = $blogCategory->id;
            $blog->creator_user_id = Auth::id();
            $blog->is_featured = $request->is_featured;
            $blog->datas = $request->datas;
            $blog->save();
            return redirect()->back()->with('success', 'Blog Successfully Added');
        }
    }

    public function blogdel($blog){
        Blog::where('id',$blog)->delete();
        return redirect()->back()->with('delete_success','Successfully Blog Deleted');
    }
}
