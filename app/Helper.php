<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Helper
{
    /**
     * Check if the request method is GET
     */
    public static function G(Request $request): bool
    {
        return $request->isMethod('get');
    }

    /**
     * Check if the request method is POST
     */
    public static function P(Request $request): bool
    {
        return $request->isMethod('post');
    }
}
