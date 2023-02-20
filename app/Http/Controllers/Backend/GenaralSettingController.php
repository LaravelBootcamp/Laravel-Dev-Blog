<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenaralSettingController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.pages.genaralsetting.index');
    }

    public function siteSettingUpdate(Request $request)
    {
        
        // return view('')
    }
}
