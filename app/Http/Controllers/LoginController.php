<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Helper::G($request)) {
            return view('admin.login');
        } else {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            }else{
                return redirect()->back()->with('error','Credential Mismatch');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }
}
