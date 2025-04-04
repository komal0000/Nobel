<?php

namespace App\Http\Controllers;

use App\Helper;
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
            $this->render();
            return redirect()->back()->with('success', 'BlogCategory Successfully Added');
        }
    }
    public function edit(Request $request, $category)
    {
        $parent_id = $request->parent_id;
        $BlogCategory = BlogCategory::where('id', $category)->first();
        if (Helper::G()) {
            return view('admin.blogCategory.edit', compact('BlogCategory', 'parent_id'));
        } else {
            $BlogCategory->title = $request->title;
            $BlogCategory->save();
            $this->render();
            return redirect()->back()->with('success', 'BlogCategory Successfully Updated');
        }
    }
    public function del($category)
    {
        Helper::deleteCategoryRecursively($category);
        $this->render();
        return redirect()->back()->with('delete_success', 'BlogCategory Successfully Deleted');
    }


    public function blogindex(Request $request, $blogCategory_id, $type)
    {
        $blogs = DB::table('blogs')->where('blog_category_id', $blogCategory_id)->get();
        $parent_id  = $request->parent_id;
        if ($parent_id) {
            $blogCategory = DB::table('blog_categories')->where('id', $parent_id)->where('id', $blogCategory_id)->where('type', $type)->first();
        } else {
            $blogCategory = DB::table('blog_categories')->whereNull('parent_id')->where('id', $blogCategory_id)->where('type', $type)->first();
        }
        return view('admin.blogCategory.blog.index', compact('parent_id', 'blogs', 'type', 'blogCategory_id', 'blogCategory'));
    }

    public function blogadd(Request $request, $blogCategory_id, $type)
    {
        $parent_id = $request->parent_id;
        $blogCategory = DB::table('blog_categories')->where('id', $blogCategory_id)->first();

        if (Helper::G()) {
            return view('admin.blogCategory.blog.add', compact('blogCategory', 'parent_id', 'type'));
        } else {
            // dd($request->all());
            $blog = new Blog();
            $blog->title = $request->title;

            if ($request->hasFile('image')) {
                $blog->image = $request->file('image')->store("uploads/blogcategory/{$blogCategory->type}", 'public');
            }
            $blog->type = $type;
            $blog->text = $request->text;
            $blog->datas = $request->datas;
            $blog->video_link = $request->video_link;
            $blog->creator_user_id = Auth::id();
            $blog->location = $request->location;
            $blog->is_featured = $request->is_featured;
            $blog->blog_category_id = $blogCategory->id;
            $blog->short_description = $request->short_description;
            $blog->submitted_by = $request->submitted_by;
            $blog->position = $request->position;
            $blog->date = Helper::convertDateToInteger($request->date);
            $blog->save();
            $this->render();
            return redirect()->back()->with('success', 'Blog Successfully Added');
        }
    }

    public function blogedit(Request $request, $blog_id)
    {
        $blog = Blog::where('id', $blog_id)->first();
        // dd($blog);
        $blogCategory = DB::table('blog_categories')->where('id', $blog->blog_category_id)->first();
        $parent_id = $request->parent_id;
        if (Helper::G()) {
            return view('admin.blogCategory.blog.edit', compact('parent_id', 'blog', 'blogCategory'));
        } else {
            $blog->text = $request->text;
            $blog->datas = $request->datas;
            $blog->title = $request->title;
            $blog->location = $request->location;
            $blog->video_link = $request->video_link;
            $blog->short_description = $request->short_description;
            $blog->submitted_by = $request->submitted_by;
            $blog->position = $request->position;
            $blog->date = Helper::convertDateToInteger($request->date);
            $blog->is_featured = $request->is_featured;
            if ($request->hasFile('image')) {
                $blog->image = $request->file('image')->store("uploads/blogcategory/{$blogCategory->type}", 'public');
            }
            $blog->save();
            $this->render();
            return redirect()->back()->with('success', 'Blog Successfully updated');
        }
    }
    public function blogdel($blog_id)
    {
        Blog::where('id', $blog_id)->delete();
        $this->render();
        return redirect()->back()->with('delete_success', 'Successfully Blog Deleted');
    }

    public function render()
    {
        //Home page
        $eventData = DB::table('blogs')->where('type', Helper::blog_type_event)->get();
        $newsData = DB::table('blogs')->where('type', Helper::blog_type_news)->where('is_featured', 0)->take(3)->get();
        $latestNews = DB::table('blogs')->where('type', Helper::blog_type_news)->where('is_featured', 1)->first();
        $updateData = DB::table('blogs')->where('type', Helper::blog_type_update)->get();
        //Event and news
        $eventTypes = DB::table('blog_categories')->where('type', helper::blog_type_event)->get();
        $indexNews = DB::table('blogs')->where('type', Helper::blog_type_news)->get();
        //Blog Category
        $indexBlogs = DB::table('blogs')->where('type', Helper::blog_type_blog)->get();
        $featuredBlogs = DB::table('blogs')->where('type', Helper::blog_type_blog)->where('is_featured', 1)->get();
        if ($featuredBlogs->isEmpty()) {
            $featuredBlogs = collect(); // Ensure an empty collection if no featured blogs
        }
        //Case Study
        $caseStudyTypes = DB::table('blog_categories')->where('type', helper::blog_type_case_study)->get();
        Helper::putCache('knowledge.casestudy',view('admin.template.knowledge.casestudy.index',compact('caseStudyTypes')));

        //News Letter
        $newsLetterTypes = DB::table('blog_categories')->where('type', helper::blog_type_news_letter)->get();
        Helper::putCache('knowledge.newsletter',view('admin.template.knowledge.newsletter.index',compact('newsLetterTypes')));

        Helper::putCache('health.knowledge.blogs',view('admin.template.health.knowledge.blogs',compact('indexBlogs')));
        Helper::putCache('knowledge.blog', view('admin.template.knowledge.blog.index', compact('indexBlogs', 'featuredBlogs'))->render());
        Helper::putCache('event.index', view('admin.template.event.index', compact('indexNews', 'eventTypes'))->render());
        Helper::putCache('home.updates', view('admin.template.home.update', compact('updateData'))->render());
        Helper::putCache('home.newsEvent', view('admin.template.home.news', compact('newsData', 'eventData', 'latestNews', 'eventTypes',))->render());
        Helper::putCache('health.event',view('admin.template.health.event',compact('eventData')));
    }
}
