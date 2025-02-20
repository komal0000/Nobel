<?php

namespace App;

use Illuminate\Support\Facades\Request;

class Helper {

    public static function G(Request $request): bool
    {
        return $request->isMethod('get');
    }
    public static function P(Request $request): bool
    {
        return $request->isMethod('post');
    }
}
