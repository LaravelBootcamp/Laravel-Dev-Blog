<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\{
    PostController, CategoryController, TagController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



/** Admin route **/

Auth::routes();

//Posts 
Route::prefix('dashboard')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('post', PostController::class);
    Route::resource('categorie', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::get('trashedtags', [TagController::class, 'trashedTags'])->name('trashedTags');
    Route::post('trashedTagsHandle', [TagController::class, 'trashedTagsHandle'])->name('trashedTagsHandle');
    Route::post('tagsBulkDestroy', [TagController::class, 'tagsBulkDestroy'])->name('tagsBulkDestroy');
    Route::post('/bulkcatdelete', [CategoryController::class, 'bulkDelete'])->name('bulkCatDelete');
    Route::get('/cats/trash', [CategoryController::class, 'trashedCategory'])->name('trushCats');
    Route::post('/cats/trashdelete', [CategoryController::class, 'bulkCatFourceDelete'])->name('bulkCatFourceDelete');
});