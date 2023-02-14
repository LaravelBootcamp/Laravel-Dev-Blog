<?php 
namespace App\Supports\Utilitis;


trait EasyReturn{
	public function returnBack($message = "Successfull"){
		return redirect()->back()->with('status', $message);
	}
} 