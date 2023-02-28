<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\{User, Post, Tag, Category};
use App\Supports\Utilitis\{EasyReturn, FileHandle};


class UserController extends Controller
{
    use EasyReturn, FileHandle;
    public function userProfile(Request $request)
    {
        $total_post = Post::where('user_id', Auth::id())->get()->count();
        $total_category = Category::get()->count();
        $total_tag = Tag::get()->count();
        return view('backend.pages.user.index', compact('total_post', 'total_category', 'total_tag'));
    }


    public function userUpdate(Request $request)
    {
        // $data = $request->all();

        $user = User::with('file')->find(Auth::id());
        $user->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
        ]);

        if ($request->hasFile('userAvt') && is_null($user->file)) {
            $user->file()->create($this->uploadFile($request->file('userAvt')));
        }elseif ($request->hasFile('userAvt') && !is_null($user->file)) {
            $user->file()->create($this->replaceFile($request->file('userAvt'), $user->file));
        }
        return $this->returnBack();
    }
}
