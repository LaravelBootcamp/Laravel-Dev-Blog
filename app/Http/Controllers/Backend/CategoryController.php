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
        $categorys = Category::with('file')->latest()->paginate(10);
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
        $category =  Category::with('file')->find($id);
        // return $category;
        return view('backend.pages.category.edit', compact('category'));
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
        $request['status'] = $request->status ? $request->status : 0;
        // $category = Category::where('id', $id)->update([
        //     'name'  => $request->name,
        //     'description'   => $request->description,
        //     'status'       => $request->status,
        // ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->update();

        if ($request->hasFile('category_image')) {
            //return $this->replaceFile($request->file('category_image'), $id);
           $category->file()->create($this->replaceFile($request->file('category_image'), $id));
        }

        return redirect()->route('categorie.index');
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
            return $this->returnBack('Category moved to trash successfully');
        }else if($request->actionType == 2){
            foreach($request->category as $cat_id){
                $cats = Category::find($cat_id);
                $cats->file->delete();
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
        $categorys = Category::onlyTrashed()->with(['file' => function($q){
            $q->withTrashed()->get();
        }])->get();
        //return $categorys;
        return view('backend.pages.category.trash', compact('categorys'));
    }


    /**
     * @param Cagegory Id in array
     * @return Category Permanently delete 
     * */
    public function bulkCatFourceDelete(Request $request)
    {
        if (empty($request->category)) {
            return $this->returnBack('Select Category');
        }

        if ($request->actionType == 1) {
            foreach($request->category as $cat_id){
                $cats = Category::withTrashed()->find($cat_id);
                $cats->forceDelete();
            }
            return $this->returnBack('Category Delete Successfully');
        }else if($request->actionType == 2){
            foreach($request->category as $cat_id){
                $cats = Category::withTrashed()->find($cat_id);
                // return $cats->file()->withTrashed()->get();
                if (!empty($cats->file()->withTrashed()->first())) {
                    $this->deleteFile($cats->file()->withTrashed()->first());
                    $cats->file()->withTrashed()->forceDelete();
                }
                $cats->forceDelete();
            }
            return $this->returnBack("Category & Image Delete Successfully");
        }elseif ($request->actionType == 3) {
            foreach($request->category as $cat_id){
                $cat = Category::withTrashed()->find($cat_id);
                $file = $cat->file()->withTrashed()->first();
                $file->restore();
                $cat->restore();
            }
        }
        return $this->returnBack("Delete Faild");
    }
}
