<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Post, User, File, Category, Tag};


class PostController extends Controller
{
    public function index()
    {
        // $data = Post::with(['user.file'])->find(4);
        // return $data;


        $posts = Post::with(['file', 'category', 'user.file'])->get();
        $author = User::find(1);
        $menu = getSetting('nav_menu');
        return view('frontend.pages.home', compact('posts', 'author'));
    }


    public function postView(Request $request, $slug)
    {
        $post = Post::with(['file', 'tag', 'category', 'user.file'])->whereSlug($slug)->first();
        return view('frontend.pages.post-single', compact('post'));
    }

    public function archiveView(Request $request, $cat_slug)
    {
        $cats = Category::whereSlug($cat_slug)->get()->toArray();
        $posts = Post::whereIn('category_id', array_column($cats, 'id'))->get();
        return view('frontend.pages.post-archive', compact('posts'));
    }

    public function tagArchiveView(Request $request, $slug)
    {
        $data =  Tag::whereSlug($slug)->with(['post.user', 'post.category', 'post.user'])->first();
        // $tagPosts =  Tag::whereSlug($slug)->get()->toArray();


        $tagPosts = $data->post;
        // $tag_id = array_column($tagPosts, 'id');
        return view('frontend.pages.post-tag-archive', compact('tagPosts'));
    }
}
