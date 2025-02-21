<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function index(){
        $treatments = DB::table('treatments')->get(['id','title','short_description']);
        return view('admin.treatment.index',compact('treatments'));
    }

    public function add(Request $request){
        if(Helper::G($request)){
            return view('admin.treatment.add');
        }else{
            $treatment = new Treatment();
            $treatment->title = $request->title;
            $treatment->short_description = $request->short_description;
            if($request->has("icon")){
                $treatment->icon = $request->file('icon')->store('uploads/treatments','public');
            }
            if($request->has("single_page_image")){
                $treatment->single_page_image = $request->file('single_page_image')->store('uploads/treatments','public');
            }
            $treatment->save();
            return redirect()->back();
        }
    }
    public function edit(Request $request, $treatment_id){
        $treatment = Treatment::where('id',$treatment_id)->first();
        if(Helper::G($request)){
            return view('admin.treatment.edit', compact('treatment'));
        }else{
            $treatment->title = $request->title;
            $treatment->short_description = $request->short_description;
            if($request->has("icon")){
                $treatment->icon = $request->file('icon')->store('uploads/treatments','public');
            }
            if($request->has("single_page_image")){
                $treatment->single_page_image = $request->file('single_page_image')->store('uploads/treatments','public');
            }
            $treatment->save();
            return redirect()->route('admin.treatment.index')->with('success', 'Treatment updated successfully.');
        }
    }
    public function del($treatment_id){
        Treatment::where('id',$treatment_id)->delete();
        return redirect()->route('admin.treatment.index');
    }
}
