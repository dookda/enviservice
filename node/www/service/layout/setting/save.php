<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');
include('../../function/manage_file_dir.php');
$main= new main();

$web_name=$main->setval('web_name');
$web_address=$main->setval('web_address');
$url=$main->setval('url');
$mail=$main->setval('mail');


	$catname='logo';

	$dir=array(); /* Check Dir */
	$file_path='../../images/'.$catname.'/';
	$dir[]=$file_path;
	$dir[]=$file_path.'thumb/';
	$main->CheckDirExists_Create($dir);


	$time=date("Y-m-d H:i:s");

					
/* Save Image*/	
	$new_img='';
	if(isset($_POST['imgorder'])&&isset($file_path)&&isset($catname)){

		if(isset($_FILES['file'])){$newimg=$_FILES['file'];}else{$newimg='';}
		if(isset($_POST['old_img'])){$oldimg=$_POST['old_img'];}else{$oldimg='';}
		if(isset($_POST['del_img'])){$delimg=$_POST['del_img'];}else{$delimg='';}
		$BigimgSize=array(800,0);
		$ThumbimgSize=array(320,378);
	
		$new_img=$main->UpOldDelImg($newimg,$oldimg,$delimg,$_POST['imgorder'],'oimg',$file_path,$catname,$BigimgSize,$ThumbimgSize);
	}	
	
	if(substr_count($new_img,'ชนิดไฟล์ไม่ได้รับอนุญาต')>0){
		echo json_encode(array('status'=>$new_img));
		return false;
	}



	
				
	
				$sql = "UPDATE `env_data` SET `logo` = '".quote($new_img)."',`web_address` = '".quote($web_address)."', `web_name` = '".quote($web_name)."', `email_setting` = '".quote(json_encode($mail))."', `url` = '".quote($url)."', `modified` = '".date('Y/m/d')."' WHERE `id` ='1'";
				$result=mysqli_query($ConnectDB,$sql);			

				if(!$result){
					echo json_encode(array('status'=>'Error '.mysqli_error($ConnectDB)));
					return false;
				}else{
					echo json_encode(array('status'=>'OK')); 
				}

	
	
?>