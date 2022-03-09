<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();

$name=$main->setval('name');
$tel=$main->setval('tel');
$email=$main->setval('email');

	if($name!=''&&$tel!=''){
		if($main->check_email($email)!=0){
			echo json_encode(array('status'=>'มีอีเมล '.$email.' อยู่ในระบบแล้ว'));
			return false;	
		}
	

				$sql="INSERT INTO `env_customer` (`id`, `name`, `email`, `tel`, `registerDate`) VALUES (NULL, '".$name."', '".$email."', '".$tel."', '".date('Y/m/d H:i:s')."')";
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