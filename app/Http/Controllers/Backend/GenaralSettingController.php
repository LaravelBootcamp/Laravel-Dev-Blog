<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supports\Database\GenaralSettingHelpers;
use App\Supports\Utilitis\{
    EasyReturn, FileHandle,
};
use App\Models\{
    GenaralSetting,File
};

class GenaralSettingController extends Controller
{
    use GenaralSettingHelpers, EasyReturn, FileHandle;

    /**
     * Display the Genaral Setting page 
     * 
     */
    public function index(Request $request)
    {
        $siteInfo = GenaralSetting::pluck('value', 'key');
        $logo = $this->getSetting('site_logo')->file;
        // return $logo;
        return view('backend.pages.genaralsetting.index', compact('siteInfo', 'logo'));
    }
    /**
     * @param key
     * @param value
     * @return redirect back with update status
     * 
     * */
    public function siteSettingUpdate(Request $request)
    {
        $data = $request->except(['_token', 'site_logo']);
        foreach ($data as $key => $value) {
            $setingId = $this->addOrUpdate($key, $value);
        }

        if ($request->hasFile('site_logo')) {
            if ( GenaralSetting::where('key', 'site_logo')->count() > 0 ) {
                $setting = GenaralSetting::where('key', 'site_logo')->first();
                //$fileUpData = $this->uploadFile($request->file('site_logo'));

                // return $this->replaceFile($request->file('site_logo'), $setting);
                // return $request->file('site_logo');

                $setting->file()->create($this->replaceFile($request->file('site_logo'), $setting->file));
            }else{
                $settingRow = GenaralSetting::create([
                    'key'       => 'site_logo', 
                    'value'     => 'null'
                ]);
                $fileUpData = $this->uploadFile($request->file('site_logo'));
                $settingRow->file()->create($fileUpData);
            }
           
        }
        return $this->returnBack();
    }
}