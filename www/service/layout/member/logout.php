<?php 
session_start();
					unset($_SESSION["id"]);
					unset($_SESSION["userid"]);
					unset($_SESSION["usertype"]);	
					unset($_SESSION["user_name"]);
					unset($_SESSION["img"]);
					if(isset($_SESSION["perm"])){
					unset($_SESSION["perm"]);
					}
echo json_encode(array('status'=>'1'));
?>
