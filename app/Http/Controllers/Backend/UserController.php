<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Supports\Utilitis\{EasyReturn, FileHandle};


class UserController extends Controller
{
    use EasyReturn;
    public function userProfile(Request $request)
    {
        return view('backend.pages.user.index');
    }


    public function userUpdate(Request $request)
    {
        // $data = $request->all();
        $user = User::find(Auth::id())->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
        ]);
        
        return $this->returnBack();
    }
}
