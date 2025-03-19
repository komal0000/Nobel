<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Video;
use App\Models\VideoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function indexType(Request $request){
        if(Helper::G()){
            $videoTypes = DB::table('video_types')->get(['id','title']);
            return view('admin.video.type.index',compact('videoTypes'));
        }else{
            $video = new VideoType();
            $video->title = $request->title;
            $video->save();
            return redirect()->back()->with('success','Video Type SuccessFully Added');
        }
    }
    public function editType(Request $request,$type_id){
        $video = VideoType::where('id',$type_id)->first();
        $video->title = $request->input('title');
        $video->save();
        session()->flash('success', 'Video Type  Successfully Updated');
        return response()->json(['success' => true ]);
    }
    public function delType($type_id){
        Video::where('video_type_id',$type_id)->delete();
        VideoType::where('id',$type_id)->delete();
        session()->flash('delete_success', 'Video Type Successfully Deleted');
        return response()->json(['success' => true ]);
    }

    public function index($type_id){
        $videoType = DB::table('video_types')->where('id',$type_id)->first(['id','title']);
        $videos = DB::table('videos')->get(['id','title']);
        return view('admin.video.index',compact('videoType','videos'));
    }
    public function add(Request $request,$type_id){
        $videoType = DB::table('video_types')->where('id',$type_id)->first(['id','title']);
        if(Helper::G()){
            return view('admin.video.add',compact('videoType'));
        }else{
            $video = new Video();
            $video->video_link = $request->video_link;
            $video->title = $request->title;
            $video->extra_data = $request->extra_data;
            $video->video_type_id = $videoType->id;
            $video->save();
            return redirect()->back()->with('success','Video Successfully Added');
        }
    }
    public function edit(Request $request, $video_id){
        $video = Video::where('id', $video_id)->first();
        $videoType = DB::table('video_types')->where('id',$video->video_type_id)->first(['id','title']);
        if(Helper::G()){
            return view('admin.video.edit',compact('video','videoType'));
        }else{
            $video->video_link = $request->video_link;
            $video->title = $request->title;
            $video->extra_data = $request->extra_data;
            $video->save();
            return redirect()->back()->with('success', 'Video Successfully Updated');
        }
    }

    public function del($video_id){
        Video::where('id', $video_id)->delete();
        return redirect()->back()->with('delete_success', 'Video Successfully deleted');

    }
}
