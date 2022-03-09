<?php
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');

 if(isset($_POST['st-del'])&&$_POST['st-del']!=''){
	
		foreach($_POST['st-del'] as $stdel){
			
			$sql="DELETE FROM `env_category` WHERE `id` = '".$stdel."' LIMIT 1";
			$result=mysqli_query($ConnectDB,$sql);
		}
			if(!$result){
				echo json_encode(array('status'=>mysqli_error($ConnectDB))); 
				return false;
			}else{
				
		

				echo json_encode(array('status'=>'1'));
			}

	}else{
		echo json_encode(array('status'=>'0'));	
	}

 
?>