<?php
session_start();
define('_PRIVATE_INCLUDE','loaded');
if(isset($_SESSION["userid"])&&isset($_SESSION["usertype"])) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SERVICE REPORT</title>

  </head>
<body>

<?php
include('config.php');
include('function/mail_template.php');
include('function/main.php');
$main= new main();
$main_data=$main->GetConfig();
  $web_address=$main_data['web_address'];
$where="WHERE `env_list`.`id` = '".quote($_GET['id'])."' ";
$sql='SELECT `env_list`.*,
`env_customer`.*,
`env_customer`.`id` as `cusid`,
`env_status`.*, 
`env_category`.*, 
`env_category`.`id` as catid 
FROM `env_list` 
LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id` 
LEFT JOIN `env_status` ON  `env_list`.`list_status` = `env_status`.`status_code` 
LEFT JOIN `env_category` ON  `env_list`.`list_category` = `env_category`.`id`
'.$where.'ORDER BY  `env_list`.`id` DESC LIMIT 0,1';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>

<?php


					
		if($data['statusDate']!='0000-00-00 00:00:00'){
			$data['addDate']	=$data['statusDate'];
		}
				
						$message='
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style=" margin: 10px 0; ">
							<tbody>
								<tr>
									<td width="100"><small>No.</small><br/><b>'. str_pad($_GET['id'],4,'0',STR_PAD_LEFT).'</b></td>
									<td><h3 style=" text-align: center; text-transform: uppercase; color: #119143;">Service Report</h3></td>
									<td width="100" align="right"><small>วันที่</small><br/><b>'.date("d/m/Y",strtotime($data['addDate'])).'</b></td>
								</tr>
							</tbody>
						</table>';
						
						$message.='
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style=" margin: 10px 0; ">
							<tbody>
								<tr>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>นามลูกค้า</small><br/><b>'.$data['name'].'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>รหัสลูกค้า</small><br/><b>'.str_pad($data['cusid'],4,'0',STR_PAD_LEFT).'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; border-right:0; padding: 5px;"><small>ประเภท</small><br/><b>'.$data['category_name'].'</b></td>
									<td style="text-align:center; border: 1px solid #ddd; padding: 5px;"><small>สถานะ</small><br/><b>'.$data['status_name'].'</b></td>
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
								
						$list_arr=json_decode($data['list_text']);
						foreach($list_arr as $i=>$list){
							if($list==''){ continue; }
						$message.='<tr>
									<td width="60" style=" padding: 5px; border: 1px solid #ddd; text-align:center; border-top: 0; ">'.$i.'</td>
									<td style=" padding: 5px; border: 1px solid #ddd; border-left: 0; border-top: 0; ">'.$list.'</td>
								</tr>';
							
						}
						$message.='</tbody>
						</table>';
						
			  			if(trim($data['note'])!=''){
						$message.='<h4 style=" margin: 5px 0 0; color: red; ">หมายเหตุ</h4>';
						$message.='<div>'.nl2br($data['note']).'</div>';
	
			  			}
						
						$logo='<img src="images/logo/logo_iDF152019377577.png" style=" margin-top: 10px; ">';
						$address='<div>'.nl2br($web_address).'</div>';
				
						
					
						echo template3($message,$logo,$address);
							

		}
	}
			
		
	
?>
<script>

   /* window.print();*/

</script>
</body>
</html>
<?php }else{
	die("เฉพาะผู้ดูแลระบบเท่านั้น");	
}?>