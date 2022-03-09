<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();
$id=$main->setval('customer_id');
$name=$main->setval('name');
$tel=$main->setval('tel');
$email=$main->setval('email');

	if($id!=''&&$name!=''&&$tel!=''){
		if($main->check_email($email,$id)!=0){
			echo json_encode(array('status'=>'มีอีเมล '.$email.' อยู่ในระบบแล้ว'));
			return false;	
		}



				$sql="UPDATE `env_customer` SET `name` = '".$name."', `tel` = '".$tel."', `email` = '".$email."', `lasteditDate` = '".date('Y/m/d H:i:s')."', `user_edit_id` = '".$_SESSION['userid']."' WHERE `id` = ".$id;
				$result=mysqli_query($ConnectDB,$sql);
				
				
				if(!$result){
					echo json_encode(array('status'=>mysqli_error($ConnectDB)));
					return false;
				}else{
					
				
				echo json_encode(array('status'=>'OK'));

				}
}else{
	echo json_encode(array('status'=>'กรุณากรอกข้อมูลให้ครบถ้วน')); 	
}
	
?>