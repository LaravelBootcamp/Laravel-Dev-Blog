<?php 

namespace App\Supports\Utilitis;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Category;

use App\Models\File;


/**
 * @param $file
 * @return array for File Model
*/
trait FileHandle
{
	public function uploadFile($file)
	{
        $formatedName = preg_replace('/\s+|[^A-Za-z0-9\. ]/', '_', $file->getClientOriginalName());
        $fName = time().'_'.$formatedName;
        $upPath = "image/".date('Y')."/".date('m');
        $store = $file->storeAs("public/".$upPath, $fName);
        $viewPath = '/storage/'.$upPath.'/'.$fName;
        $uploadData = [
            'orginal_name'  => $file->getClientOriginalName(),
            'storage_path'   => $store,
            'view_path'      => $viewPath,
            'file_size'     => $file->getSize(),
            'file_type' => $file->getClientOriginalExtension(),
            'user_id' => Auth::id(),
        ];

        return $uploadData;
	}


	/**
	 * @param file
	 * @return file delete status 
	 */

	public function deleteFile($file)
	{
		if (empty($file)) {
			return true;
		}
		$delete = Storage::delete($file->storage_path);
		$db_delete = File::withTrashed()->find($file->id)->delete();
		return $delete;
	}


	/**
	 * @param file
	 * @return file delete and set new imae 
	 */

	public function replaceFile($newFile, $cat_id)
	{
		if (empty($newFile)) {
			return true;
		}
		$oldFile = Category::withTrashed()->find($cat_id);
		
		if (!empty($oldFile->file)) {
			// return $oldFile->file->storage_path;
			$delete = Storage::delete($oldFile->file->storage_path);
			$db_delete = File::withTrashed()->find($oldFile->file->id)->forceDelete();
		}


		// insert new		
		$save_to_store = $this->uploadFile($newFile);
		return $save_to_store;
		$db_insert = File::create($save_to_store);
		return $save_to_store;
	}


}