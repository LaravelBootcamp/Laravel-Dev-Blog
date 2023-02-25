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

        // return $request;

        $valid = $request->validate([
            'title'     => 'required|max:256',
            'file'      => 'file|mimes:jpg,png,jpeg,gif,svg',
            'category'  => 'required|not_in:0'
        ]);

        $post = new Post();
        $post->user_id      = Auth::id();
        $post->category_id  = $request->category;
        $post->title        = $request->title;
        $post->body         = $request->body;
        $post->status       = $request->status ? $request->status : 0;
        $post->meta_keywords = json_encode(explode(',', $request->meta_keywords));
        $post->save();


        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $post->tag()->attach($tag);
            }

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
        // return $id;
        $postData = Post::with(['file', 'tag'])->find($id);
        // return $postData;
        $categorys = Category::get();
        $tags = Tag::get();
        // return $postData;
        // dd(array_column($postData->tag->toArray(), 'id'));
        return view('backend.pages.post.edit', compact('postData', 'categorys', 'tags'));
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
        
        $valid = $request->validate([
            'title'     => 'required|max:256',
            'category'  => 'required',
            'file'     => 'post_thumbnail|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $post = Post::with(['file', 'tag'])->find($id);
        // return $post;

        $post->user_id          = Auth::id();
        $post->category_id      = $request->category;
        $post->title            = $request->title;
        $post->body             = $request->body;
        $post->status           = $request->status? $request->status : 0;
        $post->meta_keywords    = json_encode(explode(',', $request->meta_keywords));
        $post->update();

       
        if ($request->hasFile('post_thumbnail') && isset($post->file)) {
            //return $this->replaceFile($request->file('file'), $post->file);
            $post->file()->create($this->replaceFile($request->file('file'), $post->file));
        }elseif ($request->hasFile('post_thumbnail') && !isset($post->file)) {
            $post->file()->create($this->uploadFile($request->file('post_thumbnail')));
        }

        $post->tag()->detach(array_column($post->tag->toArray(), 'id'));

        if (isset($request->tags)) {
            foreach ($request->tags as $tag_id) {
                $post->tag()->attach($tag_id);
            }
        }
        
        return redirect()->route('post.index')->with("status", "Post Saved Successfuly");
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


    /**
     * Show trashed post page 
     */
    public function trashPost(Request $request)
    {
        $trashPost = Post::onlyTrashed()->get();
        return view('backend.pages.post.trash', compact('trashPost'));
    }


    public function bulkPostAction(Request $request)
    {
        if (empty($request->posts)) {
            return $this->returnBack();
        }

        if ($request->actionType == 1) {
            foreach ($request->posts as $post_id) {
                $post = Post::withTrashed()->find($post_id);
                $post->delete();
            }
            return $this->returnBack("Moved to Trash Successfuly");
        }elseif($request->actionType == 2){
            foreach ($request->posts as $post_id) {
                $post = Post::withTrashed()->find($post_id);
                if (!$post->file()->withTrashed()->first()) {
                    $this->deleteFile($post->file()->withTrashed()->first());
                    $post->file()->withTrashed()->forceDelete();
                }
                $post->forceDelete();
            }
            return $this->returnBack("Post Delete Successfully");            
        }elseif($request->actionType == 3){
            foreach ($request->posts as $post_id) {
                $post = Post::withTrashed()->find($post_id);
                $post->restore();
            }
            return $this->returnBack("Post Restore Successfully");   
        }
    }



    /**
     * Image upload 
     * @param photo
     * @return photo upload url 
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $uploadData = $this->uploadFile($request->file('upload'));
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = "File Upload Successfully";
            $imgPath = $uploadData['view_path'];
            $response = "<script>window.parent.CKEDITOR.tools.callFunction ('$CKEditorFuncNum', '$imgPath', '$msg') </script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
