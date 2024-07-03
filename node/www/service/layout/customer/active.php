<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();

$id=$main->setval('id');

if($id!=''){
	
		$sql="UPDATE `env_status` SET `status_begin` = '0' WHERE `status_begin` = 1";
		mysqli_query($ConnectDB,$sql);
		$sql="UPDATE `env_status` SET `status_begin` = '1' WHERE `id` = ".$id;
		$result=mysqli_query($ConnectDB,$sql);
	
				if(!$result){
					echo json_encode(array('status'=>mysqli_error($ConnectDB)));
					return false;
				}else{
					
				
				echo json_encode(array('status'=>'1'));

				}

}else{
	echo json_encode(array('status'=>'กรุณากรอกข้อมูลให้ครบถ้วน')); 	
}
	
?>