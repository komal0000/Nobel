<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        return view('admin.speciality.index');
    }
}
