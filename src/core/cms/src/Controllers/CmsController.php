<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    //
    public function index() {
        return view('cms::auth.pages.dashboard.index');
    }
}
