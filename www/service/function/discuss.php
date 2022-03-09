<?php
function setval($val){
	if(isset($_POST[$val])){ return $_POST[$val]; }else{ return '';}
}
function check_radio($val,$cur){

	if($val==$cur){
		return ' checked="checked" ';
	}else{
		return '';	
	}
	
}
function get_img_profule($user_id){
	global $ConnectDB;
		$sql="SELECT a.`fname`, a.`lname`, c.`picture` FROM `users` a, `user_type` b, `alumni` c WHERE a.`id`='".$user_id."' AND a.`id` = b.`id` AND c.`user_id` = a.`id` LIMIT 0 , 1";
		$result=mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
		if($nums==0){
			$sql="SELECT a.`fname`, a.`lname`, c.`picture` FROM `users` a, `user_type` b, `admin` c WHERE a.`id`='".$user_id."' AND a.`id` = b.`id` AND c.`user_id` = a.`id` LIMIT 0 , 1";
			$result=mysqli_query($ConnectDB,$sql);
			$nums = mysqli_num_rows($result);	
		}
		if($nums==0){
			$sql="SELECT a.`fname`, a.`lname`, c.`picture` FROM `users` a, `user_type` b, `personnel` c WHERE a.`id`='".$user_id."' AND a.`id` = b.`id` AND c.`user_id` = a.`id` LIMIT 0 , 1";
			$result=mysqli_query($ConnectDB,$sql);
			$nums = mysqli_num_rows($result);	
		}
		if($nums==0){
			$sql="SELECT a.`fname`, a.`lname`, c.`picture` FROM `users` a, `user_type` b, `student` c WHERE a.`id`='".$user_id."' AND a.`id` = b.`id` AND c.`user_id` = a.`id` LIMIT 0 , 1";
			$result=mysqli_query($ConnectDB,$sql);
			$nums = mysqli_num_rows($result);	
		}
		

        if($nums!=0){
            while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
				return  $data;

			}
		}
}
function getcat_name_byid($val){
	global $ConnectDB;
		$sql = "SELECT * FROM `news_type` WHERE `id`='".$val."' ORDER BY `id` ASC ";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){

								return $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
							
						}
}
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
	$sql="UPDATE `mit_news` SET  `hits` =  '".$hits."' WHERE  `id` =".$id;
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


/* =Time&Date Config
-------------------------------------------------------------- */
$SuffixTime = array(
	"th"=>array(
		"time"=>array(
			"Seconds"			=>		" วินาที",
			"Minutes"				=>		" นาที",
			"Hours"					=>		" ชั่วโมง"
		),
		"day"=>array(
			"Yesterday"		=>		"เมื่อวาน เวลา ",
			"Monday"				=>		"วันจันทร์ เวลา ",
			"Tuesday"			=>		"วันอังคาร เวลา ",
			"Wednesday"	=>		"วันพุธ เวลา ",
			"Thursday"			=>		"วันพฤหัสบดี เวลา ",
			"Friday"				=>		"วันศุกร์ เวลา ",
			"Saturday"			=>		" วันวันเสาร์ เวลา ",
			"Sunday"				=>		"วันอาทิตย์ เวลา ",
		)
	),
	"en"=>array(
		"time"=>array(
			"Seconds"				=>		" seconds ago",
			"Minutes"				=>		" minutes ago",
			"Hours"					=>		" hours ago"
		),
		"day"=>array(
			"Yesterday"		=>		"Yesterday at ",
			"Monday"				=>		"Monday at ",
			"Tuesday"			=>		"Tuesday at ",
			"Wednesday"	=>		"Wednesday at ",
			"Thursday"			=>		"Thursday at ",
			"Friday"				=>		"Friday at ",
			"Saturday"			=>		"Saturday at ",
			"Sunday"				=>		"Sunday at ",
		)
	)
);

$DateThai = array(
	// Day
	"l" => array(	// Full day
		"Monday"				=>		"วันจันทร์",
		"Tuesday"			=>		"วันอังคาร",
		"Wednesday"	=>		"วันพุธ",
		"Thursday"			=>		"วันพฤหัสบดี",
		"Friday"				=>		"วันศุกร์",
		"Saturday"			=>		"วันวันเสาร์",
		"Sunday"				=>		"วันอาทิตย์",
	),
	"D" => array(	// Abbreviated day
		"Monday"				=>		"จันทร์",
		"Tuesday"			=>		"อังคาร",
		"Wednesday"	=>		"พุธ",
		"Thursday"			=>		"พฤหัส",
		"Friday"				=>		"ศุกร์",
		"Saturday"			=>		"วันเสาร์",
		"Sunday"				=>		"อาทิตย์",
	),
	
	// Month
	"F" => array(	// Full month
		"January"				=>		"มกราคม",
		"February"			=>		"กุมภาพันธ์",
		"March"					=>		"มีนาคม",
		"April"					=>		"เมษายน",
		"May"					=>		"พฤษภาคม",
		"June"					=>		"มิถุนายน",
		"July"						=>		"กรกฎาคม",
		"August"				=>		"สิงหาคม",
		"September"		=>		"กันยายน",
		"October"				=>		"ตุลาคม",
		"November"		=>		"พฤศจิกายน",
		"December"		=>		"ธันวาคม"
	),
	"M" => array(	// Abbreviated month
		"January"				=>		"ม.ค.",
		"February"			=>		"ก.พ.",
		"March"					=>		"มี.ค.",
		"April"					=>		"เม.ย.",
		"May"					=>		"พ.ค.",
		"June"					=>		"มิ.ย.",
		"July"						=>		"ก.ค.",
		"August"				=>		"ส.ค.",
		"September"		=>		"ก.ย.",
		"October"				=>		"ต.ค.",
		"November"		=>		"พ.ย.",
		"December"		=>		"ธ.ค."
	)
);
/* =Time&Date Config
-------------------------------------------------------------- */
/* =Function
-------------------------------------------------------------- */
function generate_date_today($Format, $Timestamp, $Language = "en", $TimeText = true )
{
	global $SuffixTime, $DateThai;
	//return date("i:H d-m-Y", $Timestamp) ." | ". date("i:H d-m-Y", time());
	if( date("Ymd", $Timestamp) >= date("Ymd", (time()-345600)) && $TimeText)				// Less than 3 days.
	{
		$TimeStampAgo = (time()-$Timestamp);
		
		if(($TimeStampAgo < 86400))			// Less than 1 day.
		{
			
			$TimeDay = "time";				// Use array time
			
			if($TimeStampAgo < 60)				// Less than 1 minute.
			{
				$Return = (time() - $Timestamp);
				$Values = "Seconds";
			}
			else if($TimeStampAgo < 3600)			// Less than 1 hour.
			{
				$Return = floor( (time() - $Timestamp)/60 );
				$Values = "Minutes";
			}
			else			// Less than 1 day.
			{
				$Return = floor( (time() - $Timestamp)/3600 );
				$Values = "Hours";
			}
			
		}
		else if($TimeStampAgo < 172800)			// Less than 2 day.
		{
			$Return = date("H:i", $Timestamp);
			$TimeDay = "day";
			$Values = "Yesterday";
		}
		else		// More than 2 hours..
		{
			$Return = date("H:i", $Timestamp);
			$TimeDay = "day";
			$Values = date("l", $Timestamp);
		}
		
		if($TimeDay == "time")
			$Return .= $SuffixTime[$Language][$TimeDay][$Values];
		else if($TimeDay == "day")
			$Return = $SuffixTime[$Language][$TimeDay][$Values] . $Return.' น.';
		
		return $Return;
	}
	else
	{
		if($Language == "en")
		{
			return date($Format, $Timestamp);
		}
		else if($Language == "th")
		{
			$Format = str_replace("l", "|1|", $Format);
			$Format = str_replace("D", "|2|", $Format);
			$Format = str_replace("F", "|3|", $Format);
			$Format = str_replace("M", "|4|", $Format);
			$Format = str_replace("y", "|x|", $Format);
			$Format = str_replace("Y", "|X|", $Format);
			$StrCache = "";

			$DateCache = date($Format, $Timestamp);
			
			$AR1 = array ("", "l", "D", "F", "M");
			$AR2 = array ("", "l", "l", "F", "F");
			
			for($i=1; $i<=4; $i++)
			{
				if(strstr($DateCache, "|". $i ."|"))
				{
					//$Return .= $i;
					
					$split = explode("|". $i ."|", $DateCache); 
					for($j=0; $j<count($split)-1; $j++)
					{
						$StrCache .= $split[$j];
						$StrCache .= $DateThai[$AR1[$i]][date($AR2[$i], $Timestamp)];
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}
			}
			
			if(strstr($DateCache, "|x|"))
				{
					
					$split = explode("|x|", $DateCache); 
					
					for($i=0; $i<count($split)-1; $i++)
					{
						$StrCache .= $split[$i];
						$StrCache .= substr((date("Y", $Timestamp)+543), -2);
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}

			if(strstr($DateCache, "|X|"))
				{
					
					$split = explode("|X|", $DateCache); 
					
					for($i=0; $i<count($split)-1; $i++)
					{
						$StrCache .= $split[$i];
						$StrCache .= (date("Y", $Timestamp)+543).' เวลา ';
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}

				$Return = $DateCache.' น.';
				
			return $Return;
		}
	}
}
/* =Function
-------------------------------------------------------------- */

	

    ?>
