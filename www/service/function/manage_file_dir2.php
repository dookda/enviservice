<?php

function CheckDirExists_Create($path=array()){
	foreach($path as $dir){
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
			
		}
	}
	return true;
}
function CheckFileType($file){
	if($file=='image/jpeg'||$file=='image/pjpeg'||$file=='image/png'||$file=='image/gif'){
		return true;
	}else{
		return false;
	}
}

function UpOldDelImg($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array()){
	$img=array();	
	$alloldImg=count($oldimg);
	$oimg_count=0;

	if($orderimg!=''){
		foreach($orderimg as $i=>$data){

			if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
				$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
				$oimg_count++;
			}else{ /* New image */
			
				if($newimg!=''){
				
					$check = getimagesize($newimg["tmp_name"][$i]);
					if($check !== false) {
						if(CheckFileType($newimg['type'][$i])){
								$fname=file_rename($newimg["name"][$i],$dirname);
								$filec=move_uploaded_file($newimg["tmp_name"][$i],$file_path.$fname);
								file_resize2($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
								file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);
						}else{
									
								return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';
								
						}
					}else{ return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';	}
					$img[]='images/'.$dirname.'/|'.$fname; /* Get new image*/
				}
			}
		}
	}
	if($delimg!=''){
		foreach($delimg as $img_del){ 
			$file_del_1='../../'.str_replace('|','/',$img_del);
			$file_del_2='../../'.str_replace('|','thumb/',$img_del);
				if (file_exists($file_del_1)) {
					unlink($file_del_1);
				}
				if (file_exists($file_del_2)) {
					unlink($file_del_2);
				}
		}
	}
	return '{"img":'.json_encode($img).'}';
}

function UpOldDelLogo($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array()){
	$img=array();	
	$alloldImg=count($oldimg);
	$oimg_count=0;

	if($orderimg!=''){
		foreach($orderimg as $i=>$data){

			if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
				$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
				$oimg_count++;
			}else{ /* New image */
			
				if($newimg!=''){
				
					$check = getimagesize($newimg["tmp_name"][$i]);
					if($check !== false) {
						if(CheckFileType($newimg['type'][$i])){
								$fname=file_rename($newimg["name"][$i],$dirname);
								$filec=move_uploaded_file($newimg["tmp_name"][$i],$file_path.$fname);
								/*file_resize2($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
								file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);*/
						}else{
									
								return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';
								
						}
					}else{ return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';	}
					$img[]='images/'.$dirname.'/|'.$fname; /* Get new image*/
				}
			}
		}
	}
	if($delimg!=''){
		foreach($delimg as $img_del){ 
			$file_del_1='../../'.str_replace('|','/',$img_del);
			$file_del_2='../../'.str_replace('|','thumb/',$img_del);
				if (file_exists($file_del_1)) {
					unlink($file_del_1);
				}
				if (file_exists($file_del_2)) {
					unlink($file_del_2);
				}
		}
	}
	return '{"img":'.json_encode($img).'}';
}

function UpOldDelSlide($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array()){
	$time=date("Y-m-d H:i:s");
	$img=array();	
	$alloldImg=count($oldimg);
	$oimg_count=0;
	global $ConnectDB;

	if($orderimg!=''){
		foreach($orderimg as $i=>$data){

			if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
				$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
				$oimg_count++;
			}else{ /* New image */
			
				if($newimg!=''){
				
					$check = getimagesize($newimg["tmp_name"][$i]);
					if($check !== false) {
						if(CheckFileType($newimg['type'][$i])){
								$fname=file_rename($newimg["name"][$i],$dirname);
								$filec=move_uploaded_file($newimg["tmp_name"][$i],$file_path.$fname);
								file_resize($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
								file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);
						}else{
									
								return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';
								
						}
					}else{ return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';	}
					$img[]='images/'.$dirname.'/|'.$fname; /* Get new image*/
					$new_img='{"img":'.json_encode($img).'}';
					$sql="INSERT INTO `slide` ( `id` ,  `images` , `status`  , `startdate` ) VALUES ( NULL ,  '".quote($new_img)."', '1', '".$time."' )";
					$result=mysqli_query($ConnectDB,$sql);
					$img=array();
				}
			}
		}
	}
	if($delimg!=''){
		foreach($delimg as $img_del){ 
			$file_del_1='../../'.str_replace('|','/',$img_del);
			$file_del_2='../../'.str_replace('|','thumb/',$img_del);
				if (file_exists($file_del_1)) {
					unlink($file_del_1);
				}
				if (file_exists($file_del_2)) {
					unlink($file_del_2);
				}
		}
	}

if($result){
	return true;
}else{
	return 'NO';
}
}

function UpOldDelSlide2($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array()){
	$img=array();	
	$alloldImg=count($oldimg);
	$oimg_count=0;

	if($orderimg!=''){
		foreach($orderimg as $i=>$data){

			if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
				$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
				$oimg_count++;
			}else{ /* New image */
			
				if($newimg!=''){
				
					$check = getimagesize($newimg["tmp_name"][$i]);
					if($check !== false) {
						if(CheckFileType($newimg['type'][$i])){
								$fname=file_rename($newimg["name"][$i],$dirname);
								$filec=move_uploaded_file($newimg["tmp_name"][$i],$file_path.$fname);
								file_resize($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
								file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);
						}else{
									
								return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';
								
						}
					}else{ return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';	}
					$img[]='images/'.$dirname.'/|'.$fname; /* Get new image*/
				}
			}
		}
	}
	if($delimg!=''){
		foreach($delimg as $img_del){ 
			$file_del_1='../../'.str_replace('|','/',$img_del);
			$file_del_2='../../'.str_replace('|','thumb/',$img_del);
				if (file_exists($file_del_1)) {
					unlink($file_del_1);
				}
				if (file_exists($file_del_2)) {
					unlink($file_del_2);
				}
		}
	}
	return '{"img":'.json_encode($img).'}';
}

function UpOldDelAlbum($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array(),$album_des){
	$img=array();
	$img_des=array();	
	$alloldImg=count($oldimg);
	$oimg_count=0;

	if($orderimg!=''){
		foreach($orderimg as $i=>$data){

			if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
				$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
				$img_des[]=$album_des[$i];
				$oimg_count++;
			}else{ /* New image */
			
				if($newimg!=''){
				
					$check = getimagesize($newimg["tmp_name"][$i]);
					if($check !== false) {
						if(CheckFileType($newimg['type'][$i])){
								$fname=file_rename($newimg["name"][$i],$dirname);
								$filec=move_uploaded_file($newimg["tmp_name"][$i],$file_path.$fname);
								file_resize2($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
								file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);
						}else{
									
								return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';
								
						}
					}else{ return $newimg["name"][$i].' ชนิดไฟล์ไม่ได้รับอนุญาต';	}
					$img[]='images/'.$dirname.'/|'.$fname; /* Get new image*/
					$img_des[]=$album_des[$i];
				}
			}
		}
	}
	if($delimg!=''){
		foreach($delimg as $img_del){ 
			$file_del_1='../../'.str_replace('|','/',$img_del);
			$file_del_2='../../'.str_replace('|','thumb/',$img_del);
				if (file_exists($file_del_1)) {
					unlink($file_del_1);
				}
				if (file_exists($file_del_2)) {
					unlink($file_del_2);
				}
		}
	}
	return '{"img":'.json_encode($img).',"description":'.json_encode($img_des).'}';
}




    ?>