<?php
use Illuminate\Support\Str;
use App\Models\{
	GenaralSetting, User,
};

if (!function_exists('getSetting')) {
	function getSetting($key)
	{
		return GenaralSetting::where('key', $key)->first()->value;
	}
}

if (!function_exists('makePostExcept')) {
	function makePostExcept($data, $limit = 15, $more = '...')
	{ 
		$fData =  preg_replace('/<img[^>]+>/i', '', $data); 
		return Str::words($fData , $limit, $more);	 
	}
}

if (!function_exists('getAuthor')) {
	function getAuthor($id = 1)
	{
		return User::find($id);
	}
}