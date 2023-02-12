<?php 
namespace App\Supports\Utilitis;


trait EasyReturn{
	public function returnBack($message){
		return redirect()->back()->with('status', $message);
	}
} 