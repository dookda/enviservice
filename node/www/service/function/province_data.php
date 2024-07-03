<?php

function GetProvince2($active){
	global $ConnectDB;
	
	$sql='SELECT * FROM `province` ORDER BY  `PROVINCE_NAME` ASC';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
$province='
<select name="province" class="form-control chosen-select" class="province-type">
<option value="">เลือกจังหวัด</option>';
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$province.='<option value="'.$data['PROVINCE_ID'].'">'.$data['PROVINCE_NAME'].'</option>';
		}
	}
$province.='</select>';
if($active!=''){$province=str_replace('value="'.$active.'"','value="'.$active.'" selected',$province);}
return $province;
}
function GetAmphur($active,$provinceID){
	global $ConnectDB;
	$sql='SELECT * FROM `amphur` WHERE `PROVINCE_ID`='.quote($provinceID).' ORDER BY `AMPHUR_NAME` ASC';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
$amphur='
<select name="amphur" id="amphur-type" class="form-control amphur-select">
<option value="">เลือก อำเภอ/เขต</option>';
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$amphur.='<option value="'.$data['AMPHUR_ID'].'">'.$data['AMPHUR_NAME'].'</option>';
		}
	}
$amphur.='</select>';
if($active!=''){$amphur=str_replace('value="'.$active.'"','value="'.$active.'" selected',$amphur);}
return $amphur;
}
function GetDistrict($active,$AmphurID){
	global $ConnectDB;
	
	$sql='SELECT * FROM `district` WHERE `AMPHUR_ID`='.quote($AmphurID).' ORDER BY `DISTRICT_NAME` ASC';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
$district='
<select name="district" id="district-type" class="form-control district-select">
<option value="">เลือก ตำบล/แขวง</option>';
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$district.='<option value="'.$data['DISTRICT_ID'].'">'.$data['DISTRICT_NAME'].'</option>';
		}
	}
$district.='</select>';
if($active!=''){$district=str_replace('value="'.$active.'"','value="'.$active.'" selected',$district);}
return $district;
}


    ?>
