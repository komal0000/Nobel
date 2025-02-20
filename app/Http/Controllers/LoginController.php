<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.login');
        } else {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('admin.index')->with('success', 'Login successful!');
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
