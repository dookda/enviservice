<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();
$id=$main->setval('category_id');
$name=$main->setval('name');
$description=$main->setval('note');

if($id!=''&&$name!=''){


				$sql="UPDATE `env_category` SET `category_name` = '".$name."', `category_description` = '".$description."' WHERE `id` = ".$id;
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