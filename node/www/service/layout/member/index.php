<link rel="stylesheet" href="./plugins/iCheck/flat/green.css">
<script src="./plugins/iCheck/icheck.min.js"></script>

<?php
include('function/member.php');
if($usertype=='1'){}else{ die('ไม่อนุญาตให้เข้าถึงข้อมูลนี้');}

$where_status='';
	$where='WHERE `id` > 0 ';

if(isset($_SESSION['cur_member_status'])){
	$where_status=" AND `block`='".$_SESSION['cur_member_status']."' ";	
}
if(isset($_POST['keyword'])){
	$where.=" AND `fname` LIKE '%".trim($_POST['keyword'])."%'".$where_status." OR `email` LIKE '%".trim($_POST['keyword'])."%'".$where_status." OR `user` LIKE '%".trim($_POST['keyword'])."%'".$where_status." ";
	$key=trim($_POST['keyword']);
}else{
	$where.=$where_status;
}



$sql2='SELECT * FROM `env_users` '.$where;
$result=mysqli_query($ConnectDB,$sql2);
$nums2 = mysqli_num_rows($result);

$Num_Rows = $nums2;
if(isset($_SESSION['cur_number7'])){
	$Per_Page = $_SESSION['cur_number7'];   // Per Page
}else{
	$Per_Page = 20;   // Per Page
}
if(!isset($_GET["Page"])){$Page=1;}else{$Page = $_GET["Page"];	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page){$Num_Pages =1;}else if(($Num_Rows % $Per_Page)==0){$Num_Pages =($Num_Rows/$Per_Page) ;}
else{$Num_Pages =($Num_Rows/$Per_Page)+1;$Num_Pages = (int)$Num_Pages;}

$sql='SELECT * FROM `env_users` '.$where.'ORDER BY  `id` DESC LIMIT '.$Page_Start .','. $Per_Page;
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
?>

<section class="content-header">
          <h1>
            ระบบจัดการผู้ใช้ <small><span class="label label-success"><?php echo $nums; ?> รายการ</span></small>
              <?php if(isset($key)&&$key!=''){ ?>
                  
                  <div class="keyword_block" style="font-size:12pt"><span><?php echo $key;?></span><i style=" color: red; cursor:pointer " class="fa fa-close pull-right"></i></div>
                  <?php }else{ 
				  	if(isset($key)){
				  ?>
                  <div class="keyword_block" style="font-size:12pt"><span>ไม่มีผลลัพธ์</span><i style=" color: red; cursor:pointer " class="fa fa-close pull-right"></i></div>
                  <?php }} ?>
<?php if(isset($_SESSION['cur_member_status'])){
	$nst='';
					  switch($_SESSION['cur_member_status']){
						  case '0':
						  	$nst= 'ที่เปิดใช้งาน';
						  break;
						  case '1':
						  	$nst= 'ที่โดนบล็อก';
						  break; 
					  }
					  
					  echo '<div class="keyword_block" style="font-size:12pt"><span style="font-size:12pt">'.$nst.'</span><span class="scat"><a href="javascript:;" data-id="all"><i style=" color: red; cursor:pointer" class="fa fa-close pull-right "></i></a></span></div>';
					  }?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">ผู้ใช้</li>
          </ol>
</section>
<section class="content st-data"> 
<div class="row">
            <div class="col-md-12">
              <div class="box">
              
                <div class="box-body no-padding">
                
              <div class="mailbox-controls">

                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm label-success create_post" data-toggle="modal" data-target="#myModalp"><i class="fa fa-plus"></i>&nbsp;&nbsp;สร้างใหม่</button>    
                  </div>
                  
                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm i-del del_product_all"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;ลบ</button> <button type="button" class="btn btn-default btn-sm i-active"><i class="fa fa-check"></i>&nbsp;&nbsp;ปลดบล็อก</button><button type="button" class="btn btn-default btn-sm i-unactive"><i class="fa fa-times"></i>&nbsp;&nbsp;บล็อก</button>
                <form id="st_del" name="stdel" method="post" enctype="multipart/form-data">
                <div class="postinput"></div>
                </form>
                <form id="st_block" name="stblock" method="post" enctype="multipart/form-data">
                <div class="blockinput"></div>
                <input type="hidden" name="mode" class="blockmode"/>
                </form>
                <form id="st_active" name="stactive" method="post" enctype="multipart/form-data">
                <div class="activeinput"></div>
                <input type="hidden" name="mode" class="activemode"/>
                </form>
                  </div>

                  
                

                  <div class="pull-right">
                  <div class="btn-group">
                      <form id="qtsearch" name="qtsearch" action="index.php?option=member&itemid=6" method="post" enctype="multipart/form-data">
                    <div class="input-group" style="width: 150px;">

                      <input type="text" name="keyword" class="form-control input-sm pull-right sosearch" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                      
                    </div></form><?php /* END Search*/ ?>
                  </div>  
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_member_status'])){
					  switch($_SESSION['cur_member_status']){
						  case '0':
						  	echo 'เปิดใช้งาน';
						  break;
						  case '1':
						  	echo 'โดนบล็อก';
						  break; 
					  }
					  }else{ echo 'เลือกสถานะ';}?></button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu scat" role="menu">
                  <form id="getcat" method="post" enctype="multipart/form-data">
                  	<input name="cat" type="hidden" id="cat_val">
                  </form>
                  <?php 
				  echo '<li><a href="#" data-id="all">ทั้งหมด</a></li>';
		
			

								echo 	'<li><a href="#" data-id="0">เปิดใช้งาน</a></li>';
								echo 	'<li><a href="#" data-id="1">โดนบล็อก</a></li>';
						

				  ?>
                    
   
                  </ul>
                </div>
                
                   <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_number7'])){
							  switch($_SESSION['cur_number7']){
								  case'30':
								  	echo '30 รายการ';
								  break;
								  case'50':
								  	echo '50 รายการ';
								  break;
								  case'100':
								  	echo '100 รายการ';
								  break;
							  } 
							  
							  }else{ echo '20 รายการ';}?></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu snumber" role="menu">
                          <form id="getnumber" method="post" enctype="multipart/form-data">
                            <input name="number" type="hidden" id="number_val">
                          </form>
                          <?php 
                          echo '<li><a href="#" data-id="all">20 รายการ</a></li>';

 
                                        echo 	'<li><a href="#" data-id="30">30 รายการ</a></li>';
										echo 	'<li><a href="#" data-id="50">50 รายการ</a></li>';
										echo 	'<li><a href="#" data-id="100">100 รายการ</a></li>';
                      
        
                          ?>
                            
           
                          </ul>
                        </div>
               		 </div> <?php /* END Num Page*/ ?>
                
                  </div> 
              
                </div>
                
                  <table class="table table-hover ">
                    <tbody><tr>
                    <th width="50">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                	</th>
                      <th width="100">สถานะ</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>ชื่อผู้ใช้</th>
                      <th>อีเมล</th>
                       <th>วันที่ลงทะเบียน</th>
                      <th class="sorting_desc" aria-sort="descending">เข้าระบบล่าสุด</th>
                      <th class="sorting_desc" aria-sort="descending">IP</th>
                      <th>#</th>
                 
                    </tr>
<?php

	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
			

?>
                    <tr>
                    	<td align="center" width="50"><?php if($data['id']=='1'||$_SESSION["userid"]==$data['id']){}else{?><input type="checkbox"  data-id="<?php echo $data['id'];?>"><?php } ?></td>
                      <td width="100" class="">
                          <div class="btn-group">

                            <button type="button" class="btn bg-blue btn-xs showdata" data-toggle="modal" data-target="#myModalp" data-id="<?php echo $data['id']; ?>"><i class="fa fa-edit"></i></button> 
                            <?php if($data['id']=='1'||$_SESSION["userid"]==$data['id']){}else{?>
                            <button class="btn btn-default btn-xs del_product i-del2" data-id="<?php echo $data['id'];?>" ><i class="fa fa-trash-o"></i></button>
                            <?php } ?>
					  <form class="block_user userblock" id="block<?php echo $data['id']; ?>" name="block<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data" style=" float: left; font-size: 12px; border-top-right-radius: 0; border-bottom-right-radius: 0; ">
					  <?php if($data['id']=='1'||$_SESSION["userid"]==$data['id']){}else{?><?php echo GetStatus_block_member($data['block'],$data['id']);?><?php } ?>
                      <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                      <input type="hidden" name="mode" value="<?php 
					  	switch($data['block']){
							case'0':
								echo'block';
								break;
							case'1':
								echo'unblock';
								break;
						}
					  ?>" />
                      </form> 
                          </div>
                      </td>
                      <td><!-- <span class="showdata" data-toggle="modal" data-target="#myModalp" data-id="<?php echo $data['id']; ?>"> --><?php echo $data['fname']; ?> <!-- </span> --></td>
                      <td><?php echo $data['user']; ?></td>


                      <td><?php echo $data['email']; ?></td>
                      <td><?php echo $data['registerDate']; ?></td>
                      <td><?php echo $data['lastvisitDate']; ?></td>
                      <td><?php echo $data['ip']; ?></td>
                      <td><?php echo $data['id'];?></td>
                    </tr>
<?php
		}
	}
?>
 
                  </tbody></table>
                </div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<?php
                    include('function/pagination.php'); 
                    $pages = new Paginator;
                    $pages->items_total = $Num_Rows;
                    $pages->mid_range = 10;
                    $pages->current_page = $Page;
                    $pages->default_ipp = $Per_Page;
                    $pages->url_next = $_SERVER["PHP_SELF"]."?option=member&itemid=7&Page=";
                    $pages->paginate();
                    showPagination();
                  
                    ?>	
                </div> <!-- /.box-footer -->     
              </div><!-- /.box -->
            </div>
          </div>
</section>
<?php include('popup.php');?>
<script src="./plugins/iCheck/icheck.min.js"></script>
<script>
jQuery(document).ready( function($) {
	
	$('.showdata').click(function(){
		var data=$(this).attr('data-id');
		$('.modal-title').html('แก้ไข');	
		$('.modal-body').load('layout/member/productDetail.php?id='+data);	
	});
	$('.create_post').click(function(){
		$('.modal-title').html('สร้างใหม่');	
		$('.modal-body').load('layout/member/add_form.php');	
	});
		
	$('.i-refresh').click(function(){
		window.location.reload();
	});
	$('.fa-close').on("click", function(){
		location.href="index.php?option=member&itemid=7";
	});	

	   
/* Check Box*/
 $('.st-data input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".st-data input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".st-data input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
/* Check Box*/

/*Del Click*/
	   var stdel = { 
	 
		url:'./layout/member/del.php',
		dataType:'json',
	    beforeSubmit:  function(){
				
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						alert('ลบข้อมูลเรียบร้อยแล้ว');	
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };

	$('#st_del').ajaxForm(stdel);
	$('.i-del').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกรายการที่ต้องการจะลบ'); return false;}
		var confirm_del=confirm('ยืนยันการลบ');
		if(!confirm_del){return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			var id=$(this).attr('data-id');
 		
			$('.postinput').append('<input type="hidden" name="st-del[]" value="'+id+'">');


        });
			$('#st_del').submit();
			$('.postinput').html('');
	});
	$('.i-del2').click(function(){
		var confirm_del=confirm('ยืนยันการลบ');
		if(!confirm_del){return false;}
	
			var id=$(this).attr('data-id');
 		
			$('.postinput').append('<input type="hidden" name="st-del[]" value="'+id+'">');

      
			$('#st_del').submit();
			$('.postinput').html('');
	});


	   var getcat = { 
	 
		url:'./layout/member/SetCategory.php',
		dataType:'json',
	    beforeSubmit:  function(){
				
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };
	   var block = { 
	 
		url:'./layout/member/block.php',
		dataType:'json',
	    beforeSubmit:  function(){
		
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };	
	   var active = { 
	 
		url:'./layout/member/active.php',
		dataType:'json',
	    beforeSubmit:  function(){
		
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };
	   var stactive = { 
	 
		url:'./layout/member/active.php',
		dataType:'json',
	    beforeSubmit:  function(){
				
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };
	   var stblock = { 
	 
		url:'./layout/member/block.php',
		dataType:'json',
	    beforeSubmit:  function(){
				
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.reload();
						break;
					default:
						alert(data.status);
						break;
					
				}
			}
		
	

			
	   },
       complete: function() {
		
	   },
       error: function(data) {

				alert('Error '+data.responseText);
	   }
	   };
	$('#st_block').ajaxForm(stblock);
	$('#st_active').ajaxForm(stactive);
	$('.i-active2').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			$('.activemode').val('activeall');
			var id=$(this).attr('data-id');	
			$('.activeinput').append('<input type="hidden" name="id[]" value="'+id+'">');


        });
			$('#st_active').submit();
			$('.activeinput').html('');
	});
	$('.i-active').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			$('.blockmode').val('unblockall');
			var id=$(this).attr('data-id');	
			$('.blockinput').append('<input type="hidden" name="id[]" value="'+id+'">');


        });
			$('#st_block').submit();
			$('.blockinput').html('');
	});
	$('.i-unactive').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			$('.blockmode').val('blockall');
			var id=$(this).attr('data-id');	
			$('.blockinput').append('<input type="hidden" name="id[]" value="'+id+'">');


        });
			$('#st_block').submit();
			$('.blockinput').html('');
	});
	$('#getcat').ajaxForm(getcat);
	$('#getnumber').ajaxForm(getcat);
	$('.userblock .btn-default').click(function(){
		var id=$(this).attr('data-id');
		$('#block'+id).ajaxForm(block);
		$('#block'+id).submit();
	});
	$('.useractive .btn-default').click(function(){
		var id=$(this).attr('data-id');
		$('#active'+id).ajaxForm(active);
		$('#active'+id).submit();
	});
	$('.scat a').click(function(){
		var id=$(this).attr('data-id');
		$('#cat_val').val(id);
		$('#getcat').submit();
	});
	$('.snumber a').click(function(){
		var id=$(this).attr('data-id');
		$('#number_val').val(id);
		$('#getnumber').submit();
	});

});
</script>

