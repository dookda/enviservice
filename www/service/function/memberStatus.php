<?php


function GetUserBlockStatus($id){
	global $ConnectDB;
	
	$sql='SELECT * FROM `users` WHERE `id`="'.$id.'" AND `block`="1"';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums==1){
		return true;
	}else{
		return false;
	}
}

    ?>
