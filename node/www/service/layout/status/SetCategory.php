<?php
session_start();
if(isset($_POST['number'])){
	if($_POST['number']=='all'){
		unset($_SESSION['cur_number3']);
	}else{
		$_SESSION['cur_number3']=$_POST['number'];
	}
	echo json_encode(array('status'=>'1'));
	return false;
}
 
?>