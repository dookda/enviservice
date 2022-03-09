<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();
$id=$main->setval('status_id');
$name=$main->setval('name');
$description=$main->setval('note');
$code=$main->setval('code');
$default=$main->setval('default');
if($id!=''&&$name!=''&&$code!=''){
	if($default=='on'){
		$sql="UPDATE `env_status` SET `status_begin` = '0' WHERE `status_begin` = 1";
		mysqli_query($ConnectDB,$sql);
		$sql="UPDATE `env_status` SET `status_begin` = '1' WHERE `id` = ".$id;
		mysqli_query($ConnectDB,$sql);
	}

				$sql="SELECT `id` FROM `env_status` WHERE `status_code` LIKE '".strtoupper($code)."' AND `id`!= ".$id;
				$result=mysqli_query($ConnectDB,$sql);
				$nums = mysqli_num_rows($result);
					if($nums>0){
						echo json_encode(array('status'=>'รหัส '.strtoupper($code).' มีอยู่ในระบบแล้ว'));
						return false;
					}

				$sql="UPDATE `env_status` SET `status_name` = '".$name."', `status_description` = '".$description."', `status_code` = '".strtoupper($code)."' WHERE `id` = ".$id;
				$result=mysqli_query($ConnectDB,$sql);
				
				
				if(!$result){
					echo json_encode(array('status'=>mysqli_error($ConnectDB)));
					return false;
				}else{
					mysqli_commit($ConnectDB);	
				
				echo json_encode(array('status'=>'OK'));

				}
}else{
	echo json_encode(array('status'=>'กรุณากรอกข้อมูลให้ครบถ้วน')); 	
}
	
?>