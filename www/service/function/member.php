<?php

function GetStatus_block_member($id,$status){
	switch($id){
		case '0':
			return '<button type="button" class="btn btn-default btn-xs status0" style=" border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; " data-id="'.$status.'"><i class="fa fa-check"></i></button>';	
			break;
		default:
			return '<button type="button" class="btn btn-default btn-xs status1" style=" border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; " data-id="'.$status.'"><i class="fa fa-times"></i></button>';	
	}
}
function getRandomKey($length = 256)
	{
		// Initialise variables.
		$key = '';
		$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$saltLength = strlen($salt);

		// Build the random key.
		for ($i = 0; $i < $length; $i++)
		{
			$key .= $salt[mt_rand(0, $saltLength - 1)];
		}

		return $key;
	}
function create_pass($pass){
	$random=getRandomKey(32);
	return md5($pass.$random).':'.$random; /* Create Pass */	
}
function GetUserDetail($id){
	global $ConnectDB;
	
	$sql='SELECT * FROM `alumni` WHERE `user_id`="'.$id.'"';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{

			return $data;

		}

	}
}
function CheckUser_Email($user, $email){
	global $ConnectDB;
	
	$sql='SELECT `user`,`email` FROM `users` WHERE `user` LIKE "'.quote($user).'" or `email` LIKE "'.quote($email).'"';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			if($user==$data['user']){
				$userdata=$data['user'];
			}else{
				$userdata='';
			}
			if($email==$data['email']){
				$emaildata=$data['email'];
			}else{
				$emaildata='';
			}

		}
		return json_encode(array('user'=>$userdata,'email'=>$emaildata));
	}else{
		return json_encode(array('user'=>'','email'=>''));
	}
}

    ?>
