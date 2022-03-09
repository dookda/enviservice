<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');



$main= new main();

$name=$main->setval('name');
$description=$main->setval('note');
$code=$main->setval('code');
$default=$main->setval('default');
$status_begin=0;
if($name!=''&&$code!=''){
	if($default=='on'){
		$sql="UPDATE `env_status` SET `status_begin` = '0' WHERE `status_begin` = 1";
		mysqli_query($ConnectDB,$sql);
		$status_begin=1;
	}

				$sql="SELECT `id` FROM `env_status` WHERE `status_code` LIKE '".strtoupper($code)."' ";
				$result=mysqli_query($ConnectDB,$sql);
				$nums = mysqli_num_rows($result);
					if($nums>0){
						echo json_encode(array('status'=>'รหัส '.strtoupper($code).' มีอยู่ในระบบแล้ว'));
						return false;
					}

				$sql="INSERT INTO `env_status` (`id`, `status_name`, `status_description`, `status_code`, `status_begin`) VALUES (NULL, '".$name."', '".$description."', '".strtoupper($code)."', '".$status_begin."')";
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