<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Video;
use App\Models\VideoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function indexType(Request $request)
    {
        if (Helper::G()) {
            $videoTypes = DB::table('video_types')->get();
            $doctors = DB::table('doctors')->get(['id', 'title']);
            return view('admin.video.type.index', compact('videoTypes', 'doctors'));
        } else {
            $video = new VideoType();
            $video->title = $request->title;
            $video->home_video = $request->home_video;
            $video->doctor_id = $request->doctor_id;
            $video->save();
            $this->render();
            return redirect()->back()->with('success', 'Video Type SuccessFully Added');
        }
    }
    public function delType($type_id)
    {
        Video::where('video_type_id', $type_id)->delete();
        VideoType::where('id', $type_id)->delete();
        $this->render();
        session()->flash('delete_success', 'Video Type Successfully Deleted');
        return response()->json(['success' => true]);
    }

    public function index(Request $request, $type_id)
    {
        if (Helper::G()) {
            $videoType = DB::table('video_types')->where('id', $type_id)->first(['id', 'title', 'home_video','doctor_id']);
            // dd($videos);
            return view('admin.video.index', compact('videoType'));
        } else {
            $video = new Video();
            $video->video_link = $request->input('video_link');
            $video->title = $request->input('title');
            $video->extra_data = $request->extra_data;
            $video->video_image = $request->video_image;
            $video->video_type_id = $type_id;
            $video->save();
            $this->render();
            session()->flash('success', 'Award Successfully updated');
            return response()->json(['success' => true]);
        }
    }
    public function edit(Request $request, $video_id)
    {
        $video = Video::where('id', $video_id)->first();
        $video->title = $request->title;
        $video->video_link = $request->video_link;
        $video->extra_data = $request->extra_data;
        $video->video_image = $request->video_image;
        $video->save();
        $this->render();
        return redirect()->back()->with('success', 'Video Successfully Updated');
    }

    public function del($video_id)
    {
        Video::where('id', $video_id)->delete();
        $this->render();
        return redirect()->back()->with('delete_success', 'Video Successfully deleted');
    }

    public function render()
    {


        $VideoType = DB::table('video_types')->where('home_video', 1)->first();
        if($VideoType){
            $homeVideos = Video::where('video_type_id', $VideoType->id)->get();
            Helper::putCache('home.videos', view('admin.template.home.videos', compact('VideoType', 'homeVideos'))->render());
        }
        $videoTypes = DB::table('video_types')->get(['id', 'title']);

        $videos = DB::table('videos')->get();

         Helper::putMetaCache('knowledge.videos', $data = [
            'title' => 'All Videos',
            'description' => 'All Videos and categories available in Nobel Hospital.',
            'keywords' => 'videos',
            'url' => route('knowledge.videos')
         ]);
        Helper::putCache('knowledge.video.all', view('admin.template.knowledge.video.singleType', compact('videoTypes', 'videos'))->render());
        Helper::putCache('health.knowledge.video', view('admin.template.health.knowledge.video', compact('videos'))->render());
        Helper::putCache('knowledge.video', view('admin.template.knowledge.video.index', compact('videoTypes'))->render());
    }
}
