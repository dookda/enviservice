<?php

function settitle(){
	$setpagetitle='<title>Baanchan Living Point Co.,Ltd.</title>';
	if(isset($_GET['option'])&&$_GET['option']=='property'){
		if(isset($_GET['id'])&&$_GET['id']!=''){
			$setpagetitle='<title>'.ProductTitle($_GET['id']).'</title>';
		}
		if(isset($_GET['catid'])&&$_GET['catid']!=''){
			if($_GET['catid']=='c1'||$_GET['catid']=='c2'||$_GET['catid']=='c3'){

				switch($_GET['catid']){
					case'c1':
						$setpagetitle='<title>Residential</title>';
						
						break;
					case'c2':
						$setpagetitle='<title>Commercial</title>';
						break;
					case'c3':
						$setpagetitle='<title>Design - Decor & Others</title>';
						break;
				}
			}else{
				$setpagetitle='<title>'.ProductCatTitle($_GET['catid']).'</title>';
			}
		}		
	}
	
	if(isset($_GET['option'])&&$_GET['option']=='channel'){
		$setpagetitle='<title>BAANCHAN - CHANNEL</title>';
	}
	if(isset($_GET['option'])&&$_GET['option']=='home-ideas'){
		if(isset($_GET['id'])){
			$setpagetitle='<title>'.HomeideasTitle($_GET['id']).'</title>';
		}else{
			$setpagetitle='<title>BAANCHAN - HOME IDEAS</title>';
		}
	}
	if(isset($_GET['option'])&&$_GET['option']=='interesting'){
		if(isset($_GET['id'])){
			$setpagetitle='<title>'.InterestingTitle($_GET['id']).'</title>';
		}else{
			$setpagetitle='<title>INTERESTING ARTICLES</title>';
		}
	}
	if(isset($_GET['option'])&&$_GET['option']=='e-books'){

			$setpagetitle='<title>BAANCHAN E-BOOKS & MAGAZINES</title>';

	}
	echo $setpagetitle;
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

function ShowPropertySearch($keyword,$province,$saletype,$cattype,$pricetype,$Page_Start,$Per_Page){
	global $ConnectDB;	
	if($pricetype!=''&&$pricetype!='0'){$pricetype=' AND '.str_replace("PRICE",'`price`',$pricetype);}else{$pricetype='';}
	if($province!=''&&$province!='0'){$province=' AND `province`="'.$province.'"';}else{$province='';}
	if($saletype!=''&&$saletype!='0'){$saletype=' AND `type`="'.$saletype.'"';}else{$saletype='';}
	if($cattype!=''&&$cattype!='0'){$cattype=' AND `class`="'.$cattype.'"';}else{$cattype='';}
	if($keyword!=''&&$keyword!='0'){$keyword='`id`>0 '.$pricetype.$province.$saletype.$cattype.' AND `description` LIKE "%'.$keyword.'%" OR `id`>0 '.$pricetype.$province.$saletype.$cattype.' AND `name` LIKE "%'.$keyword.'%"';}else{$keyword='`id`>0 '.$pricetype.$province.$saletype.$cattype;}
	$sql='SELECT * FROM `ps_item` WHERE '.$keyword.' ORDER BY `id` DESC LIMIT '.$Page_Start .','. $Per_Page;
	$sql2='SELECT * FROM `ps_item` WHERE '.$keyword.' ORDER BY `id` DESC';
	
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	$result2=mysqli_query($ConnectDB,$sql2);
	$nums2 = mysqli_num_rows($result2);
	$catDeatil=json_decode(GetAllCategoryDetail());

		if($nums!=0){
			$text='';
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
				$img=thumb_img($catDeatil->imgpath,$data['images'],$data['class']);
										
	
			   $text.= ' <div class="prop-block">
			   		<div class="binner">
						<div class="img"><a href="index.php?option=property_detail&itemid='.$data['class'].'&id='.$data['id'].'">';
					if($img!=''){
					$text.= '<img src="'.$img.'" width="100%" height="auto" />';
					}
					$text.= '</a></div>
					  <div class="title"><a href="index.php?option=property_detail&itemid='.$data['class'].'&id='.$data['id'].'">'.$data['name'].'</a></div>
					  <div class="location"><i class="fa fa-map-marker"></i> '.$data['province'].'</div>
					  <div class="price">'.number_format(round($data['price'])).'</div>
				  </div>
				</div>';
				
	
			}
			return $text.'[nums]'.$nums.'[nums]'.$nums2;
		}else{
			return 'ไม่พบข้อมูล [nums]0[nums]0';	
		}

}


function showthumbimg($img,$class,$id){
			if($img!=''){
					$img1=json_decode($img); 

						$num_img=count($img1->img)-1;
						foreach($img1->img as $index=>$images){
							if($index=='0'){
								echo setLink('index.php?option=product_detail&catid='.$class.'&id='.$id,'<span class="product_image"><img src="'.WEB_URL.GetImgPath($class).'thumb/'.$images.'"></span>');
							}
							
						}
						if($img=='{"img":[]}'){echo '<div class="product_image"><img src="'.WEB_URL.'images/web/ECOSPRIZE-PRODUCT.jpg" ></div>';}
				
				}else{
					echo '<div class="product_image">';
					echo setLink('index.php?option=product_detail&id='.$id,'<img src="'.WEB_URL.'images/web/ECOSPRIZE-PRODUCT.jpg">');
					echo '</div>';
				}
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
function GetImgPath($id){
	global $ConnectDB;
	
	$sql='SELECT `imgPath` FROM `ps_item_class` WHERE `ps_item_class`.`id`="'.$id.'" LIMIT 0 , 1';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$imgPath=$data['imgPath'];
		}
		return json_encode(array('path'=>$imgPath));
	}
}
function GetImgPathAll(){
	global $ConnectDB;
	
	$sql='SELECT `id`,`imgPath` FROM `baan_item_class`';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	$id=array();
	$imgPath=array();
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			
			$imgPath[$data['id']]=$data['imgPath'];
		}
		return json_encode(array('id'=>$imgPath));
	}
}
function GetCategoryDetail($id){
	global $ConnectDB;
	
	$sql='SELECT * FROM `baan_item_class` WHERE `id`="'.$id.'" ORDER BY  `group` ASC  LIMIT 0 , 1';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$id=$data['id'];
			$name=$data['name'];
			$imgpath=$data['imgPath'];
			$alias=$data['alias'];
			$group=$data['group'];
		}
		return json_encode(array('id'=>$id,'name'=>$name,'imgpath'=>$imgpath,'alias'=>$alias,'group'=>$group));
	}
}
function GetAllCategoryDetail(){
	global $ConnectDB;
	
	$sql='SELECT * FROM `baan_item_class`';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
			$id=array();
			$name=array();
			$imgpath=array();
			$alias=array();
			$group=array();
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$id[$data['id']]=$data['id'];
			$name[$data['id']]=$data['name'];
			$imgpath[$data['id']]=$data['imgPath'];
			$alias[$data['id']]=$data['alias'];
			$group[$data['id']]=$data['group'];
		}
		return json_encode(array('id'=>json_encode($id),'name'=>json_encode($name),'imgpath'=>json_encode($imgpath),'alias'=>json_encode($alias),'group'=>json_encode($group)));
	}
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

function GetProvince($active){
$province='
<select name="province" class="form-control" required="required">
<option value="">Location</option>
<option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
      <option value="กระบี่">กระบี่ </option>
      <option value="กาญจนบุรี">กาญจนบุรี </option>
      <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
      <option value="กำแพงเพชร">กำแพงเพชร </option>
      <option value="ขอนแก่น">ขอนแก่น</option>
      <option value="จันทบุรี">จันทบุรี</option>
      <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
      <option value="ชัยนาท">ชัยนาท </option>
      <option value="ชัยภูมิ">ชัยภูมิ </option>
      <option value="ชุมพร">ชุมพร </option>
      <option value="ชลบุรี">ชลบุรี </option>
      <option value="เชียงใหม่">เชียงใหม่ </option>
      <option value="เชียงราย">เชียงราย </option>
      <option value="ตรัง">ตรัง </option>
      <option value="ตราด">ตราด </option>
      <option value="ตาก">ตาก </option>
      <option value="นครนายก">นครนายก </option>
      <option value="นครปฐม">นครปฐม </option>
      <option value="นครพนม">นครพนม </option>
      <option value="นครราชสีมา">นครราชสีมา </option>
      <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
      <option value="นครสวรรค์">นครสวรรค์ </option>
      <option value="นราธิวาส">นราธิวาส </option>
      <option value="น่าน">น่าน </option>
      <option value="นนทบุรี">นนทบุรี </option>
      <option value="บึงกาฬ">บึงกาฬ</option>
      <option value="บุรีรัมย์">บุรีรัมย์</option>
      <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
      <option value="ปทุมธานี">ปทุมธานี </option>
      <option value="ปราจีนบุรี">ปราจีนบุรี </option>
      <option value="ปัตตานี">ปัตตานี </option>
      <option value="พะเยา">พะเยา </option>
      <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
      <option value="พังงา">พังงา </option>
      <option value="พิจิตร">พิจิตร </option>
      <option value="พิษณุโลก">พิษณุโลก </option>
      <option value="เพชรบุรี">เพชรบุรี </option>
      <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
      <option value="แพร่">แพร่ </option>
      <option value="พัทลุง">พัทลุง </option>
      <option value="ภูเก็ต">ภูเก็ต </option>
      <option value="มหาสารคาม">มหาสารคาม </option>
      <option value="มุกดาหาร">มุกดาหาร </option>
      <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
      <option value="ยโสธร">ยโสธร </option>
      <option value="ยะลา">ยะลา </option>
      <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
      <option value="ระนอง">ระนอง </option>
      <option value="ระยอง">ระยอง </option>
      <option value="ราชบุรี">ราชบุรี</option>
      <option value="ลพบุรี">ลพบุรี </option>
      <option value="ลำปาง">ลำปาง </option>
      <option value="ลำพูน">ลำพูน </option>
      <option value="เลย">เลย </option>
      <option value="ศรีสะเกษ">ศรีสะเกษ</option>
      <option value="สกลนคร">สกลนคร</option>
      <option value="สงขลา">สงขลา </option>
      <option value="สมุทรสาคร">สมุทรสาคร </option>
      <option value="สมุทรปราการ">สมุทรปราการ </option>
      <option value="สมุทรสงคราม">สมุทรสงคราม </option>
      <option value="สระแก้ว">สระแก้ว </option>
      <option value="สระบุรี">สระบุรี </option>
      <option value="สิงห์บุรี">สิงห์บุรี </option>
      <option value="สุโขทัย">สุโขทัย </option>
      <option value="สุพรรณบุรี">สุพรรณบุรี </option>
      <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
      <option value="สุรินทร์">สุรินทร์ </option>
      <option value="สตูล">สตูล </option>
      <option value="หนองคาย">หนองคาย </option>
      <option value="หนองบัวลำภู">หนองบัวลำภู </option>
      <option value="อำนาจเจริญ">อำนาจเจริญ </option>
      <option value="อุดรธานี">อุดรธานี </option>
      <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
      <option value="อุทัยธานี">อุทัยธานี </option>
      <option value="อุบลราชธานี">อุบลราชธานี</option>
      <option value="อ่างทอง">อ่างทอง </option>
</select>
';	
if($active!=''){$province=str_replace('value="'.$active.'"','value="'.$active.'" selected',$province);}
return $province;
}
function breadcrumb($text){
	echo '<div class="breadcrumb"><a href="index.php">Home</a> / '.$text.'</div>';
}

function showproperty($type,$pages){
	global $ConnectDB;
    $coselect='`id`, `name`, `images`, `province`, `price`, `status`, `create_by`';
	$order='ORDER BY `itemupdate` DESC, `id` DESC';
	switch($type){
		case 'Residential';
       /* $where ="WHERE RAND()<(SELECT ((1/COUNT(*))*10) FROM `property_detail` WHERE `property_detail`.`catid`='1' AND `property_detail`.`access`='0') ORDER BY RAND()";*/
	   $where ="WHERE  `class` IN ( 1, 2, 3 )  AND `status`='1' ".$order." LIMIT 0 , 8";
        break;
		case 'Commercial';
        $where ="WHERE  `class` IN ( 4, 5, 6, 7 )  AND `status`='1' ".$order." LIMIT 0 , 8";
        break;
		case 'Design';
        $where ="WHERE  `class` IN ( 8, 9, 10 )  AND `status`='1' ".$order." LIMIT 0 , 4";
        break;
		case 'Furnitures';
        $where ="WHERE  `class` IN ( 11 )  AND `status`='1' ".$order." LIMIT 0 , 4";
        break;
		case 'Gardening';
        $where ="WHERE  `class` IN ( 12 )  AND `status`='1' ".$order." LIMIT 0 , 4";
        break;
		case 'ResidentialCat';
		$where ="WHERE `class` IN ( 1, 2, 3 ) AND `status`='1' ".$order;
		$isCat='c1';
        break;
		case 'HouseCat';
		$where ="WHERE `class` IN ( 1 ) AND `status`='1' ".$order;
		$isCat='1';
        break;
		case 'CondominiumCat';
		$where ="WHERE `class` IN ( 2 ) AND `status`='1' ".$order;
		$isCat='2';
        break;
		case 'ApartmentCat';
		$where ="WHERE `class` IN ( 3 ) AND `status`='1' ".$order;
		$isCat='3';
        break;
		case 'CommercialCat';
		$where ="WHERE `class` IN ( 4, 5, 6, 7 ) AND `status`='1' ".$order;
		$isCat='c2';
        break;
		case 'OfficeCat';
		$where ="WHERE `class` IN ( 4 ) AND `status`='1' ".$order;
		$isCat='4';
        break;
		case 'IndustrialCat';
		$where ="WHERE `class` IN ( 5 ) AND `status`='1' ".$order;
		$isCat='5';
        break;
		case 'HotelCat';
		$where ="WHERE `class` IN ( 6 ) AND `status`='1' ".$order;
		$isCat='6';
        break;
		case 'LandCat';
		$where ="WHERE `class` IN ( 7 ) AND `status`='1' ".$order;
		$isCat='7';
        break;
		case 'DesignCat';
		$where ="WHERE `class` IN ( 8, 9, 10, 11, 12 ) AND `status`='1' ".$order;
		$isCat='c3';
        break;
		case 'Design2Cat';
		$where ="WHERE `class` IN ( 8 ) AND `status`='1' ".$order;
		$isCat='8';
        break;
		case 'ConstructionCat';
		$where ="WHERE `class` IN ( 9 ) AND `status`='1' ".$order;
		$isCat='9';
        break;
		case 'DecorationCat';
		$where ="WHERE `class` IN ( 10 ) AND `status`='1' ".$order;
		$isCat='10';
        break;
		case 'FurnituresCat';
        $where ="WHERE  `class` IN ( 11 )  AND `status`='1' ".$order;
		$isCat='11';
        break;
		case 'GardeningCat';
        $where ="WHERE  `class` IN ( 12 )  AND `status`='1' ".$order;
		$isCat='12';
        break;
    	default:
		$search_on='1';
		$where ="WHERE  `name` LIKE '%".quote($type)."%'  AND `status`='1' OR `province` LIKE '%".quote($type)."%'  AND `status`='1' OR `description` LIKE '%".quote($type)."%'  AND `status`='1' ".$order;

	   break;
	}
		$sql = "SELECT ".$coselect." FROM `baan_item` ".$where;
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
		if(isset($search_on)){echo '<h1>ผลการค้นหา "'.$type.'" ('.$nums.' รายการ)</h1>';}
		if(isset($isCat)||isset($search_on)){ /* Get pagination of category page*/ 

			$Num_Rows = $nums;
			$Per_Page = 20;   // Per Page
			if(!isset($_GET["Page"])){$Page=1;}else{$Page = $_GET["Page"];	}
			$Prev_Page = $Page-1;
			$Next_Page = $Page+1;
			$Page_Start = (($Per_Page*$Page)-$Per_Page);
			if($Num_Rows<=$Per_Page){$Num_Pages =1;}else if(($Num_Rows % $Per_Page)==0){$Num_Pages =($Num_Rows/$Per_Page) ;}
			else{$Num_Pages =($Num_Rows/$Per_Page)+1;$Num_Pages = (int)$Num_Pages;}
			
			$sql2 ="SELECT ".$coselect." FROM `baan_item` ".$where." LIMIT ".$Page_Start .",". $Per_Page;
			$result=mysqli_query($ConnectDB,$sql2);
			$nums = mysqli_num_rows($result);
		
		}
	if($nums!=0){	
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			
			$id=$data['id'];
			$title=$data['name'];	
			echo '<div class="ads-list">';
			echo '<div class="ads-img"><a href="index.php?option=property&id='.$id.'" title="'.$title.'">';
				if($data['images']!=''){
						$img1=json_decode($data['images']); 
						$img=thumb_img($data['images']);
						foreach($img1->img as $i=>$images){
							if($i=='0'){
							echo '<img src="'.str_replace('|','thumb/',$images).'">';
							break;
							}
			
						}
				}
			echo '</a></div>';
			
            echo '<div class="ads-title"><a href="index.php?option=property&id='.$id.'" title="'.$title.'">'.$title.'</a></div>';
			echo '<div class="location_text"><i class="fa fa-map-marker"></i> <small>'.$data['province'].'</small></div>';
			echo '<div class="price_text"><small>THB '.number_format($data['price']).'</small></div>';
   			echo '</div>';	
		}
		
    	if(isset($isCat)||isset($search_on)){ /* Get pagination of category page*/ 
		if(isset($search_on)){$typesearch="?option=search&keyword=".$type;}else{$typesearch="?option=property&catid=".$isCat;}
                    $pages->items_total = $Num_Rows;
                    $pages->mid_range = 10;
                    $pages->current_page = $Page;
                    $pages->default_ipp = $Per_Page;
                    $pages->url_next = $_SERVER["PHP_SELF"].$typesearch."&Page=";
                    $pages->paginate();
                    showPagination();
		}
	
	}else{echo NO_DATA;}
	
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
function property_autosearch($type){
	global $ConnectDB;
    $coselect='`id`, `name`, `images`, `status`, `create_by`';	
	$order='ORDER BY `itemupdate` DESC, `id` DESC';
	$where ="WHERE  `name` LIKE '%".quote($type)."%'  AND `status`='1' OR `province` LIKE '%".quote($type)."%'  AND `status`='1' OR `description` LIKE '%".quote($type)."%'  AND `status`='1' ".$order." LIMIT 0,6";
	$where2 ="WHERE  `name` LIKE '%".quote($type)."%'  AND `status`='1' OR `province` LIKE '%".quote($type)."%'  AND `status`='1' OR `description` LIKE '%".quote($type)."%'  AND `status`='1' ".$order;

	$sql = "SELECT ".$coselect." FROM `baan_item` ".$where;
	$sql2 = "SELECT ".$coselect." FROM `baan_item` ".$where2;
	$result = mysqli_query($ConnectDB,$sql);
	$result2 = mysqli_query($ConnectDB,$sql2);
	$nums = mysqli_num_rows($result);
	$nums2 = mysqli_num_rows($result2);
		
	if($nums!=0){	
		$new_row['index']=1;
		$new_row['id']='';
		$new_row['name']='';
		$new_row['image']='';
		$new_row['class']='first-data';
		$new_row['nums']=$nums2;
		$row_set[] = $new_row; //build an array
		$i=1;
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			$i++;
				$images_url='';
				if($data['images']!=''){
						$img1=json_decode($data['images']); 
						
						foreach($img1->img as $k=>$images){
							if($k=='0'){
							$images_url=str_replace('|','thumb/',$images);
							break;
							}
			
						}
				}
		$new_row['index']=$i;
		$new_row['id']=htmlentities(stripslashes($data['id']));
		$new_row['name']=htmlentities(stripslashes($data['name']));
		$new_row['image']=$images_url;
		if($i==7){
			$new_row['class']='last-data';
		}else{
			$new_row['class']='';
		}
		$new_row['nums']='';
		$row_set[] = $new_row; //build an array

		}
		if($nums==1){	
		$new_row['index']=3;
		$new_row['id']='';
		$new_row['name']='';
		$new_row['image']='';
		$new_row['class']='disable';
		$new_row['nums']='';
		$row_set[] = $new_row; //build an array
		$i=1;
		}
	
	}else{ /* Not found */
		$new_row['index']=0;
		$new_row['id']='';
		$new_row['name']='';
		$new_row['image']='';
		$new_row['class']='';
		$new_row['nums']='';
		$row_set[] = $new_row; //build an array	
	}
			echo json_encode($row_set); //format the array into json data
	
}
function prop_Popular($type,$class,$idcur){
	global $ConnectDB;
    $coselect='`id`, `name`, `status`, `images`';
		switch($class){
			case'c1':
				$classselect="`class` IN('1','2','3')";
				break;	
			case'c2':
				$classselect="`class` IN('4','5','6','7')";
				break;	
			case'c3':
				$classselect="`class` IN('8','9','10')";
				break;	
			default:
				$classselect="`class`='".$class."'";
				break;	
		}
		$where ="WHERE ".$classselect." AND `status`='1' AND `id`!='".$idcur."' ORDER BY `hits` DESC";

		$sql = "SELECT ".$coselect." FROM `baan_item` ".$where." LIMIT 0 ,3";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
	if($nums!=0){	
		echo '<div class="recommend_block">';
		echo '<h3 class="recommend_title">Popular</h3>';
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			
			$id=$data['id'];
			$title=$data['name'];	
			echo '<div class="recommend_list">';
				echo '<div class="row-fluid">';
					echo '<div class="span3"><div><a href="index.php?option=property&id='.$id.'" title="'.$title.'">';
				
						if($data['images']!=''){
								$img1=json_decode($data['images']); 
								$img=thumb_img($data['images']);
								foreach($img1->img as $i=>$images){
									if($i=='0'){
									echo '<img src="'.str_replace('|','thumb/',$images).'">';
									break;
									}
					
								}
						}
					echo '</a></div></div>';
				

					echo '<div class="span9"><div class="ads-title"><a href="index.php?option=property&id='.$id.'" title="'.$title.'">'.$title.'</a></div></div>';
				echo '</div>';
			echo '</div>';	
		}
		echo '</div>';	
	
	}
	
}
function showimg($data,$thumb){
	
				if($data['images']!=''){
?>

<script type="text/javascript">window.n2jQuery.ready((function($){
	window.nextend.ready(function() {
new NextendSmartSliderSimple('#n2-ss-4', {"admin":false,"isStaticEdited":0,"translate3d":1,"randomize":0,"callbacks":"","align":"normal","isDelayed":0,"load":{"fade":1,"scroll":0,"spinner":"<div><div class=\"n2-ss-spinner-simple-white-container\"><div class=\"n2-ss-spinner-simple-white\"><\/div><\/div>\r\n<style type=\"text\/css\">\r\n.n2-ss-spinner-simple-white-container {\r\n    position: absolute;\r\n    top: 50%;\r\n    left: 50%;\r\n    margin: -20px;\r\n    background: #fff;\r\n    width: 20px;\r\n    height: 20px;\r\n    padding: 10px;\r\n    border-radius: 50%;\r\n    z-index: 1000;\r\n}\r\n\r\n.n2-ss-spinner-simple-white {\r\n  outline: 1px solid RGBA(0,0,0,0);\r\n  width:100%;\r\n  height: 100%;\r\n}\r\n\r\n.n2-ss-spinner-simple-white:before {\r\n    position: absolute;\r\n    top: 50%;\r\n    left: 50%;\r\n    width: 20px;\r\n    height: 20px;\r\n    margin-top: -11px;\r\n    margin-left: -11px;\r\n}\r\n\r\n.n2-ss-spinner-simple-white:not(:required):before {\r\n    content: '';\r\n    border-radius: 50%;\r\n    border-top: 2px solid #333;\r\n    border-right: 2px solid transparent;\r\n    animation: n2SimpleWhite .6s linear infinite;\r\n    -webkit-animation: n2SimpleWhite .6s linear infinite;\r\n}\r\n@keyframes n2SimpleWhite {\r\n    to {transform: rotate(360deg);}\r\n}\r\n\r\n@-webkit-keyframes n2SimpleWhite {\r\n    to {-webkit-transform: rotate(360deg);}\r\n}\r\n\r\n<\/style>"},"playWhenVisible":1,"responsive":{"desktop":1,"tablet":1,"mobile":1,"onResizeEnabled":true,"type":"auto","downscale":1,"upscale":1,"minimumHeight":0,"maximumHeight":3000,"maximumSlideWidth":3000,"maximumSlideWidthLandscape":3000,"maximumSlideWidthTablet":3000,"maximumSlideWidthTabletLandscape":3000,"maximumSlideWidthMobile":3000,"maximumSlideWidthMobileLandscape":3000,"maximumSlideWidthConstrainHeight":0,"forceFull":0,"constrainRatio":1,"verticalOffsetSelectors":"","focusUser":0,"focusAutoplay":0,"deviceModes":{"desktopPortrait":1,"desktopLandscape":0,"tabletPortrait":1,"tabletLandscape":0,"mobilePortrait":1,"mobileLandscape":0},"normalizedDeviceModes":{"unknownUnknown":["unknown","Unknown"],"desktopPortrait":["desktop","Portrait"],"desktopLandscape":["desktop","Portrait"],"tabletPortrait":["tablet","Portrait"],"tabletLandscape":["tablet","Portrait"],"mobilePortrait":["mobile","Portrait"],"mobileLandscape":["mobile","Portrait"]},"verticalRatioModifiers":{"unknownUnknown":1,"desktopPortrait":1,"desktopLandscape":1,"tabletPortrait":1,"tabletLandscape":1,"mobilePortrait":1,"mobileLandscape":1},"minimumFontSizes":{"desktopPortrait":4,"desktopLandscape":4,"tabletPortrait":4,"tabletLandscape":4,"mobilePortrait":4,"mobileLandscape":4},"ratioToDevice":{"Portrait":{"tablet":0.7,"mobile":0.5},"Landscape":{"tablet":0,"mobile":0}},"sliderWidthToDevice":{"desktopPortrait":770,"desktopLandscape":770,"tabletPortrait":539,"tabletLandscape":0,"mobilePortrait":385,"mobileLandscape":0},"basedOn":"combined","tabletPortraitScreenWidth":800,"mobilePortraitScreenWidth":440,"tabletLandscapeScreenWidth":800,"mobileLandscapeScreenWidth":440,"orientationMode":"width_and_height","scrollFix":0,"overflowHiddenPage":0},"controls":{"scroll":0,"drag":1,"touch":"horizontal","keyboard":1,"tilt":0},"lazyLoad":0,"lazyLoadNeighbor":0,"blockrightclick":0,"maintainSession":0,"autoplay":{"enabled":1,"start":1,"duration":8000,"autoplayToSlide":-1,"allowReStart":0,"pause":{"click":1,"mouse":"0","mediaStarted":1},"resume":{"click":0,"mouse":"0","mediaEnded":1,"slidechanged":0}},"layerMode":{"playOnce":0,"playFirstLayer":1,"mode":"skippable","inAnimation":"mainInEnd"},"parallax":{"enabled":1,"mobile":0,"is3D":0,"animate":1,"horizontal":"mouse","vertical":"mouse","origin":"slider","scrollmove":"both"},"postBackgroundAnimations":0,"initCallbacks":[],"bgAnimations":0,"mainanimation":{"type":"horizontal","duration":800,"delay":0,"ease":"easeOutQuad","parallax":1,"shiftedBackgroundAnimation":"auto"},"carousel":1,"dynamicHeight":0});
new NextendSmartSliderWidgetArrowImage("n2-ss-4", 1, 0.7, 0.5);
new NextendSmartSliderWidgetThumbnailDefault("n2-ss-4", {"overlay":false,"area":12,"orientation":"horizontal","group":1,"action":"click","captionSize":0,"minimumThumbnailCount":1.5});
	});
}));
</script>
<?php
						$img1=json_decode($data['images']); 
						$img=thumb_img($data['images']);
						$bimg=array();
						$simg=array();
	
									foreach($img1->img as $i=>$images){
										if($i==0){$a1='-active n2-ss-slide'; $a2=' n2-active ';}else{$a1=''; $a2='';}
										
									
											$bimg[]='<div data-slide-duration="0" data-id="'.$i.'" class="n2-ss-slide n2-ss-canvas  n2-ss-slide'.$a1.'-'.$i.'" style="">
                    	<div data-hash="f6460f817494d839a920552eb83f3444'.$i.'" data-desktop="'.str_replace('|','/',$images).'" style="" class="n2-ss-slide-background" data-opacity="1">
                        	<img title="" style="opacity:1;" class="n2-ss-slide-background-image n2-ss-slide-fit n2-ow" data-x="50" data-y="50" src="'.str_replace('|','/',$images).'" alt="" />
                        </div>
                        <div class="n2-ss-layers-container" style=""></div>
                    </div>';
											$simg[]='<td><div class="n2-style-0d7e6147d938756e488febb9fea88b5d-sample'.$a2.'" style="width: 100px;"><div class="n2-ss-thumb-image" style="background-image: URL(&#039;'.str_replace('|','thumb/',$images).'&#039;);width: 100px; height: 60px;background-size: cover;"></div></div></td>';
									
									}
									
?>



<!-- Nextend Smart Slider 3 #4 - BEGIN -->
<div id="n2-ss-4-align" class="n2-ss-align"><div class="n2-padding"><div id="n2-ss-4" class="n2-ss-slider n2-ss-load-fade " data-minFontSizedesktopPortrait="4" data-minFontSizedesktopLandscape="4" data-minFontSizetabletPortrait="4" data-minFontSizetabletLandscape="4" data-minFontSizemobilePortrait="4" data-minFontSizemobileLandscape="4" style="font-size: 16px;" data-fontsize="16">
        <div class="n2-ss-slider-1" style="">
                        <div class="n2-ss-slider-2">
                                <div class="n2-ss-slider-3" style="">
<?php foreach($bimg as $showbimg){echo $showbimg;}; ?>
                    </div>
            </div>
        </div>
        <div data-ssleft="0+15" data-sstop="height/2-previousheight/2" id="n2-ss-4-arrow-previous" class="n2-ss-widget n2-ss-widget-display-desktop n2-ss-widget-display-tablet n2-ss-widget-display-mobile nextend-arrow n2-ib nextend-arrow-previous  nextend-arrow-animated-fade" style="position: absolute;"><img class="n2-ow" data-no-lazy="1" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTEuNDMzIDE1Ljk5MkwyMi42OSA1LjcxMmMuMzkzLS4zOS4zOTMtMS4wMyAwLTEuNDItLjM5My0uMzktMS4wMy0uMzktMS40MjMgMGwtMTEuOTggMTAuOTRjLS4yMS4yMS0uMy40OS0uMjg1Ljc2LS4wMTUuMjguMDc1LjU2LjI4NC43N2wxMS45OCAxMC45NGMuMzkzLjM5IDEuMDMuMzkgMS40MjQgMCAuMzkzLS40LjM5My0xLjAzIDAtMS40MmwtMTEuMjU3LTEwLjI5IiBmaWxsPSIjZmZmZmZmIiBvcGFjaXR5PSIwLjgiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==" alt="Arrow" /></div><div data-ssright="0+15" data-sstop="height/2-nextheight/2" id="n2-ss-4-arrow-next" class="n2-ss-widget n2-ss-widget-display-desktop n2-ss-widget-display-tablet n2-ss-widget-display-mobile nextend-arrow n2-ib nextend-arrow-next  nextend-arrow-animated-fade" style="position: absolute;"><img class="n2-ow" data-no-lazy="1" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTAuNzIyIDQuMjkzYy0uMzk0LS4zOS0xLjAzMi0uMzktMS40MjcgMC0uMzkzLjM5LS4zOTMgMS4wMyAwIDEuNDJsMTEuMjgzIDEwLjI4LTExLjI4MyAxMC4yOWMtLjM5My4zOS0uMzkzIDEuMDIgMCAxLjQyLjM5NS4zOSAxLjAzMy4zOSAxLjQyNyAwbDEyLjAwNy0xMC45NGMuMjEtLjIxLjMtLjQ5LjI4NC0uNzcuMDE0LS4yNy0uMDc2LS41NS0uMjg2LS43NkwxMC43MiA0LjI5M3oiIGZpbGw9IiNmZmZmZmYiIG9wYWNpdHk9IjAuOCIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+" alt="Arrow" /></div>
<div data-ssleft="width/2-thumbnailwidth/2" data-sstop="height" data-offset="0" class="n2-ss-widget n2-ss-widget-display-desktop n2-ss-widget-display-tablet n2-ss-widget-display-mobile nextend-thumbnail nextend-thumbnail-default nextend-thumbnail-horizontal" style="position: absolute;width:100%;"><img class="nextend-thumbnail-button nextend-thumbnail-previous n2-ow" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxjaXJjbGUgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiIG9wYWNpdHk9Ii41IiBmaWxsPSIjMDAwIiBjeD0iMTMiIGN5PSIxMyIgcj0iMTIiLz4KICAgICAgICA8cGF0aCBkPSJNMTMuNDM1IDkuMTc4Yy0uMTI2LS4xMjEtLjI3LS4xODItLjQzNi0uMTgyLS4xNjQgMC0uMzA2LjA2MS0uNDI4LjE4MmwtNC4zOCA0LjE3NWMtLjEyNi4xMjEtLjE4OC4yNjItLjE4OC40MjQgMCAuMTYxLjA2Mi4zMDIuMTg4LjQyM2wuNjUuNjIyYy4xMjYuMTIxLjI3My4xODIuNDQxLjE4Mi4xNyAwIC4zMTQtLjA2MS40MzYtLjE4MmwzLjMxNC0zLjE2MSAzLjI0OSAzLjE2MWMuMTI2LjEyMS4yNjkuMTgyLjQzMi4xODIuMTY0IDAgLjMwNy0uMDYxLjQzMy0uMTgybC42NjItLjYyMmMuMTI2LS4xMjEuMTg5LS4yNjIuMTg5LS40MjMgMC0uMTYyLS4wNjMtLjMwMy0uMTg5LS40MjRsLTQuMzczLTQuMTc1eiIgZmlsbD0iI2ZmZiIvPgogICAgPC9nPgo8L3N2Zz4=" alt="Arrow" /><img class="nextend-thumbnail-button nextend-thumbnail-next n2-ow n2-active" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNiIgaGVpZ2h0PSIyNiI+CiAgICA8ZyBmaWxsPSJub25lIj4KICAgICAgICA8Y2lyY2xlIGN4PSIxMyIgY3k9IjEzIiByPSIxMiIgZmlsbD0iIzAwMCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiIG9wYWNpdHk9Ii41Ii8+CiAgICAgICAgPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTEyLjU2NSAxNi44MjJjLjEyNi4xMi4yNy4xODIuNDM2LjE4Mi4xNjggMCAuMzEtLjA2LjQzLS4xODJsNC4zOC00LjE3NWMuMTI4LS4xMi4xOS0uMjYyLjE5LS40MjQgMC0uMTYtLjA2Mi0uMzAyLS4xOS0uNDIzbC0uNjUtLjYyMmMtLjEyNS0uMTItLjI3Mi0uMTgyLS40NC0uMTgyLS4xNyAwLS4zMTQuMDYtLjQzNi4xODJsLTMuMzE0IDMuMTYtMy4yNS0zLjE2Yy0uMTI2LS4xMi0uMjctLjE4Mi0uNDMtLjE4Mi0uMTY2IDAtLjMxLjA2LS40MzUuMTgybC0uNjYyLjYyMmMtLjEyNi4xMi0uMTkuMjYyLS4xOS40MjMgMCAuMTYyLjA2NC4zMDMuMTkuNDI0bDQuMzczIDQuMTc1eiIvPgogICAgPC9nPgo8L3N2Zz4=" alt="Arrow" /><div class="nextend-thumbnail-inner"><div class="n2-style-8c39bd1b5d1c821102353bb13550e669-simple nextend-thumbnail-scroller"><table class="n2-ow"><tr><?php foreach($simg as $showsimg){echo $showsimg;}; ?></tr></table></div></div></div>
</div><div class="clear"></div></div></div><div id="n2-ss-4-placeholder" style="position: relative;z-index:2;"><img style="width: 100%; max-width:3000px;" class="n2-ow" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMCIgd2lkdGg9Ijc3MCIgaGVpZ2h0PSI1MDAiID48L3N2Zz4=" alt="Slider" /></div>
<!-- Nextend Smart Slider 3 #4 - END -->

<?php		
				}



}

function orderimg($id,$mlimit,$thumb){
	global $ConnectDB;
	switch($mlimit){
		case '1':
		$limit= 'LIMIT 0 , 1';
		break;
		default:
       $limit= 'LIMIT 0 , '.$mlimit;
	}
	

$sql = "SELECT * FROM `property_images` WHERE  `property_images`.`img_group`='".$id."' ORDER BY  `property_images`.`ordering` ASC ".$limit;
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
	if($nums!=0){	
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			switch($thumb){
				case '0':
				$thumbd='/';
				echo $img='<li class="ui-state-default" id="listItem_'.$data['id'].'"><img src="uploads/thumb/'.$thumbd.$data['img_name'].'" width="200" height="183"></li>';
				break;
				default:
			   $thumbd='/thumb/';
			   return $img='<img src="uploads'.$thumbd.$data['img_name'].'" width="200" height="auto">';
			}

		}
	
	}else{}
}




function show_progress(){
echo'<div class="progress2">กรุณารอสักครู่...</div><div class="progress"><div class="bar" style="width: 0%;"></div><div class="percent">0%</div></div>';	
}

    ?>
