<?php

function GetProvince_txt($PROVINCE_ID){
	global $ConnectDB;
	if(!is_numeric ($PROVINCE_ID)){ return '-';}
	$sql='SELECT * FROM `province` WHERE `PROVINCE_ID` = "'.$PROVINCE_ID.'" ORDER BY  `PROVINCE_NAME` ASC LIMIT 0,1';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);

	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
	
				return $data['PROVINCE_NAME'];
			
		}
	}



}
function GetAmphur_txt($AMPHUR_ID){
	global $ConnectDB;
	if(!is_numeric ($AMPHUR_ID)){ return '-';}
	$sql='SELECT * FROM `amphur` WHERE `AMPHUR_ID`='.quote($AMPHUR_ID).' ORDER BY `AMPHUR_NAME` ASC LIMIT 0,1';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);

	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{

		
				return $data['AMPHUR_NAME'];

		}
	}



}
function GetDistrict_txt($DISTRICT_ID){
	global $ConnectDB;
	
	if(!is_numeric ($DISTRICT_ID)){ return '-';}
	$sql='SELECT * FROM `district` WHERE `DISTRICT_ID`='.quote($DISTRICT_ID).' ORDER BY `DISTRICT_NAME` ASC LIMIT 0,1';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);

	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			
				return $data['DISTRICT_NAME'];
			
			
		}
	}


}


    ?>
