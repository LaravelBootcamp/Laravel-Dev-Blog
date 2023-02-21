<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GenaralSetting;
use App\Supports\Database\GenaralSettingHelpers;
use App\Supports\Utilitis\EasyReturn;

class GenaralSettingController extends Controller
{
    use GenaralSettingHelpers, EasyReturn;


    public function index(Request $request)
    {
        return view('backend.pages.genaralsetting.index');
    }

    public function siteSettingUpdate(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $this->addOrUpdate($key, $value);
        }
        return $this->returnBack();
    }

}
