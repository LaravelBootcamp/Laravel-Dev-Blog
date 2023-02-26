<?php
use Illuminate\Support\Str;
use App\Models\{
	GenaralSetting, User,
};

if (!function_exists('getSetting')) {
	function getSetting($key)
	{
		$data = GenaralSetting::where('key', $key)->first();
		if ($data) {
			return $data->value;
		}
		else{
			return null;
		}
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
		$user =  User::find($id);
		if ($user) {
			return $user;
		}
		return null;
	}
}


if (!function_exists('makeArchiveUrl')) {
	function makeArchiveUrl($slug, $slugPrefix)
	{
		return route('home').'/'.$slugPrefix.'/'.$slug;
	}
}