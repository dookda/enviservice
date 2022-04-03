<?php
$mydatabase="cp897163_envirservi_web";
date_default_timezone_set('Asia/Bangkok');
$ConnectDB = mysqli_connect("localhost","cp897163_mysql","z@Envirservice",$mydatabase) ;
function quote($post){
	return mysqli_real_escape_string($GLOBALS['ConnectDB'],$post);
}
mysqli_query($ConnectDB,"SET NAMES UTF8");

function GetConfig(){
	global $ConnectDB;
$sql='SELECT * FROM `env_data` WHERE `id`="1" LIMIT 0 , 1';
$result=mysqli_query($ConnectDB,$sql);

$nums = mysqli_num_rows($result);
	if($nums!=0){
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
				$logo=$data['logo'];
				$web_name=$data['web_name'];
				$email_setting=$data['email_setting'];
				$url=$data['url'];
				$m=json_decode($email_setting);

	
				return json_encode(array('logo'=>$logo,'web_name'=>$web_name ,'email'=>json_decode($email_setting),'sender_email'=>$m[2],'url'=>$url));
			}
	}
}
?>