<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function indexType(Request $request){
        if(Helper::G()){
            return view('admin.video.type.index');
        }
    }
}
