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
            if($request->hasFile('image')){
                $HomeCare->image = $request->file('image')->store('uploads/homeCare','public');
            }
            $HomeCare->link = $request->link;
            $HomeCare->save();
            $this->render();
            return redirect()->back()->with('success', 'HomeCare Successfully Added');
        }
    }

    public function edit(Request $request, $id){
        $HomeCare = HomeCare::where('id', $id)->first();
        if(Helper::G()){
            return view('admin.homeCare.edit', compact('HomeCare'));
        }else{
            $HomeCare->title = $request->title;
            if($request->hasFile('image')){
                $HomeCare->image = $request->file('image')->store('uploads/homeCare','public');
            }
            $HomeCare->link = $request->link;
            $HomeCare->save();
            $this->render();
            return redirect()->back()->with('success', 'HomeCare Successfully Updated');
        }
    }

    public function del($id){
        HomeCare::where('id', $id)->delete();
        $this->render();
        return redirect()->back()->with('delete_success', 'HomeCare Successfully Deleted');
    }

    public function render()
    {
        $HomeCareData = DB::table('home_cares')->get(['id', 'title', 'image', 'link'])->take(5);
        Helper::putCache('home.care',view('admin.template.home.care',compact('HomeCareData'))->render());
    }

}
