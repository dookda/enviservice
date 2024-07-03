<?php
include('../../config.php');
include('../../function/main.php');


$main= new main();
$keyword=$main->setval('keyword');
	if($keyword!=''){
        $sql='SELECT * FROM `env_customer` WHERE `name` LIKE "%'.quote($keyword).'%" LIMIT 0,10';
        $result=mysqli_query($ConnectDB,$sql);
        $nums = mysqli_num_rows($result);
		$name='';
        if($nums!=0){
            while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{	
				$name.='<div style=" border-bottom: 1px solid #e6e6e6; padding: 5px; position: relative;"><a href="javascript:;" data-email="'.$data['email'].'" data-tel="'.$data['tel'].'" data-name="'.$data['name'].'" onclick="$(this).select_customer(\''.$data['id'].'\')">'.$data['name'].'</a><small class="label pull-right bg-red" data-email="'.$data['email'].'" data-tel="'.$data['tel'].'" data-name="'.$data['name'].'" style=" cursor: pointer;     padding: 6px 8px 4px; " onclick="$(this).select_customer(\''.$data['id'].'\')">เลือก</small></div>';
			}
			echo json_encode(array('name'=>$name)); 
		}else{
			echo json_encode(array('name'=>'')); 	
		}
	}else{
		echo json_encode(array('name'=>'')); 	
	}

?>