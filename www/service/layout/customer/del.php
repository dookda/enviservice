<?php
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');

 if(isset($_POST['st-del'])&&$_POST['st-del']!=''){
	
		foreach($_POST['st-del'] as $stdel){
			
			$sql="DELETE FROM `env_customer` WHERE `id` = '".$stdel."' LIMIT 1";
			$result=mysqli_query($ConnectDB,$sql);
			
$sql='SELECT * FROM `env_list` WHERE`customer_id`= '.$stdel.' LIMIT 0,1';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
			if($nums!=0){
				while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
					if($data['images']!=''){
							$images_arr=json_decode($data['images']);
							
							foreach($images_arr->img as $i=>$img_del){
								$file_del_1='../../'.str_replace('|','/',$img_del);
								$file_del_2='../../'.str_replace('|','thumb/',$img_del);
									if (file_exists($file_del_1)) {
										unlink($file_del_1);
									}
									if (file_exists($file_del_2)) {
										unlink($file_del_2);
									}
							}
						}
				}
			}
			$sql="DELETE FROM `env_list` WHERE `env_list`.`customer_id` = ".$stdel;
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