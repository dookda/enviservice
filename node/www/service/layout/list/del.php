<?php
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');

 if(isset($_POST['st-del'])&&$_POST['st-del']!=''){
	
		foreach($_POST['st-del'] as $stdel){
			$sql="DELETE FROM `env_list` WHERE `id` = '".$stdel."' LIMIT 1";
			$result=mysqli_query($ConnectDB,$sql);
		}
			if(!$result){
				echo json_encode(array('status'=>mysqli_error($ConnectDB))); 
				return false;
			}else{
				if(isset($_POST['st-del-image'])){
					foreach($_POST['st-del-image'] as $i=>$img_file){
						$img1=json_decode($img_file); 
							if(gettype($img1)=='object'){ 
								foreach($img1->img as $index=>$images){
								$file_del_1='../../'.str_replace('|','',$images);
								$file_del_2='../../'.str_replace('|','thumb/',$images);				
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

			}
		

		echo json_encode(array('status'=>'1'));

	}else{
		echo json_encode(array('status'=>'0'));	
	}

 
?>