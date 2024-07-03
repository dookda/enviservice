<?php
function activities_title(){
	global $ConnectDB;
	if(isset($_GET['itemid'])&&$_GET['itemid']!=''){
		$sql = "SELECT * FROM `activity_type` WHERE `id`='".quote($_GET['itemid'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
								return $data['type_name'];
							}
							
						}
	}
	if(isset($_GET['id'])&&$_GET['id']!=''){
		$sql = "SELECT `name` FROM `activity` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
								if($_GET['option']=='activities'){
									return $data['name'];
								}else{
									return 'รายชื่อผู้เข้าร่วมกิจกรรม '.$data['name'];
								}
							}
							
						}
	}
}

function news_title(){
	global $ConnectDB;
	if(isset($_GET['itemid'])&&$_GET['itemid']!=''){
		$sql = "SELECT * FROM `news_type` WHERE `id`='".quote($_GET['itemid'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
								return $data['type_name'];
							}
							
						}
	}
	if(isset($_GET['id'])&&$_GET['id']!=''){
		$sql = "SELECT `name` FROM `mit_news` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
								
									return $data['name'];
							
							}
							
						}
	}
}

function discuss_title(){
	global $ConnectDB;
	if(isset($_GET['id'])&&$_GET['id']!=''){
		$sql = "SELECT `room` FROM `chat_room` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
								return $data['room'];
							}
							
						}
	}else{
		return 'สนทนา';
	}

}


function personnel_title(){
	global $ConnectDB;
	if($_GET['option']=='personnel'){
		return 'ทำเนียบบุคลากร';
	}
	if(isset($_GET['id'])){
		$sql = "SELECT `fname`,`lname` FROM `personnel` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{

									return 'ข้อมูลส่วนตัวของคุณ'.$data['fname'].' '.$data['lname'];
								
							}
							
						}
	}
}

function alumni_title(){
	global $ConnectDB;
	if($_GET['option']=='alumni'){
		return 'ทำเนียบศิษย์เก่า';
	}
	if(isset($_GET['id'])){
		$sql = "SELECT `fname`,`lname` FROM `alumni` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{

									return 'ข้อมูลส่วนตัวของคุณ'.$data['fname'].' '.$data['lname'];
								
							}
							
						}
	}
}

function student_title(){
	global $ConnectDB;
	if($_GET['option']=='student'){
		return 'ทำเนียบนักศึกษา';
	}
	if(isset($_GET['id'])){
		$sql = "SELECT `fname`,`lname` FROM `student` WHERE `id`='".quote($_GET['id'])."' LIMIT 0 , 1";
		$result = mysqli_query($ConnectDB,$sql);
		$nums = mysqli_num_rows($result);
                    $result=mysqli_query($ConnectDB,$sql);
                    $nums = mysqli_num_rows($result);
                        if($nums!=0){
							while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{

									return 'ข้อมูลส่วนตัวของคุณ'.$data['fname'].' '.$data['lname'];
								
							}
							
						}
	}
}
?>