<?php


function thumb_img($img_name){ /* create thumbnails without thumbnails.*/
		$img1=json_decode($img_name);		
		foreach($img1->img as $i=>$images){
		$mainimg = str_replace('|','',$images);
		$thumbimg=str_replace('|','thumb/',$images);
			$pathimg=explode("|",$images);
						
			/* If thumb exit, create thumb file.*/
			if (!file_exists($pathimg[0].'thumb/')) {
				mkdir($pathimg[0].'thumb/', 0777, true);
			}
			if (!file_exists($thumbimg)) {
				file_resize(378, 378, $mainimg, $thumbimg);	
			}
		}
		return;
}


function generateRandomString($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function file_rename($file_name,$cat){
		$ser = explode(".", $file_name);
		return $imgname=$cat.'_'.generateRandomString().time().rand(1,100).'.'.$ser[1];
}
function file_resize($max_width, $max_height, $source_file, $dst_dir, $quality = 100){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];
    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;
        default:
            return false;
            break;
    } 
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);  
	imagealphablending( $dst_img, false );
	imagesavealpha( $dst_img, true );
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    if($width_new > $width){
        $h_point = (($height - $height_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    } 
    $image($dst_img, $dst_dir, $quality);
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}
function file_resize2($max_width, $max_height, $source_file, $dst_dir, $quality = 100){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
	$ratio = $width / $height;
if ($max_width == 0)
    {
        $max_width  = $width;
    }

    if ($max_height == 0)
    {
        $max_height = $height;
    }

    // Calculate ratio of desired maximum sizes and original sizes.
    $widthRatio = $max_width / $width;
    $heightRatio = $max_height / $height;

    // Ratio used for calculating new image dimensions.
    $ratio = min($widthRatio, $heightRatio);

    // Calculate new image dimensions.
    $max_width  = (int)$width  * $ratio;
    $max_height = (int)$height * $ratio;
    $mime = $imgsize['mime'];
    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;
        default:
            return false;
            break;
    } 
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);  
	imagealphablending( $dst_img, false );
	imagesavealpha( $dst_img, true );
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    if($width_new > $width){
        $h_point = (($height - $height_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    } 
    $image($dst_img, $dst_dir, $quality);
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}

function UpdateHits($id,$hits){
	$hits=$hits+(1);
	global $ConnectDB;	
	$sql="UPDATE `baan_item` SET  `hits` =  '".$hits."' WHERE  `id` =".$id;
	$result=mysqli_query($ConnectDB,$sql);

}

function GetStatus($id,$status){
	switch($id){
		case '1':
			return '<button type="button" class="btn btn-default btn-xs status1" data-id="'.$status.'"><i class="fa fa-check"></i></button>';	
			break;
		default:
			return '<button type="button" class="btn btn-default btn-xs status0" data-id="'.$status.'"><i class="fa fa-times"></i></button>';	
	}
}
function GetStatus_block($id,$status){
	switch($id){
		case '0':
			return '<button type="button" class="btn btn-default btn-xs status0" data-id="'.$status.'"><i class="fa fa-check"></i></button>';	
			break;
		default:
			return '<button type="button" class="btn btn-default btn-xs status1" data-id="'.$status.'"><i class="fa fa-times"></i></button>';	
	}
}


	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
	function DateThai2($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

    ?>
