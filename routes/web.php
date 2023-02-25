<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\{
    PostController, CategoryController, TagController, GenaralSettingController, UserController
};

use App\Http\Controllers\Frontend\{
    PostController as FrontPostController,
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

/** Admin route **/
Auth::routes();




/** Frontend routs */

Route::get('/', [FrontPostController::class, 'index'])->name('home');

Route::get('/{slug}', [FrontPostController::class, 'postView'])->name('post.single');



//Posts 
Route::prefix('dashboard')->middleware('auth')->group(function() {
    Route::get('/admin', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('post', PostController::class);
    Route::resource('categorie', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::get('trashedtags', [TagController::class, 'trashedTags'])->name('trashedTags');
    Route::post('trashedTagsHandle', [TagController::class, 'trashedTagsHandle'])->name('trashedTagsHandle');
    Route::post('tagsBulkDestroy', [TagController::class, 'tagsBulkDestroy'])->name('tagsBulkDestroy');
    Route::post('/bulkcatdelete', [CategoryController::class, 'bulkDelete'])->name('bulkCatDelete');
    Route::get('/cats/trash', [CategoryController::class, 'trashedCategory'])->name('trushCats');
    Route::post('/cats/trashdelete', [CategoryController::class, 'bulkCatFourceDelete'])->name('bulkCatFourceDelete');

    //Post addition routs
    Route::get('/trashedPost', [PostController::class, 'trashPost'])->name('trashPostShow');
    Route::post('/bulkPostAction', [PostController::class, 'bulkPostAction'])->name('bulkPostAction');
    // Route::post('/bulkPostRestore', [PostController::class, 'bulkPostRestore'])->name('bulkPostRestore');


    Route::post('imageupload', [PostController::class, 'uploadImage'])->name('image.upload');

    // Genaral Routs
    Route::get('genaral-setting', [GenaralSettingController::class, 'index'])->name('gs.show');
    Route::post('genaral-setting/siteSettingUpdate', [GenaralSettingController::class, 'siteSettingUpdate'])->name('gs.siteSettingUpdate');
    Route::post('genaral-setting/menuBuilder', [GenaralSettingController::class, 'menuBuilder'])->name('gs.menuBilder');

    //users route

    Route::get('user-profile', [UserController::class, 'userProfile'])->name('userProfile');
    Route::post('user-update', [UserController::class, 'userUpdate'])->name('userUpdate');
});



