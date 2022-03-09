<?php
function setval($val){
	if(isset($_POST[$val])){ return $_POST[$val]; }else{ return '';}
}



function GetStatus($id,$status){
	switch($id){
		case '1':
			return '<button class="btn btn-default btn-xs status1" data-id="'.$status.'"><i class="fa fa-check"></i></button>';	
			break;
		default:
			return '<button class="btn btn-default btn-xs status0" data-id="'.$status.'"><i class="fa fa-times"></i></button>';	
	}
}

function showSlide($numbanner=1){
		global $ConnectDB;
	
    $coselect='`images`,`link`,`target`';
	$order='ORDER BY `imgorder` ASC,`id` DESC';
	$where ="WHERE  `status`='1' ".$order." LIMIT 0,".$numbanner."";

		$sql = "SELECT ".$coselect." FROM `slide` ".$where;
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
$i=0;
	if($nums!=0){	
echo '            <section class="space--xxs slide-area">
           
                    <div class="row">
                        <div class="slider" data-arrows="true" data-paging="true" data-timing="6000">
                            <ul class="slides">';
			while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
				$target='';
				if($data['target']=='1'){
					$target=' target="_blank"';
				}
				
			
		
			
							if($data['images']!=''){
								$img1=json_decode($data['images']); 
								
								foreach($img1->img as $i=>$images){
									$imgex=explode("|",$images);
									$alt='alt="'.$imgex[1].'"';
									if($data['link']!=''){
										echo '<li><a href="'.$data['link'].'"'.$target.'><img alt="'.$alt.'" src="'.str_replace('|','',$images).'"></a></li>';
									}else{
										echo '<li><img alt="'.$alt.'" src="'.str_replace('|','',$images).'"></li>';
									}
						 
	
								}
							}
			}
			echo '                            </ul>
                        </div>
                    </div>
                
            </section>';
		}
	}

    ?>
