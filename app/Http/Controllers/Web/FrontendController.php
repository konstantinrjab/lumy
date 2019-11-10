<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function __invoke()
    {
        return view()->make('frontend/index');
    }
}
