<?php 
namespace App\Supports\Database;

use App\Models\GenaralSetting;

trait GenaralSettingHelpers{
	/**
     * Add a settings value
     *
     * @param $key
     * @param $val
     * @return bool
     */
    public function addOrUpdate($key, $val)
    {
        // return $val;
        if ( GenaralSetting::where('key', $key)->count() > 0) {
            return GenaralSetting::where('key', $key)->update(['value' => $val]);
        }
        return GenaralSetting::create(['key' => $key, 'value' => $val]);
    }



    /**
     * @param key name 
     * @return value of the query
     * */
    public function getSetting($key)
    {
        $result = GenaralSetting::where('key', $key)->first();
        return $result;
    }
}