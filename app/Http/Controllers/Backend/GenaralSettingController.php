<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supports\Database\GenaralSettingHelpers;
use App\Supports\Utilitis\{
    EasyReturn, FileHandle,
};
use App\Models\{
    GenaralSetting,File, Post, Category, Tag
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
        $logo = getSetting('site_logo');
        $menu_items = json_decode(getSetting('nav_menu'));
        $posts = Post::select(['id', 'title', 'slug'])->limit(10)->get();
        $categories = Category::select(['id', 'name', 'slug'])->limit(10)->get();
        $tags = Tag::select(['id', 'name', 'slug'])->limit(10)->get();
        // return $posts;
        return view('backend.pages.genaralsetting.index', compact('siteInfo', 'logo', 'menu_items', 'posts', 'categories', 'tags'));
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


    /**
     * @param menu_names
     * @param menu_links
     * @return redirect back with update status
     * 
     * */
    public function menuBuilder(Request $request)
    {
        $menu_names = $request->menu_names;
        $menu_links = $request->menu_links;
        $ordering = $request->ordering;

        //$data = array_combine($menu_names, $menu_links[$ordering],);

        $result = array();

        foreach ($menu_names as $key => $value) {
            $result[$key]   = [
                'menu_name' => $value,
                'menu_link' => $menu_links[$key],
                'ordering'  => $ordering[$key],
            ];
        }
        $this->addOrUpdate('nav_menu', json_encode($result));
        return $this->returnBack();
    }
}