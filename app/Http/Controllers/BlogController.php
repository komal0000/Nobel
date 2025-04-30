<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            };
            if($request->hasFile('single_page_image')) {
                $blog->single_page_image = $request->file('single_page_image')->store("uploads/blogcategory/{$blogCategory->type}");
            }
            $blog->type = $type;
            $blog->text = $request->text;
            $blog->datas = $request->datas;
            $blog->creator_user_id = Auth::id();
            $blog->location = $request->location;
            $blog->position = $request->position;
            $blog->video_link = $request->video_link;
            $blog->is_featured = $request->is_featured;
            $blog->blog_category_id = $blogCategory->id;
            $blog->submitted_by = $request->submitted_by;
            $blog->short_description = $request->short_description;
            $blog->date = Helper::convertDateToInteger($request->date);
            $blog->save();
            $this->render();
            $this->renderSingle($blog->id, $blog->type);
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
            if ($request->hasFile('image')) {
                $blog->image = $request->file('image')->store("uploads/blogcategory/{$blogCategory->type}", 'public');
            }
            if($request->hasFile('single_page_image')) {
                $blog->single_page_image = $request->file('single_page_image')->store("uploads/blogcategory/{$blogCategory->type}", 'public');
            }
            $blog->text = $request->text;
            $blog->datas = $request->datas;
            $blog->title = $request->title;
            $blog->position = $request->position;
            $blog->location = $request->location;
            $blog->video_link = $request->video_link;
            $blog->is_featured = $request->is_featured;
            $blog->submitted_by = $request->submitted_by;
            $blog->short_description = $request->short_description;
            $blog->date = Helper::convertDateToInteger($request->date);
            $blog->save();
            $this->render();
            $this->renderSingle($blog_id , $blog->type);
            return redirect()->back()->with('success', 'Blog Successfully updated');
        }
    }
    public function blogdel($blog_id)
    {
        $blog =  Blog::where('id', $blog_id)->first();
        $blog->delete();
        $this->render();
        $this->deleteCache($blog->slug, $blog->type);

        return redirect()->back()->with('delete_success', 'Successfully Blog Deleted');
    }

    public function renderSingle($blog_id, $type)
    {
        if($type = Helper::blog_type_blog) {
            $blog = DB::table('blogs')->where('id', $blog_id)->first();
            $latestBlog = DB::table('blogs')->where('type', Helper::blog_type_blog)->orderBy('id', 'desc')->take(2)->get();

            Helper::putMetaCache('knowledge.blog.' . $blog->slug, $data = [
                'title' => $blog->title,
                'description' => $blog->short_description,
                'image' => asset(asset($blog->image)),
                'url' => route('knowledge.blog.single', ['slug' => $blog->slug]),
            ]);

            Helper::putCache('knowledge.blog.' . $blog->slug, view('admin.template.knowledge.blog.single', compact('blog', 'latestBlog'))->render());
        }
        
        //News case single page
        if($type == Helper::blog_type_case_study){
            $case = DB::table('blogs')->where('id', $blog_id)->first();
            $latestCase = DB::table('blogs')->where('type', Helper::blog_type_case_study)->orderBy('id', 'desc')->take(2)->get();

            Helper::putMetaCache('knowledge.casestudy.' . $case->slug, $data = [
                'title' => $case->title,
                'description' => $case->short_description,
                'image' => asset(asset($case->image)),
                'url' => route('knowledge.casestudy.single', ['slug' => $case->slug]),
            ]);

            Helper::putCache('knowledge.casestudy.'.$case->slug, view('admin.template.knowledge.casestudy.single', compact('case', 'latestCase'))->render());
        }

        //update single page
        if($type == Helper::blog_type_update){
            $update = DB::table('blogs')->where('id', $blog_id)->first();
            $latestUpdate = DB::table('blogs')->where('type', Helper::blog_type_update)->orderBy('id', 'desc')->take(2)->get();

            if($update){
                Helper::putMetaCache('home.update.'.$update->slug, $data = [
                    'title' => $update->title,
                    'description' => $update->short_description,
                    'image' => asset(asset($update->image)),
                    'url' => route('update.single', ['slug' => $update->slug]),
                ]);
            }

            Helper::putCache('home.update.'.$update->slug, view('admin.template.home.update.single', compact('update', 'latestUpdate'))->render());
        }

        //News single page
        if($type == Helper::blog_type_news) {
            $news = DB::table('blogs')->where('id', $blog_id)->first();
            $latestNews = DB::table('blogs')->where('type', Helper::blog_type_news)->orderBy('id', 'desc')->take(2)->get();
            Helper::putMetaCache('home.news.' . $news->slug, $data = [
                'title' => $news->title,
                'description' => $news->short_description,
                'image' => asset(asset($news->image)),
                'url' => route('news.single', ['slug' => $news->slug]),
            ]);
            Helper::putCache('home.news.'.$news->slug, view('admin.template.home.news.single', compact('news', 'latestNews'))->render());
        }

        //Event single page
        if($type == Helper::blog_type_event) {
            $event = DB::table('blogs')->where('id', $blog_id)->first();
            $latestEvent = DB::table('blogs')->where('type', Helper::blog_type_event)->orderBy('id', 'desc')->take(2)->get();
            Helper::putMetaCache('event.' . $event->slug, $data = [
                'title' => $event->title,
                'description' => $event->short_description,
                'image' => asset(asset($event->image)),
                'url' => route('event.single', ['slug' => $event->slug]),
            ]);
            Helper::putCache('event.single.'.$event->slug, view('admin.template.event.single', compact('event', 'latestEvent'))->render());
        }

        //Academic single page
        if($type == Helper::blog_type_acedemic_program) {
            $academic = DB::table('blogs')->where('id', $blog_id)->first();
            $latestAcademic = DB::table('blogs')->where('type', Helper::blog_type_acedemic_program)->orderBy('id', 'desc')->take(2)->get();
            Helper::putMetaCache('academic.' . $academic->slug, $data = [
                'title' => $academic->title,
                'description' => $academic->short_description,
                'image' => asset(asset($academic->image)),
                'url' => route('academicprogram.single', ['slug' => $academic->slug]),
            ]);
            Helper::putCache('academic.single.'.$academic->slug, view('admin.template.academic.single', compact('academic', 'latestAcademic'))->render());
        }
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
        Helper::putMetaCache('knowledge.casestudy', $data = [
            'title' => 'Case Studies',
            'description' => 'List of all the case studies done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('knowledge.casestudy.index'),
        ]);
        Helper::putCache('knowledge.casestudy', view('admin.template.knowledge.casestudy.index', compact('caseStudyTypes')));

        //News Letter
        $newsLetterTypes = DB::table('blog_categories')->where('type', helper::blog_type_news_letter)->get();
        Helper::putMetaCache('knowledge.newsletter', $data = [
            'title' => 'News Letter',
            'description' => 'List of all the News Letter done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('knowledge.newsletter'),
        ]);
        Helper::putCache('knowledge.newsletter', view('admin.template.knowledge.newsletter.index', compact('newsLetterTypes')));

        //Academic Program
        $academicProgramTypes = DB::table('blog_categories')->where('type', helper::blog_type_acedemic_program)->get();
        $academicPrograms = DB::table('blogs')->where('type', Helper::blog_type_acedemic_program)->get();
        Helper::putCache('academic.list', view('admin.template.academicprogram.list', compact('academicProgramTypes','academicPrograms')));
        Helper::putMetaCache('academic.list', $data = [
            'title' => 'Academic Programs List',
            'description' => 'List of all the Academic Programs done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('academicprogram.list'),
        ]);
        Helper::putCache('academic.index', view('admin.template.academicprogram.index', compact('academicProgramTypes')));
        Helper::putMetaCache('academic.academic', $data = [
            'title' => 'Academic Programs',
            'description' => 'Academic Programs done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('academicprogram.index'),
        ]);

        //Doctor Article


        Helper::putCache('health.knowledge.blogs', view('admin.template.health.knowledge.blogs', compact('indexBlogs')));
        Helper::putMetaCache('knowledge.blogs.blog', $data = [
            'title' => 'Blogs',
            'description' => 'Blogs done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('knowledge.blog.index'),
        ]);
        Helper::putCache('knowledge.blog', view('admin.template.knowledge.blog.index', compact('indexBlogs', 'featuredBlogs'))->render());
        Helper::putCache('event.index', view('admin.template.event.index', compact('indexNews', 'eventTypes'))->render());
        Helper::putMetaCache('event.event', $data = [
            'title' => 'Events',
            'description' => 'Events done by Nobel Hospital',
            'image' => asset('front/assets/img/meta-image.png'),
            'url' => route('event'),
        ]);
        Helper::putCache('home.updates', view('admin.template.home.update', compact('updateData'))->render());
        Helper::putCache('home.newsEvent', view('admin.template.home.news', compact('newsData', 'eventData', 'latestNews', 'eventTypes',))->render());
        Helper::putCache('health.event', view('admin.template.health.event', compact('eventData')));
    }
    public function deleteCache($slug, $type)
    {
        if ($type == Helper::blog_type_blog) {
            Helper::deleteCache('knowledge.blog.' . $slug);
            Helper::deleteMetaCache('knowledge.blog.' . $slug);
        }
        if ($type == Helper::blog_type_news) {
            Helper::deleteCache('home.news.' . $slug);
            Helper::deleteMetaCache('home.news.' . $slug);
        }
        if ($type == Helper::blog_type_event) {
            Helper::deleteCache('event.single.' . $slug);
            Helper::deleteMetaCache('event.' . $slug);
        }
        if ($type == Helper::blog_type_update) {
            Helper::deleteCache('home.update.' . $slug);
            Helper::deleteMetaCache('home.update.' . $slug);
        }
    }
}
