<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Aliment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlimentController extends Controller
{
    public function index(){
        $aliments = DB::table('aliments')->get(['id','title','short_description']);
        return view('admin.aliment.index',compact('aliments'));
    }

    public function add(Request $request){
        if(Helper::G($request)){
            return view('admin.aliment.add');
        }else{
            $aliment = new Aliment();
            $aliment->title = $request->title;
            $aliment->short_description = $request->short_description;
            if($request->has("icon")){
                $aliment->icon = $request->file('icon')->store('uploads/aliments','public');
            }
            if($request->has("single_page_image")){
                $aliment->single_page_image = $request->file('single_page_image')->store('uploads/aliments','public');
            }
            $aliment->save();
            return redirect()->back();
        }
    }

    public function edit(Request $request, $aliment_id){
        $aliment = Aliment::where('id',$aliment_id)->first();
        if(Helper::G($request)){
            return view('admin.aliment.edit', compact('aliment'));
        }else{
            $aliment->title = $request->title;
            $aliment->short_description = $request->short_description;
            if($request->has("icon")){
                $aliment->icon = $request->file('icon')->store('uploads/aliments','public');
            }
            if($request->has("single_page_image")){
                $aliment->single_page_image = $request->file('single_page_image')->store('uploads/aliments','public');
            }
            $aliment->save();
            return redirect()->route('admin.aliment.index')->with('success', 'Aliment updated successfully.');
        }
    }

    public function del($aliment_id){
        Aliment::where('id',$aliment_id)->delete();
    }
}
