<?php
session_start();
if(isset($_POST['number'])){
	if($_POST['number']=='all'){
		unset($_SESSION['cur_number4']);
	}else{
		$_SESSION['cur_number4']=$_POST['number'];
	}
	echo json_encode(array('status'=>'1'));
	return false;
}
 
?>