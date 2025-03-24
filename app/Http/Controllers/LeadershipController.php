<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadershipController extends Controller
{
    public function index(){
        $leaderships = DB::table('leaderships')->get(['id','position','title']);
        return view('admin.leadership.index',compact('leaderships'));
    }

    public function add(Request $request){
        if(Helper::G()){
            return view('admin.leadership.add');
        }else{
            $leadership = new Leadership();
            $leadership->title = $request->title;
            $leadership->position = $request->position;
            $leadership->description = $request->description;
            if($request->hasFile('image')){
                $leadership->image = $request->file('image')->store('uploads/leadership','public');
            }
            $leadership->save();
            $this->render();
            return redirect()->back()->with('success', 'Leadership added successfully.');
        }
    }

    public function edit(Request $request , $leadership_id){
        $leadership = Leadership::where('id',$leadership_id)->first();
        if(Helper::G()){
            return view('admin.leadership.edit',compact('leadership'));
        }else{
            $leadership->title = $request->title;
            $leadership->position = $request->position;
            $leadership->description = $request->description;
            if($request->hasFile('image')){
                $leadership->image = $request->file('image')->store('uploads/leadership','public');
            }
            $leadership->save();
            $this->render();
            return redirect()->back()->with('success', 'Leadership Updated successfully.');
        }
    }
    public function del($leadership_id){
        Leadership::where('id',$leadership_id)->delete();
        $this->render();
        return redirect()->back()->with('delete_success', 'Leadership Deleted successfully');
    }

    public function render(){
        $leaderships = DB::table('leaderships')->get(['id','position','title','image','description']);
        Helper::putCache('career.leaderships',view('admin.template.career.leadership',compact('leaderships'))->render());
    }
}
