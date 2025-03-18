<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function indexType(Request $request){
        if(Helper::G()){
            return view('admin.video.type.index');
        }else{
            $video = new Video();
            $video->title = $request->title;
            $video->save();
        }
    }
}
