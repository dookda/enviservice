<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/member.php');

$mlist='';
if(isset($_POST['m_list'])){$mlist=$_POST['m_list'];}

	$user_active_key='1';

date_default_timezone_set("Asia/Bangkok");
$time=date("Y-m-d H:i:s");
$usernametxt='';
$emailtxt='';

if(isset($_POST['User'])&&isset($_POST['Email'])){
	
		$sql="SELECT * FROM `env_users` WHERE `user`='".quote($_POST['User'])."' OR `email`='".quote($_POST['Email'])."' ORDER BY  `user` DESC LIMIT 0 , 1";
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
				if(isset($_POST['Pass'])&&$_POST['confirm_Pass']!=$_POST['Pass']){
					echo json_encode(array('status'=>'2'));
					return false;
				}
				
				if(isset($_POST['Pass'])&&strlen($_POST['Pass'])<4){
					echo json_encode(array('status'=>'5'));
					return false;
				}
				if($_POST['Email']==$emailtxt){ echo json_encode(array('status'=>'3')); return false;}
				
				$pass_creat=create_pass($_POST['Pass']);
	
				$sql = "INSERT INTO `env_users` (`id`, `fname`, `user`, `email`, `pass`, `registerDate`, `activation` , `perm_input`) VALUES (NULL, '".quote($_POST['name'])."', '".quote($_POST['User'])."', '".quote($_POST['Email'])."', '".$pass_creat."', '".$time."','".$user_active_key."', '".quote(json_encode($_POST['m_list']))."');";
				$result=mysqli_query($ConnectDB,$sql);
				if(!$result){
					echo json_encode(array('status'=>'การบันทุกข้อมูลสมาชิกมีข้อผิดพลาด (1) '.mysqli_error($ConnectDB)));
					return false;
				}
				$last_id=mysqli_insert_id($ConnectDB);
				$sql = "INSERT INTO `env_user_type` (`id`, `type`) VALUES ('".$last_id."', '2');";
				$result=mysqli_query($ConnectDB,$sql);
				if(!$result){
					echo json_encode(array('status'=>'การบันทุกข้อมูลสมาชิกมีข้อผิดพลาด (2) '.mysqli_error($ConnectDB)));
					return false;
				}
		
				echo json_encode(array('status'=>'1'));
	

	}
?>
	
<?php mysqli_close($ConnectDB); ?>