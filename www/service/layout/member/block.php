<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');


$time=date("Y-m-d H:i:s");

if(isset($_POST['id'])&&isset($_POST['mode'])){
	
switch($_POST['mode']){
	case'block':
		$sql="UPDATE `env_users` SET `block` = '1' WHERE `id` =".$_POST['id'];
		$result=mysqli_query($ConnectDB,$sql);
		break;
	case'blockall':
		foreach($_POST['id'] as $id){
			if($id=='1'){return false;}
			$sql="UPDATE `env_users` SET `block` = '1' WHERE `id` =".$id;
			$result=mysqli_query($ConnectDB,$sql);

		}
		break;
	case'unblock':
		$sql="UPDATE `env_users` SET `block` = '0' WHERE `id` =".$_POST['id'];
		$result=mysqli_query($ConnectDB,$sql);

		break;
	case'unblockall':
		foreach($_POST['id'] as $id){
			if($id=='1'){return false;}
			$sql="UPDATE `env_users` SET `block` = '0' WHERE `id` =".$id;
			$result=mysqli_query($ConnectDB,$sql);
		}
		break;
}

	if($result){ echo json_encode(array('status'=>'1')); }else{ echo json_encode(array('status'=>mysqli_error($ConnectDB))); }
}else{
	echo json_encode(array('status'=>'ID ไม่ถูกต้อง'));	
}
?>
<?php mysqli_close($ConnectDB); ?>