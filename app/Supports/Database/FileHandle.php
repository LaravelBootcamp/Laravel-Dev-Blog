<?php 

namespace App\Supports\Database;
use Auth;


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
}