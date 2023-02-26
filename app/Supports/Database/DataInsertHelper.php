<?php
namespace App\Supports\Database;

use Illuminate\Support\Str;


trait DataInsertHelper{

	public function uinqueSlug( $data, $modelName=self, $colName ='slug' ){
        $slug = Str::slug($data, '-');
        $count = $modelName::where($colName, 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count  : '';
        return $newCount > 0 ? "$slug-$newCount" : "$slug";
    }

    public static function getTableName()
    {
        return ((new self)->getTable());
    }
}