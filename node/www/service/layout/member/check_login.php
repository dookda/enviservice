<?php 

session_start();
define('_PRIVATE_INCLUDE','loaded');

include('../../config.php');

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$time=date("Y-m-d H:i:s");
if(isset($_POST['User'])&&isset($_POST['Pass'])){$u=$_POST['User']; $p=$_POST['Pass'];}

	if(isset($u)){$user=quote($u);}else{$user="";}
	if(isset($p)){$pass=$p;}else{$pass="";}
	
	if($user!=""&&$pass!=""){

		$sql="SELECT * FROM `env_users` a LEFT JOIN `env_user_type` b ON a.`id` = b.`id`  WHERE a.`user`='".$user."' AND a.`block`='0'  LIMIT 0 , 1";
		$result=mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
		if($nums!=0){
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
							$dbpassword=$data['pass'];
				list( $key, $salt ) = explode( ':', $dbpassword, 2 );	
				$c_pass=md5($pass.$salt).':'.$salt;
				if($c_pass==$data['pass']){
					$_SESSION["id"]=$data['id'];
					$_SESSION["userid"]=$data['id'];
					$_SESSION["usertype"]=$data['type'];
					$_SESSION["user_name"]=$data['fname'];
					if($data['type']=='2'){
						$_SESSION["perm"]=$data['perm_input'];
					}

						$sql="UPDATE `env_users` SET `lastvisitDate` = '".$time."',`ip`='".get_client_ip()."' WHERE `id` = ".$data['id'];
						mysqli_query($ConnectDB,$sql);
					
					echo json_encode(array('status'=>'1','type'=>$_SESSION["usertype"]));
				}else{
					echo json_encode(array('status'=>'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง'));
				}
				
			}
			
		}else{
		
				echo json_encode(array('status'=>'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง'));
		}
	
		
		
	}


?>
