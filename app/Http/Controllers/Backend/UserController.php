<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile(Request $request)
    {
        return view('backend.pages.user.index');
    }
}
