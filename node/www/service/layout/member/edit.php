<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/member.php');

$mlist='';
if(isset($_POST['m_list'])){$mlist=$_POST['m_list'];}

$time=date("Y-m-d H:i:s");
$usernametxt='';
$emailtxt='';
		$sql="SELECT * FROM `env_users` WHERE `user`='".quote($_POST['User'])."' AND `id`!='".$_POST['id']."' OR `email`LIKE'".$_POST['Email']."' AND `id`!='".$_POST['id']."' ORDER BY  `user` DESC LIMIT 0 , 1";
		$result=mysqli_query($ConnectDB,$sql);
				if(!$result){
					echo json_encode(array('status'=>mysqli_error($ConnectDB)));	
					return false;
				}
		$nums = mysqli_num_rows($result);
		if($nums!=0){
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
				
				$usernametxt=$data['user'];
				$emailtxt=$data['email'];
				
			}
			
		}
		
				if($_POST['User']==$usernametxt){ echo json_encode(array('status'=>'4')); return false;}
 $password='';
 if(isset($_POST['Pass'])&&$_POST['Pass']!=''){
				if(isset($_POST['confirm_Pass'])&&$_POST['confirm_Pass']!=$_POST['Pass']){
					echo json_encode(array('status'=>'2'));
					return false;
				}
				
				if(strlen($_POST['Pass'])<4){
					echo json_encode(array('status'=>'5'));
					return false;
				}
				$password=",`pass` = '".create_pass($_POST['Pass'])."'";
 }
 
 if($_POST['Email']==$emailtxt){ echo json_encode(array('status'=>'3')); return false;}


	$sql="UPDATE `env_users` SET `fname` = '".quote($_POST['name'])."',`user` = '".quote($_POST['User'])."',`email` = '".quote($_POST['Email'])."',`perm_input` = '".quote(json_encode($mlist))."'".$password.", `lastResetTime` = '".$time."' WHERE `id` =".$_POST['id'];
	$result=mysqli_query($ConnectDB,$sql);

	if($result){ echo json_encode(array('status'=>'1')); }else{ echo json_encode(array('status'=>mysqli_error($ConnectDB))); }
	
?>
<?php mysqli_close($ConnectDB); ?>