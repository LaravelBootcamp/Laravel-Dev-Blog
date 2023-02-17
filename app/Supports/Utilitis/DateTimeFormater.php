<?php 

namespace App\Supports\Utilitis;
use Carbon\Carbon;

trait DateTimeFormater
{
	/**
	 * @param $formate & $data 
	 * @return valid data based formate 
	 */
	public function getFormatedDate($date=null, $formate= 'd-M-y')
	{
		return date($formate, strtotime($date));
	}


	public function getPostedTime($data, $formate= "d-M-Y")
	{
		$currentTime = Carbon::now()->formate($formate);
		$postedTime = date($formate, strtotime($data)); 
	}
}