<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Supports\Utilitis\{EasyReturn, FileHandle};
use App\Models\{Post, Category, Tag};

class PostController extends Controller
{
    use EasyReturn, FileHandle;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        // return $posts;
        return view('backend.pages.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorys = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        return view('backend.pages.post.create', compact('categorys', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->tags;


        $valid = $request->validate([
            'title'     => 'required|max:256',
            'file'      => 'file|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $post = new Post();
        $post->user_id      = Auth::id();
        $post->category_id  = $request->category;
        $post->title        = $request->title;
        $post->body         = $request->body;
        $post->status       = $request->status ? $request->status : 0;
        $post->meta_keywords = json_encode(explode(',', $request->meta_keywords));
        $post->save();



        foreach ($request->tags as $tag) {
            $post->tag()->attach($tag);
        }

        //upload file 
        if ($request->hasFile('post_thumbnail')) {
            $post->file()->create($this->uploadFile($request->file('post_thumbnail')));
        }
        return $this->returnBack('Post Saved Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
