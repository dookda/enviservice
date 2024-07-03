<?php
function GetNewsType(){
	global $ConnectDB;
$sql='SELECT * FROM `news_type`';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
$name=array();
$id=array();
	if($nums!=0){
		
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
	
			
				$name[]=array($data['id'] => $data['type_name']);
			}
			return $name;
	}
}
function GetActivityType(){
	global $ConnectDB;
$sql='SELECT * FROM `activity_type`';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
$name=array();
	if($nums!=0){
		
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
	
				$name[]=array($data['id'] => $data['type_name']);
			}
			return $name;
	}
}



    ?>
