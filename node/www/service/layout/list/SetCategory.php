<?php
session_start();
if(isset($_POST['cat'])){
	if($_POST['cat']=='all'){
		unset($_SESSION['cur_cat2']);
	}else{
		$_SESSION['cur_cat2']=$_POST['cat'];
	}
	echo json_encode(array('status'=>'1'));
	return false;
}
if(isset($_POST['calendar_start'])&&isset($_POST['calendar_end'])){

		$_SESSION['calendar_start2']=$_POST['calendar_start'];
		$_SESSION['calendar_end2']=$_POST['calendar_end'];
	
	echo json_encode(array('status'=>'1'));
	return false;
}
if(isset($_POST['calendar_clear'])){

		unset($_SESSION['calendar_start2']);
		unset($_SESSION['calendar_end2']);
	
	echo json_encode(array('status'=>'1'));
	return false;
}
if(isset($_POST['status'])){
	if($_POST['status']=='all'){
		unset($_SESSION['cur_status2']);
	}else{
		$_SESSION['cur_status2']=$_POST['status'];
	}
	echo json_encode(array('status'=>'1'));
	return false;
}
if(isset($_POST['number'])){
	if($_POST['number']=='all'){
		unset($_SESSION['cur_number2']);
	}else{
		$_SESSION['cur_number2']=$_POST['number'];
	}
	echo json_encode(array('status'=>'1'));
	return false;
}
 
?>