<?php
session_start();
if(isset($_POST['cat'])){
	if($_POST['cat']=='all'){
		unset($_SESSION['cur_member_status']);
	}else{
		$_SESSION['cur_member_status']=$_POST['cat'];
	}
	echo json_encode(array('status'=>'1'));
}
if(isset($_POST['number'])){
	if($_POST['number']=='all'){
		unset($_SESSION['cur_number7']);
	}else{
		$_SESSION['cur_number7']=$_POST['number'];
	}
	echo json_encode(array('status'=>'1'));
}
 
?>