<link rel="stylesheet" href="plugins/iCheck/flat/green.css">
<script src="plugins/iCheck/icheck.min.js"></script>



<?php


if($usertype=='1'||$usertype=='2'){}else{ die('ไม่อนุญาตให้เข้าถึงข้อมูลนี้');}
$get_label='';
$session_label='';

							foreach($main->GetAllCategory() as $cat){
								if(isset($_GET['catid'])&&$_GET['catid']==$cat['id']){
								
								$get_label='<div class="keyword_block" style="font-size:12pt"><span style="font-size:12pt">'.$cat['category_name'].'</span><span class="scat"><a href="javascript:;" data-id="all"><i style=" color: red; cursor:pointer" class="fa fa-close pull-right"></i></a></span></div>';
								$_SESSION['cur_cat2']=$cat['id'];
								}
								
							}
					if(isset($_SESSION['cur_cat2'])){
						foreach($main->GetAllCategory() as $cat){

							if(!isset($_GET['catid'])&&isset($_SESSION['cur_cat2'])&&$_SESSION['cur_cat2']==$cat['id']){
								$session_label='<div class="keyword_block" style="font-size:12pt"><span style="font-size:12pt">'.$cat['category_name'].'</span><span class="scat"><a href="javascript:;" data-id="all"><i style=" color: red; cursor:pointer" class="fa fa-close pull-right"></i></a></span></div>';
								break;
							}
						}
							 
				
							  
							   }
							   
	$where='WHERE `env_list`.`id` > 0 ';
	if(isset($_POST['keyword'])&&$_POST['keyword']!=''){
		$where.=" AND `env_list`.`list_title` LIKE '%".trim($_POST['keyword'])."%' ";
	}
	
	if(isset($_SESSION['cur_status2'])){
		$where.=" AND `env_list`.`list_status` LIKE '".$_SESSION['cur_status2']."' ";	
	}
	
	if(isset($_SESSION['cur_cat2'])){
		$where.=" AND `env_list`.`list_category` LIKE '".$_SESSION['cur_cat2']."' ";	
	}
	if(!isset($_SESSION['cur_cat2'])&&isset($_GET['catid'])){
		$where.=" AND `env_list`.`list_category` LIKE '".quote($_GET['catid'])."' ";	
	}
	if(isset($_SESSION['calendar_start2'])&&isset($_SESSION['calendar_end2'])){
		$where.=" AND `env_list`.`addDate` BETWEEN '".$_SESSION['calendar_start2'].".000000' AND '".$_SESSION['calendar_end2'].".000000' ";	
	}

	if(isset($_POST['keyword'])&&$_POST['keyword']!=''){
		$where.=" OR `env_list`.`id` = ".(int)trim($_POST['keyword'])." ";
		$key=trim($_POST['keyword']);
	}
	
	if(isset($_POST['keyword'])&&$_POST['keyword']!=''&&isset($_SESSION['cur_status2'])){
		$where.=" AND `env_list`.`list_status` LIKE '".$_SESSION['cur_status2']."' ";	
	}
	
	if(isset($_POST['keyword'])&&$_POST['keyword']!=''&&isset($_SESSION['cur_cat2'])){
		$where.=" AND `env_list`.`list_category` LIKE '".$_SESSION['cur_cat2']."' ";	
	}
	if(isset($_POST['keyword'])&&$_POST['keyword']!=''&&!isset($_SESSION['cur_cat2'])&&isset($_GET['catid'])){
		$where.=" AND `env_list`.`list_category` LIKE '".quote($_GET['catid'])."' ";	
	}
	if(isset($_POST['keyword'])&&$_POST['keyword']!=''&&isset($_SESSION['calendar_start2'])&&isset($_SESSION['calendar_end2'])){
		$where.=" AND `env_list`.`addDate` BETWEEN '".$_SESSION['calendar_start2'].".000000' AND '".$_SESSION['calendar_end2'].".000000' ";	
	}



$sql2='SELECT * FROM `env_list` LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id`  '.$where;
$result=mysqli_query($ConnectDB,$sql2);
$nums2 = mysqli_num_rows($result);

$Num_Rows = $nums2;
if(isset($_SESSION['cur_number2'])){
	$Per_Page = $_SESSION['cur_number2'];   // Per Page
}else{
	$Per_Page = 20;   // Per Page
}
if(!isset($_GET["Page"])){$Page=1;}else{$Page = $_GET["Page"];	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page){$Num_Pages =1;}else if(($Num_Rows % $Per_Page)==0){$Num_Pages =($Num_Rows/$Per_Page) ;}
else{$Num_Pages =($Num_Rows/$Per_Page)+1;$Num_Pages = (int)$Num_Pages;}

$sql='SELECT `env_list`.*,
`env_customer`.`id` as `cusid`,
`env_customer`.`name`,
`env_customer`.`tel`,
`env_status`.`status_name`, 
`env_category`.`category_name`, 
`env_category`.`id` as catid 
FROM `env_list` 
LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id` 
LEFT JOIN `env_status` ON  `env_list`.`list_status` = `env_status`.`status_code` 
LEFT JOIN `env_category` ON  `env_list`.`list_category` = `env_category`.`id`
'.$where.'ORDER BY  `env_list`.`id` DESC LIMIT '.$Page_Start .','. $Per_Page;
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
?>

<section class="content-header">
          <h1>
           จัดการงาน 

           <small><span class="label label-success"><?php echo $Num_Rows; ?> รายการ</span></small> 
                 <?php if(isset($key)&&$key!=''){ ?>
                  
                  <div class="keyword_block" style="font-size:12pt"><span><?php echo $key;?></span><i style=" color: red; cursor:pointer " class="fa fa-close pull-right"></i></div>
                  <?php }else{ 
				  	if(isset($key)){
				  ?>
                  <div class="keyword_block" style="font-size:12pt"><span>ไม่มีผลลัพธ์</span><i style=" color: red; cursor:pointer " class="fa fa-close pull-right"></i></div>
                  <?php }} ?>
                  <?php
				  if(isset($_SESSION['calendar_start2'])&&isset($_SESSION['calendar_end2'])){
					  echo '<div class="keyword_block" style="font-size:12pt"><span style="font-size:12pt">วันที่ '.date('d/m/Y', strtotime($_SESSION['calendar_start2'])).' - '.date('d/m/Y', strtotime($_SESSION['calendar_end2'])).' </span><i style=" color: red; cursor:pointer" class="fa fa-close pull-right clear_date"></i></div>';
				  }
				  ?>
                  
					<?php if(isset($_SESSION['cur_status2'])){
						foreach($main->GetAllStatus() as $status){
							if(isset($_SESSION['cur_status2'])&&$_SESSION['cur_status2']==$status['status_code']){
								echo '<div class="keyword_block" style="font-size:12pt"><span style="font-size:12pt">'.$status['status_name'].'</span><span class="sstatus"><a href="javascript:;" data-id="all"><i style=" color: red; cursor:pointer" class="fa fa-close pull-right "></i></a></span></div>';
								break;
							}
						}
							 
				
							  
							   }?>
                               
  					<?php 
					echo $get_label;
					echo $session_label;
?>                             
                  
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">จัดการงาน</li>
          </ol>
</section>
<section class="content st-data"> 
<div class="row">
            <div class="col-md-12">
              <div class="box">

                <div class="box-body no-padding">
                
              <div class="mailbox-controls">
					<?php if($usertype=='1'||in_array("add_list", $perm_data)){ ?>
                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm label-success create_post" data-toggle="modal" data-target="#myModalp"><i class="fa fa-plus"></i>&nbsp;&nbsp;รับงาน</button>    
                  </div>
                  <?php } ?>
                  <?php if($usertype=='1'||in_array("del_list", $perm_data)){ ?>   
                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm i-del del_product_all"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;ลบ</button>
                <form id="st_del" name="stdel" method="post" enctype="multipart/form-data">
                <div class="postinput"></div>
                </form>
                <form id="st_active" name="stactive" method="post" enctype="multipart/form-data">
                <div class="activeinput"></div>
                <input type="hidden" name="mode" class="activemode"/>
                </form>
                  </div>   
                  <?php } ?>
                  
                  
                  <div class="btn-group">
                      <form id="qtsearch" name="qtsearch" action="index.php?option=list&itemid=2" method="post" enctype="multipart/form-data">
                    <div class="input-group" style="width: 150px;">

                      <input type="text" name="keyword" class="form-control input-sm pull-right sosearch" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                      
                    </div></form><?php /* END Search*/ ?>
                    </div>
                    
				<div class="btn-group">
             

                <div class="input-group" style="width: 150px;">
                  <div class="input-group-addon ">
                    <i class="fa fa-calendar"></i>
                  </div>
                 
                <form id="calendar_form" name="stactive" method="post" enctype="multipart/form-data">
                 <input type="text" class="form-control pull-right active" placeholder="วันที่" id="reservation">
                
                <input type="hidden" name="calendar_start" class="calendar_start"/>
                <input type="hidden" name="calendar_end" class="calendar_end"/>
                </form>
                
                <form id="calendar_clear_form" name="stactive" method="post" enctype="multipart/form-data">
  
                
                <input type="hidden" name="calendar_clear" value="1"/>

                </form>
                
                </div>
                <!-- /.input group -->
              </div>  
   

                  <div class="pull-right">

                   <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_status2'])){
						foreach($main->GetAllStatus() as $status){
							if(isset($_SESSION['cur_status2'])&&$_SESSION['cur_status2']==$status['status_code']){
								echo '<span>'.$status['status_name'].'</span>';
								break;
							}
						}
							 
				
							  
							   }else{ echo 'ทุกสถานะ';}?></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu sstatus" role="menu">
                          <form id="getstatus" method="post" enctype="multipart/form-data">
                            <input name="status" type="hidden" id="status_val">
                          </form>
                          <?php 
                          echo '<li><a href="javascript:;" data-id="all">ทุกสถานะ</a></li>';

 
						foreach($main->GetAllStatus() as $status){
							echo '<li><a href="javascript:;" data-id="'.$status['status_code'].'">'.$status['status_name'].'</a></li>';
							
						}
                      
        
                          ?>
                            
           
                          </ul>
                        </div>
               		 </div> <?php /* END Status*/ ?>
                     
                   <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_cat2'])){
						foreach($main->GetAllCategory() as $cat){
							if(isset($_SESSION['cur_cat2'])&&$_SESSION['cur_cat2']==$cat['id']){
								echo '<span>'.$cat['category_name'].'</span>';
								break;
							}
						}
							 
				
							  
							   }else{ echo 'ทุกหมวดหมู่';}?></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu scat" role="menu">
                          <form id="getcat" method="post" enctype="multipart/form-data">
                            <input name="cat" type="hidden" id="cat_val">
                          </form>
                          <?php 
                          echo '<li><a href="javascript:;" data-id="all">ทุกหมวดหมู่</a></li>';

 
						foreach($main->GetAllCategory() as $cat){
							echo '<li><a href="javascript:;" data-id="'.$cat['id'].'">'.$cat['category_name'].'</a></li>';
							
						}
                      
        
                          ?>
                            
           
                          </ul>
                        </div>
               		 </div> <?php /* END Category*/ ?>
                     
                   <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_number2'])){
							  switch($_SESSION['cur_number2']){
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
                	<div class="box-body table-responsive no-padding">
                  <table class="table table-hover ">
                    <tbody><tr>
                    <?php if($usertype=='1'||in_array("del_list", $perm_data)){ ?>
                    <th width="50">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                	</th>
                    <?php } ?>
                      <th width="90">จัดการ</th>
                      <th width="70">No.</th>
                      <th>หัวข้อ</th>
                      
                      <th>ลูกค้า</th>
                      <th>เบอร์ติดต่อ</th>
                      <th>สถานะ</th>
                      <th>หมวดหมู่</th>
                      <th width="100">วันที่รับงาน</th>
                      <th width="100">แก้ไขล่าสุด</th>
                     
                 
                    </tr>
<?php
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
	
?>
                    <tr>
                    	<?php if($usertype=='1'||in_array("del_list", $perm_data)){ ?>
                    	<td align="center" width="50">
<form class="articleactive_form" id="articleactive<?php echo $data['id']; ?>" name="articleactive<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
							
                      <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                            </form>
<?php
$pdf_file='';
							
?>     					
						
                        <input type="checkbox" data-id="<?php echo $data['id'];?>" data-image="<?php echo htmlspecialchars($data['images']);?>">
                        
                        
                        </td>
					<?php } ?>
                      <td >
                          <div class="btn-group">
                           <?php if($usertype=='1'||in_array("edit_list", $perm_data)){ ?>
                            <button type="button" class="btn bg-blue btn-xs showdata" data-id="<?php echo $data['id']; ?>"><i class="fa fa-edit"></i></button>
                            <?php } ?>
   					<?php if($usertype=='1'||in_array("del_list", $perm_data)){ ?>
                            <button class="btn btn-default btn-xs del_product i-del2" data-id="<?php echo $data['id'];?>" data-image="<?php echo htmlspecialchars($data['images']);?>" ><i class="fa fa-trash-o"></i></button>
                            <?php } ?>
                            
<a href="print.php?id=<?php echo $data['id']; ?>" target="_blank" class="btn btn-default btn-xs " data-id="<?php echo $data['id'];?>"><i class="fa fa-print"></i></a>
                        
                          </div>
                      </td>
                      <td><a href="index.php?option=list_detail&itemid=2&id=<?php echo $data['id']; ?>"><?php echo str_pad($data['id'],4,'0',STR_PAD_LEFT);?></a></td>
                      <td><a href="index.php?option=list_detail&itemid=2&id=<?php echo $data['id']; ?>"><?php echo $data['list_title']; ?></a></td>
                     
                      <td><a href="index.php?option=customer_detail&itemid=5&id=<?php echo $data['cusid']; ?>"><?php echo $data['name'];?></a></td>
                      <td><?php echo $data['tel'];?></td>
 						<td><?php echo $data['status_name'];?></td>
              <td><?php echo $data['category_name'];?></td>
  
                       
                        <td><?php echo $data['addDate'];?></td>
                        <td><?php echo $data['editDate'];?></td>
                      
                    </tr>
<?php
		}
	}
?>
 
                  </tbody></table>
                  </div>
                </div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<?php
                    include('function/pagination.php'); 
                    $pages = new Paginator;
                    $pages->items_total = $Num_Rows;
                    $pages->mid_range = 10;
                    $pages->current_page = $Page;
                    $pages->default_ipp = $Per_Page;
                    $pages->url_next = $_SERVER["PHP_SELF"]."?option=list&itemid=2&Page=";
                    $pages->paginate();
                    showPagination();
                  
                    ?>	
                </div> <!-- /.box-footer -->     
              </div><!-- /.box -->
            </div>
          </div>
</section>

<style>
.daterangepicker .calendar {
    display: block;
}
</style>

<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">

<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>

<script>

jQuery(document).ready( function($) {

	$('.setdata').click(function(){
		var data=$(this).attr('data-id');
		$('.modal-body').load('layout/list/setdata.php?id='+data);	
	});
	$('.showdata').click(function(){
		var data=$(this).attr('data-id');
		location.href='index.php?option=edit_list&itemid=2&id='+data;	
	});
	$('.create_post').click(function(){	
		location.href='index.php?option=add_list&itemid=1';	
	});
		
	$('.i-refresh').click(function(){
		window.location.reload();
	});
	$('.fa-close').on("click", function(){
		location.href="index.php?option=list&itemid=2";
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
	 
		url:'layout/list/del.php',
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
	   var stactive = { 
	 
		url:'layout/list/active.php',
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

	$('#st_del').ajaxForm(stdel);
	$('#st_active').ajaxForm(stactive);
	$('.i-active').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			$('.activemode').val('activeall');
			var id=$(this).attr('data-id');	
			$('.activeinput').append('<input type="hidden" name="id[]" value="'+id+'">');


        });
			$('#st_active').submit();
			$('.activeinput').html('');
	});
	$('.i-unactive').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			$('.activemode').val('unactiveall');
			var id=$(this).attr('data-id');	
			$('.activeinput').append('<input type="hidden" name="id[]" value="'+id+'">');


        });
			$('#st_active').submit();
			$('.activeinput').html('');
	});
	$('.i-del').click(function(){
		if($(".st-data input[type='checkbox']:checked").length < 1){alert('กรุณาเลือกรายการที่ต้องการจะลบ'); return false;}
		var confirm_del=confirm('ยืนยันการลบ');
		if(!confirm_del){return false;}
		$(".st-data input[type='checkbox']:checked").each(function(index, element) {
			var id=$(this).attr('data-id');
			var image=$(this).attr('data-image');

 		
			$('.postinput').append('<input type="hidden" name="st-del[]" value="'+id+'">');
			$('.postinput').append('<input type="hidden" name="st-del-image[]" value=\''+image+'\'>');


        });
			$('#st_del').submit();
			$('.postinput').html('');
	});
	$('.i-del2').click(function(){
		var confirm_del=confirm('ยืนยันการลบ');
		if(!confirm_del){return false;}
	
			var id=$(this).attr('data-id');
			var image=$(this).attr('data-image');
 		
			$('.postinput').append('<input type="hidden" name="st-del[]" value="'+id+'">');
			$('.postinput').append('<input type="hidden" name="st-del-image[]" value=\''+image+'\'>');

      
			$('#st_del').submit();
			$('.postinput').html('');
	});

	   var getcat = { 
	 
		url:'layout/list/SetCategory.php',
		dataType:'json',
	    beforeSubmit:  function(){
				
			}, 
		success:   function(data) {
			if(data.status){
				switch(data.status){
					case'1':
						location.href='index.php?option=list&itemid=2';
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
	$('#getcat').ajaxForm(getcat);
	$('#getstatus').ajaxForm(getcat);
	$('#getnumber').ajaxForm(getcat);
	$('#calendar_form').ajaxForm(getcat);
	$('#calendar_clear_form').ajaxForm(getcat);
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
	$('.sstatus a').click(function(){
		var id=$(this).attr('data-id');
		$('#status_val').val(id);
		$('#getstatus').submit();
	});

	   var active = { 
	 
		url:'layout/list/active.php',
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
	$('.btn-default[class*="status"]').click(function(){
		var id=$(this).attr('data-id');
	
		$('#articleactive'+id).ajaxForm(active);
		$('#articleactive'+id).submit();
	});


    var start = moment().subtract(29, 'days');
    var end = moment();


	$('#reservation').daterangepicker({
		
"alwaysShowCalendars": true,
      locale: {
          cancelLabel: 'ล้างค่า',
		  customRangeLabel: 'กำหนดเอง',
		  applyLabel: 'บันทึก',
		  format: 'DD/MM/YYYY'
      },
	  <?php if(isset($_SESSION['calendar_start2'])){ echo 'autoUpdateInput: true,';}else{ echo 'autoUpdateInput: false,'; } ?>
	 
		ranges: {
           'วันนี้': [moment(), moment()],
           'เมื่อวานนี้': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
           '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
           'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
           'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
		
		
		  <?php if(isset($_SESSION['calendar_start2'])){ echo "startDate:'".date('d/m/Y', strtotime($_SESSION['calendar_start2']))."',";} ?>
         <?php if(isset($_SESSION['calendar_end2'])){ echo "endDate:'".date('d/m/Y', strtotime($_SESSION['calendar_end2']))."',";} ?>
		opens: 'right'
		}
		);
 $('#reservation').on('apply.daterangepicker', function(ev, picker) {
      $('.calendar_start').val(picker.startDate.format('YYYY/MM/DD 00:00:00'));
	  $('.calendar_end').val(picker.endDate.format('YYYY/MM/DD 23:59:59'));
	  $('#calendar_form').submit();
  });
 $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
	  $('#calendar_clear_form').submit();
  });
  $('.clear_date').on('click',function(){
	  $('#calendar_clear_form').submit();
	});

});
</script>

