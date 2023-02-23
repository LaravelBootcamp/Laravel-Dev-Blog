<?php
use App\Models\GenaralSetting;


if (!function_exists('getSetting')) {
	function getSetting($key)
	{
		return GenaralSetting::where('key', $key)->first()->value;
	}
}