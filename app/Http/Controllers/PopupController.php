<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopupController extends Controller
{
public function index()
{
    $popups = DB::table('popups')->get(['id', 'title', 'image']);
    return view('admin.popup.index', compact('popups'));
}

public function add(Request $request)
{
    if (Helper::G($request)) {
        return view('admin.popup.add');
    } else {
        $popup = new Popup();
        $popup->title = $request->title;

        if ($request->hasFile('image')) {
            $popup->image = $request->file('image')->store('uploads/popup', 'public');
        }

        $popup->save();
        $this->render();
        return redirect()->back()->with("success", "Popup Successfully Added");
    }
}

public function edit(Request $request, $popup_id)
{
    $popup = Popup::where('id', $popup_id)->first();

    if (Helper::G($request)) {
        return view('admin.popup.edit', compact('popup'));
    } else {
        $popup->title = $request->title;

        if ($request->hasFile('image')) {
            $popup->image = $request->file('image')->store('uploads/popup', 'public');
        }

        $popup->save();
        $this->render();
        return redirect()->back()->with("success", "Popup Successfully Updated");
    }
}

public function del($popup_id)
{
    Popup::where('id', $popup_id)->delete();
    $this->render();
    return redirect()->back()->with("delete_success", "Popup Successfully Deleted");
}

public function render()
{
    $popups = DB::table('popups')->get(['id', 'title', 'image']);
    Helper::putCache('home.popup', view('admin.template.home.popup', compact('popups'))->render());
}
}
