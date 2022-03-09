<?php
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');

 if(isset($_POST['st-del'])&&$_POST['st-del']!=''){

		foreach($_POST['st-del'] as $stdel){
			if($stdel=='1'){return false;}
			$sql="DELETE FROM `env_users` WHERE `id` = '".$stdel."'";
			$result=mysqli_query($ConnectDB,$sql);
			$sql="DELETE FROM `env_user_type` WHERE `id` = '".$stdel."'";
			$result=mysqli_query($ConnectDB,$sql);
		}
			if(!$result){
				echo json_encode(array('status'=>mysqli_error($ConnectDB))); 
				return false;
			}

		echo json_encode(array('status'=>'1'));

	}else{
		echo json_encode(array('status'=>'0'));	
	}

 
?>
<?php mysqli_close($ConnectDB); ?>