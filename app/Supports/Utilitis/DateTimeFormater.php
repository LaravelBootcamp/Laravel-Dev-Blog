<?php 

namespace App\Supports\Utilitis;

trait DateTimeFormater
{
	/**
	 * @param $formate & $data 
	 * @return valid data based formate 
	 */
	public function getFormatedData($date=null, $formate= 'd-M-y')
	{
		return date($formate, strtotime($date));
	}	
}