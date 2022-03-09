<?php
class main {
	
    public function __construct() {
		global $ConnectDB;
        $this->ConnectDB = $ConnectDB;
    }
	public function setval($val){
		if(isset($_POST[$val])){ return $_POST[$val]; }else{ return '';}
	}
	public function GetConfig(){
		global $ConnectDB;
		$sql='SELECT * FROM `env_data` WHERE `id`="1" LIMIT 0 , 1';
		$result=mysqli_query($this->ConnectDB,$sql);


			return mysqli_fetch_array($result, MYSQLI_ASSOC);
		
	}
	public function GetAllCategory(){
		global $ConnectDB;
		$sql='SELECT * FROM `env_category`';
		$result=mysqli_query($this->ConnectDB,$sql);
;

			return mysqli_fetch_all($result, MYSQLI_ASSOC);
		
	}
	public function GetAllStatus(){
		global $ConnectDB;
		$sql='SELECT * FROM `env_status`';
		$result=mysqli_query($this->ConnectDB,$sql);
;

			return mysqli_fetch_all($result, MYSQLI_ASSOC);
		
	}

	public function CheckDirExists_Create($path=array()){
		foreach($path as $dir){
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
				
			}
		}
		return true;
	}
	public function check_email($val,$id=''){
		global $ConnectDB;
		if($id!=''){ $set_id=" AND `id` != '".$id."' ";}else{$set_id='';}
		$sql="SELECT `email` FROM `env_customer` WHERE `email` = '".$val."'".$set_id." LIMIT 0 , 1";
		$result=mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
		return $nums;
	}
	private function CheckFileType($file){
		if($file=='image/jpeg'||$file=='image/pjpeg'||$file=='image/png'||$file=='image/gif'){
			return true;
		}else{
			return false;
		}
	}
	private function generateRandomString($length = 3) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	private function file_rename($file_name,$cat){
			$ser = explode(".", $file_name);
			return $imgname=$cat.'_'.$this->generateRandomString().time().rand(1,100).'.'.$ser[1];
	}
	private function file_resize($max_width, $max_height, $source_file, $dst_dir, $quality = 100){
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
	private function file_resize2($max_width, $max_height, $source_file, $dst_dir, $quality = 100){
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
	public function UpOldDelImg($newimg,$oldimg,$delimg,$orderimg,$TxtFilterOldImg,$file_path,$dirname,$imgsize1=array(),$imgsize2=array()){
		$img=array();	
		$alloldImg=count($oldimg);
		$oimg_count=0;
		$count_file=0;

	
		if($orderimg!=''){
			foreach($orderimg as $i=>$data){
			
	
				if(substr_count($data,$TxtFilterOldImg)>0){ /* if tag contian old image*/
					$img[]=$oldimg[$oimg_count]; /* Get Old Image*/
					$oimg_count++;
					
				}else{ /* New image */
		
					if($newimg!=''){
					
						$check = getimagesize($newimg["tmp_name"][$count_file]);
						if($check !== false) {
							
							if($this->CheckFileType($newimg['type'][$count_file])){
									$fname=$this->file_rename($newimg["name"][$count_file],$dirname);
									$filec=move_uploaded_file($newimg["tmp_name"][$count_file],$file_path.$fname);
									$this->file_resize2($imgsize1[0], $imgsize1[1], $file_path.$fname, $file_path.$fname);
									$this->file_resize($imgsize2[0], $imgsize2[1], $file_path.$fname, $file_path."thumb/".$fname);
									$count_file++;
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
	
}
?>