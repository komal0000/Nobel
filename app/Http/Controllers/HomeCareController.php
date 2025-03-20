<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\HomeCare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeCareController extends Controller
{
    public function index(){
        $HomeCareData = DB::table('home_cares')->get(['id', 'title']);
        return view('admin.homeCare.index',compact('HomeCareData'));
    }

    public function add(Request $request){
        if(Helper::G()){
            return view('admin.homeCare.add');
        }else{
            $HomeCare = new HomeCare();
            $HomeCare->title = $request->title;
            $HomeCare->image = $request->image;
            $HomeCare->link = $request->link;
            $HomeCare->save();
            return redirect()->back()->with('success', 'HomeCare Successfully Added');
        }
    }

    public function edit(Request $request, $id){
        $HomeCare = HomeCare::where('id', $id)->first();
        if(Helper::G()){
            return view('admin.homeCare.edit', compact('HomeCare'));
        }else{
            $HomeCare->title = $request->title;
            $HomeCare->image = $request->image;
            $HomeCare->link = $request->link;
            $HomeCare->save();
            return redirect()->back()->with('success', 'HomeCare Successfully Updated');
        }
    }

    public function del($id){
        HomeCare::where('id', $id)->delete();
        return redirect()->back()->with('delete_success', 'HomeCare Successfully Deleted');
    }

}
