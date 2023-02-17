<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Supports\Utilitis\EasyReturn;

class TagController extends Controller
{
    use EasyReturn;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return view('backend.pages.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:1000',
        ]);
        // if (!isset($request->status)) {
        //     return "ok";
        // }
        isset($request->status) == null ? $request['status'] = 0 : $request['status'] = 1;

        // return $request->all();
        $tag = Tag::create($request->all());
        return $this->returnBack("Tag created Successfully");
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
        $tag = Tag::find($id);
        return view('backend.pages.tag.edit', compact('tag'));
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
        isset($request->status) == null ? $request['status'] = 0 : $request['status'] = 1;
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->status = $request->status;
        $tag->update();

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }


    /**
     * Remove the selected resource from storage.
     *
     * @param  array() $id
     * @return \Illuminate\Http\Response
     */
    public function tagsBulkDestroy(Request $request)
    {
        if (empty($request->tag)) {
            return $this->returnBack('Select tag');
        }
        if ($request->actionType == 1) {
            foreach ($request->tag as $tag_id) {
                Tag::find($tag_id)->delete();
            }
        }else if ($request->actionType == 2) {
            foreach ($request->tag as $tag_id) {
                Tag::find($tag_id)->forceDelete();
            }
        }
        return $this->returnBack();
    }


    /**
     * Return Trashed Tags from DB.
     * @return \Illuminate\Http\Response
     */
    public function trashedTags(Request $request)
    {
       $tags = Tag::onlyTrashed()->paginate(12);
       return view('backend.pages.tag.trash', compact('tags'));
    }


    /**
     * Remove or Restore the selected resource from storage.
     *
     * @param  array() $id
     * @return \Illuminate\Http\Response
     */
    public function trashedTagsHandle(Request $request)
    {
        if(empty($request->actionType)){
            return $this->returnBack('Select TAg');
        }
        if ($request->actionType == 1 ) {
            foreach ($request->tags as $tag_id) {
                Tag::withTrashed()->find($tag_id)->restore();
            }
            return $this->returnBack("Tag Resoted Successfully");
        }else if($request->actionType == 2){
            foreach ($request->tags as $tag_id) {
                Tag::withTrashed()->find($tag_id)->forceDelete();
            }
            return $this->returnBack("Tag Deleted Successfully");
        }
        return $this->returnBack("Faild");
    }



}
