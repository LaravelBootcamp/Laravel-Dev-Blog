<?php


function makeOptionForPostEditTag($allTag, $postTag)
{
	//return $allTag['id'];
	return array_intersect_assoc($allTag['id'], $postTag['id']);
	if ($allTag['id'] == $postTag['id']) {
		return "<option selected>".$allTag['name']."</option>";
	}else{
		return "<option>".$allTag['name']."</option>";
	}


	if(isset($postTag['id']) ) {

		if ($allTag['id'] == $postTag['id']) {
			return "<option selected>".$allTag['name']."</option>";
		}else{
			return "<option>".$allTag['name']."</option>";
		}
	}else{
		return "<option>".$allTag['name']."</option>";
	}
}