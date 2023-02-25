<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Post, User, File};
use Illuminate\Database\Eloquent\Relations\MorphOne ;


class PostController extends Controller
{
    public function index()
    {
        // $data = Post::with(['user.file'])->find(4);
        // return $data;


        $posts = Post::with(['file', 'category', 'user.file'])->get();
        // return $posts;
        $author = User::find(1);
        return view('frontend.pages.home', compact('posts', 'author'));
    }


    public function postView(Request $request, $slug)
    {
        $post = Post::with(['file', 'tag', 'category', 'user.file'])->whereSlug($slug)->first();
        return view('frontend.pages.post-single', compact('post'));
    }
}
