<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supports\Utilitis\FileHandle;
use App\Supports\Utilitis\EasyReturn;
use App\Models\{File, Category};

class CategoryController extends Controller
{
    use FileHandle, EasyReturn;

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
        $categorys = Category::with('file')->get();
        // return $categorys;
        return view('backend.pages.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Net to fix;
        //return $request;
        $cat = Category::create([
            'name' => $request->name,
            'description' => "Cat one description",
            'status'        => $request->status ? $request->status : 0,
        ]);

        if ($request->hasFile('category_image')) {
            $cat->file()->create($this->uploadFile($request->file('category_image')));
        }
        return redirect()->back();
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
        $cat = Category::find($id);

        $file_info = $cat->file;
        if (!empty($file_info)) {
            $delete = $this->deleteFile($file_info);
        }

        $cat->delete();
        // $cat->file()->delete();
        return redirect()->back();
    }


    /**
     * @param array();
     * @return status of delete
     */
    public function bulkDelete(Request $request)
    {
        if (empty($request->category)) {
            return $this->returnBack('Select Category');
        }

        if ($request->actionType == 1) {
            foreach($request->category as $cat_id){
                $cats = Category::find($cat_id);
                $cats->delete();
            }
            return $this->returnBack('Category Delete Successfully');
        }else if($request->actionType == 2){
            foreach($request->category as $cat_id){
                $cats = Category::find($cat_id);
                $this->deleteFile($cats->file);
                $cats->file->delete();
            }
            return  $this->returnBack("Image Delete Successfully");
        }else if($request->actionType == 3){
            foreach($request->category as $cat_id){
                $cats = Category::find($cat_id);
                if (!empty($cats->file)) {
                    $this->deleteFile($cats->file);
                    $cats->file->delete();
                }
                
                $cats->delete();
            }
            return $this->returnBack("Category & Image Delete Successfully");
        }
        return $this->returnBack("Delete Faild");
    }

    /**
     * @return Category trashed data with view
     * */

    public function trashedCategory(Request $request)
    {
        // return "OK";
        $categorys = Category::onlyTrashed()->get();
        return view('backend.pages.category.trash', compact('categorys'));
    }
}
