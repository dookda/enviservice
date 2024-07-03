<link rel="stylesheet" href="plugins/iCheck/flat/green.css">
<script src="plugins/iCheck/icheck.min.js"></script>



<?php

if($usertype=='1'){}else{ die('ไม่อนุญาตให้เข้าถึงข้อมูลนี้');}

	

$sql2='SELECT * FROM `env_category`';
$result=mysqli_query($ConnectDB,$sql2);
$nums2 = mysqli_num_rows($result);

$Num_Rows = $nums2;
if(isset($_SESSION['cur_number4'])){
	$Per_Page = $_SESSION['cur_number4'];   // Per Page
}else{
	$Per_Page = 20;   // Per Page
}
if(!isset($_GET["Page"])){$Page=1;}else{$Page = $_GET["Page"];	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page){$Num_Pages =1;}else if(($Num_Rows % $Per_Page)==0){$Num_Pages =($Num_Rows/$Per_Page) ;}
else{$Num_Pages =($Num_Rows/$Per_Page)+1;$Num_Pages = (int)$Num_Pages;}

$sql='SELECT * FROM `env_category` ORDER BY `id` DESC LIMIT '.$Page_Start .','. $Per_Page;
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
?>

<section class="content-header">
          <h1>
           จัดการหมวดหมู่

           <small><span class="label label-success"><?php echo $Num_Rows; ?> รายการ</span></small> 
                                      
                  
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">จัดการหมวดหมู่</li>
          </ol>
</section>
<section class="content st-data"> 
<div class="row">
            <div class="col-md-12">
              <div class="box">

                <div class="box-body no-padding">
                
              <div class="mailbox-controls">

                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm label-success create_post" data-toggle="modal" data-target="#myModalp"><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่มหมวดหมู่</button>    
                  </div>
                  
                  <div class="btn-group">
                	<button type="button" class="btn btn-default btn-sm i-del del_product_all"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;ลบหมวดหมู่</button>
                <form id="st_del" name="stdel" method="post" enctype="multipart/form-data">
                <div class="postinput"></div>
                </form>
                <form id="st_active" name="stactive" method="post" enctype="multipart/form-data">
                <div class="activeinput"></div>
               
                </form>
                  </div>   
                  
        
            

                  <div class="pull-right">

           
                     
                   <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if(isset($_SESSION['cur_number4'])){
							  switch($_SESSION['cur_number4']){
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
                    <th width="50">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                	</th>
                      <th width="100">จัดการ</th>
                      <th>หมวดหมู่</th>

                      <th>หมายเหตุ</th>

                     
                 
                    </tr>
<?php
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
	
?>
                    <tr>
                    	
                    	<td align="center" width="50">
<form class="articleactive_form" id="articleactive<?php echo $data['id']; ?>" name="articleactive<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
							
                      <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

                            </form>
<?php
$pdf_file='';
							
?>     					
                        <input type="checkbox" data-id="<?php echo $data['id'];?>">
                       
                        
                        </td>
					
                      <td >
                          <div class="btn-group">
                           
                            <button type="button" class="btn bg-blue btn-xs showdata" data-id="<?php echo $data['id']; ?>"><i class="fa fa-edit"></i></button>
                            
   		
                            <button class="btn btn-default btn-xs del_product i-del2" data-id="<?php echo $data['id']; ?>"><i class="fa fa-trash-o"></i></button>
                      
                          </div>
                      </td>
                     <td><div class="showdata" data-id="<?php echo $data['id']; ?>" style="cursor:pointer"><?php echo $data['category_name'];?></div></td>
                      
 					
              <td><?php echo $data['category_description'];?></td>

  
                       
     
                      
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
                    $pages->url_next = $_SERVER["PHP_SELF"]."?option=manage_category&itemid=4&Page=";
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
		$('.modal-body').load('layout/category/setdata.php?id='+data);	
	});
	$('.showdata').click(function(){
		var data=$(this).attr('data-id');
		location.href='index.php?option=edit_category&itemid=4&id='+data;	
	});
	$('.create_post').click(function(){	
		location.href='index.php?option=add_category&itemid=4';	
	});
		
	$('.i-refresh').click(function(){
		window.location.reload();
	});
	$('.fa-close').on("click", function(){
		location.href="index.php?option=manage_category&itemid=4";
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
	 
		url:'layout/category/del.php',
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
	 
		url:'layout/category/SetCategory.php',
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
	 
		url:'layout/status/active.php',
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
	$('.btn-default[class*="i-default"]').click(function(){
		var id=$(this).attr('data-id');
		$('.activeinput').html('<input type="hidden" name="id" value="'+id+'">');
		$('#st_active').ajaxForm(active);
		$('#st_active').submit();
	});




});
</script>

