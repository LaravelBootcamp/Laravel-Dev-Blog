<?php 

namespace App\Supports\Utilitis;
use Illuminate\Support\Facades\Storage;
use Auth;

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
		$db_delete = File::find($file->id)->delete();
		return $delete;
	}
}