<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
include('../../config.php');
include('../../function/main.php');
include('../../plugins/PHPMailer-master/PHPMailerAutoload.php');
include('../../function/mail.php');
include('../../function/mail_template.php');


$main= new main();
$category=$main->setval('category');
$status=$main->setval('status');
$oldstatus=$main->setval('oldstatus');
$title=$main->setval('title');
$list_id=$main->setval('list_id');
$sendmail=$main->setval('sendmail');
$date=$main->setval('date');

	

$list=json_encode($main->setval('list'), JSON_UNESCAPED_UNICODE);
$note=$main->setval('note');
$customer_id=$main->setval('customer_id');
$time=date("Y-m-d H:i:s");


if($title!=''&&$list_id!=''&&$list!='[""]'&&$category!=''&&$status!=''){

	$catname='service';

	$dir=array(); /* Check Dir */
	$file_path='../../images/'.$catname.'/';
	$dir[]=$file_path;
	$dir[]=$file_path.'thumb/';
	$main->CheckDirExists_Create($dir);


	$time=date("Y-m-d H:i:s");

					
/* Save Image*/	
	$new_img='';
	if(isset($_POST['imgorder'])&&isset($file_path)&&isset($catname)||isset($file_path)&&isset($catname)){

		if(isset($_FILES['file'])){$newimg=$_FILES['file'];}else{$newimg='';}
		if(isset($_POST['old_img'])){$oldimg=$_POST['old_img'];}else{$oldimg='';}
		if(isset($_POST['del_img'])){$delimg=$_POST['del_img'];}else{$delimg='';}
		
		$BigimgSize=array(800,0);
		$ThumbimgSize=array(378,378);
		
		if(isset($_POST['imgorder'])){$order_img=$_POST['imgorder'];}else{$order_img='';}

		$new_img=$main->UpOldDelImg($newimg,$oldimg,$delimg,$order_img,'oimg',$file_path,$catname,$BigimgSize,$ThumbimgSize);
	}	
	

	if(substr_count($new_img,'ชนิดไฟล์ไม่ได้รับอนุญาต')>0){
		echo json_encode(array('status'=>$new_img));
		return false;
	}


$statusDate="";
if($status!=$oldstatus){
		$statusDate=", `statusDate` = '".date('Y-m-d H:i:s')."'";
		$date=date('Y-m-d H:i:s');
}
				
				mysqli_autocommit($ConnectDB,FALSE);
				
				$sql = "UPDATE `env_list` SET `list_title` = '".quote($title)."', `list_text` = '".quote($list)."', `list_category` = '".quote($category)."', `list_status` = '".quote($status)."', `images` = '".quote($new_img)."', `note` = '".quote($note)."', `editDate` = '".date('Y-m-d H:i:s')."'".$statusDate.", `user_edit_id` = '".$_SESSION['userid']."' WHERE `env_list`.`id` = ".$list_id;
				$result=mysqli_query($ConnectDB,$sql);
				
				
				if(!$result){
					echo json_encode(array('status'=>mysqli_error($ConnectDB)));
					return false;
				}else{
					mysqli_commit($ConnectDB);	
			
if($sendmail=='on'){
					$mail_data=$main->GetConfig();
					
					$mail=json_decode($mail_data['email_setting']);
		
		
				
				$status_name='';
				$sql = "SELECT * FROM `env_status` WHERE `status_code` LIKE '".$status."'";
				$result=mysqli_query($ConnectDB,$sql);
				$nums = mysqli_num_rows($result);	
				if($nums!=0){
					while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
						$status_name=$data['status_name'];
					
					}
				}
				
				$category_name='';
				$sql = "SELECT * FROM `env_category` WHERE `id` = ".$category;
				$result=mysqli_query($ConnectDB,$sql);
				$nums = mysqli_num_rows($result);	
				if($nums!=0){
					while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
						$category_name=$data['category_name'];
					
					}
				}
				
					$email='';
					$sql='SELECT name,email FROM `env_customer` WHERE `id` = '.$customer_id;
					$result=mysqli_query($ConnectDB,$sql);
					$nums = mysqli_num_rows($result);	
					if($nums!=0){
						while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
							$email=$data['email'];
							$name=$data['name'];
						}
					}
				
						$message='
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style=" margin: 10px 0; ">
							<tbody>
								<tr>
									<td width="100"><small>No.</small><br/><b>'. str_pad($list_id,4,'0',STR_PAD_LEFT).'</b></td>
									<td><h3 style=" text-align: center; text-transform: uppercase; color: #119143;">Service Report</h3></td>
									<td width="100" align="right"><small>วันที่</small><br/><b>'.date("d/m/Y",strtotime($date)).'</b></td>
								</tr>
							</tbody>
						</table>';
						
						$message.='
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style=" margin: 10px 0; ">
							<tbody>
								<tr>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>นามลูกค้า</small><br/><b>'.$name.'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>รหัสลูกค้า</small><br/><b>'.str_pad($customer_id,4,'0',STR_PAD_LEFT).'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>ประเภท</small><br/><b>'.$category_name.'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; padding: 5px;"><small>สถานะ</small><br/><b>'.$status_name.'</b></td>
								</tr>
							</tbody>
						</table>';
						
						$message.='
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr style=" background: #e0e0e0; ">
									<td width="60" style=" padding: 5px; border: 1px solid #ddd; text-align:center ">ลำดับ</td>
									<td style=" padding: 5px; border: 1px solid #ddd;">รายการ</td>
								</tr>';
						foreach($_POST['list'] as $index=>$listdata){
							if($listdata!=''){
						$message.='<tr>
									<td width="60" style=" padding: 5px; border: 1px solid #ddd; text-align:center; border-top: 0; ">'.$index.'</td>
									<td style=" padding: 5px; border: 1px solid #ddd; border-left: 0; border-top: 0; ">'.$listdata.'</td>
								</tr>';
							}
						}
						$message.='</tbody>
						</table>';
						
						$message.='<table width="100%" cellspacing="0" cellpadding="0" border="0" style=" margin: 10px 0; ">
													<tbody>
														<tr><td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>ติดตามข่าวสาร</small><br><a href="http://www.envirservice.co.th/" target="_blank" style="color: #000000; text-decoration: none;">http://www.envirservice.co.th</a></td>
															<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>ติดตามสถานะ</small><br><a href="http://www.envirservice.co.th/track" target="_blank" style="color: #000000; text-decoration: none;">http://www.envirservice.co.th/track/</a></td>
								</tr>
							</tbody>
						</table>';
						
						if(trim($note)!=''){
						$message.='<h4 style=" margin: 5px 0 0; color: red; ">หมายเหตุ</h4>';
						$message.='<div>'.$note.'</div>';
						}
						/*$message.='<div>ตรวจสอบสถานะ: </div>';*/
						
						
						$logo='<img src="'.$mail_data['url'].'/images/logo/logo_iDF152019377577.png" style=" margin-top: 10px; ">';
						$address='<div>'.nl2br($mail_data['web_address']).'</div>';
				
						
					
						if($email!=''){
							$mail=SMTP_Mail('Service Report '.str_pad($list_id,4,'0',STR_PAD_LEFT).' (อัพเดท)',template1($message,$logo,$address),$email,$mail[2]);
							if($mail!='1'){
							echo json_encode(array('status'=>$mail));
							return false;
							}
						}
}

			
			echo json_encode(array('status'=>'OK'));

				}
}else{
	echo json_encode(array('status'=>'กรุณากรอกข้อมูลให้ครบถ้วน')); 	
}
	
?>