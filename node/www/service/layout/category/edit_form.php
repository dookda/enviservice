<?php
if($usertype=='1'){}else{ die('ไม่อนุญาตให้เข้าถึงข้อมูลนี้');}

?>
<style>
.item{    padding: 5px 0 5px;}
.c_red{ color:red;}
.default_active{    background: #00a65a !important;   color: #fff;}
</style>
<section class="content-header">
          <h1>
            แก้ไขหมวดหมู่
                           </h1>
          
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">แก้ไขหมวดหมู่</li>
          </ol>
</section>
<section class="content">
<?php
$where=" WHERE `id` = '".quote($_GET['id'])."' ";
$sql='SELECT * FROM `env_category`'.$where.' LIMIT 0,1';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>
<div class="row">
        <div class="col-md-12">
        
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
<form role="form" id="add_service_form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">

    				<?php include('edit_tab1.php'); ?>
              	</div>   
      

              </div>  
        	<div class="box-body text-right">
            
               <div class="btn-group"><p><button type="submit" class="btn btn-success save_button"><i class="fa fa-spinner fa-spin fa-fw " style="display:none"> </i>บันทึก</button></p></div> 
               <div class="btn-group"><p><button type="button" class="btn btn-default button_close">ย้อนกลับ</button></p></div> 
         
                
                </div>
                            <div class="modal-footer clearfix foot2">

                            </div>
</form>
<form role="form" id="find_customer" method="post" enctype="multipart/form-data">
</form>
        	</div>
        
        </div>
        
        
        </div>
      </div>
<?php
		}
	}
?>
</section>
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="plugins/jQueryUI/jquery.ui.touch-punch.min.js"></script>
          <script>

jQuery(document).ready( function($) {
	$('.default_check').change(function() {
		$('input[name="default_dis"]').toggleClass('default_active');
	});
	$('.find_name').on('keyup',function(){
		var keyword=$(this).val();
		$('#find_customer').html('<input type="hidden" name="keyword" value="'+keyword+'"/>');
		$('#find_customer').submit();
	});
	
	$('.addlist').on('click',function(){
		var text=$('.list_input').val();
		var list_data_num = $('.list_data').length;
		if(text!=''){
			
			$('#list_area').append('<div style=" border-bottom: 1px solid #e6e6e6; padding: 10px 5px; position: relative;" class="list_data" id="list'+list_data_num+'"><span style="right: 5px; top: 8px;" class="img_close" onclick="$(this).dellist(\'list'+list_data_num+'\')" ><i class="fa fa-times"></i></span>'+text+'<input type="hidden" name="list[]" value="'+text+'"/></div>');
			$('.list_input').val('');
			$('.list_input').removeAttr('required');
		}else{
			$('.list_input').focus();
		}
	});
	$.fn.dellist= function(listclass) {	
	
	$('#'+listclass).remove();
	var list_data_num = $('.list_data').length;
		if(list_data_num==0){
			$('.list_input').prop('required',true);		
		}
	}
	$.fn.select_customer= function(id) {	
	var email = $(this).attr('data-email');
	var tel = $(this).attr('data-tel');
	var name = $(this).attr('data-name');
	$('.find_name').val(name);
	$('.tel_input').val(tel);
	$('.email_input').val(email);
	$('#name_area').html('');
	$('input[name="customer_id"]').remove();
	$('#add_service_form').append('<input type="hidden" name="customer_id" value="'+id+'"/>');
	}

	 var find_customer = { 
	    url: 'layout/list/find_customer.php', 
		dataType:'json',
		beforeSubmit:  function(){
	
			}, 
		success:   function(data) {

		if(data){
			
			
				$('#name_area').html(data.name);
				$('input[name="customer_id"]').remove();
			
		}
			
		
	   },
       complete: function() {
		
	   },
       error: function(data) {
			alert(data.responseText);
	   }
	   };
	   
	 $('#find_customer').ajaxForm(find_customer);
	 
	 var options = { 
	    url: 'layout/category/edit.php', 
		dataType:'json',
		beforeSubmit:  function(){
	   		$('.save_button').attr('disabled','disabled');
			$('.save_button i').show();
			}, 
		success:   function(data) {

		if(data){
			if(data.status=='OK'){
				alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				location.href="index.php?option=manage_category&itemid=4";
			}else{
				alert(data.status);
				$('.save_button').removeAttr('disabled');
				$('.save_button i').hide();
			}
		}
			
		
	   },
       complete: function() {
		
	   },
       error: function(data) {
			alert(data.responseText);
			$('.save_button').removeAttr('disabled');
			$('.save_button i').hide();
	   }
	   };
	   $('.save_button').bind('click',function(event){ /* Check input required NULL*/
	   		$(this).attr('disable','disable');
			$('.tab-pane:hidden input[required="required"]').each(function(){
				var checkvisable=0;
				$('.tab-pane:visible input[required="required"]').each(function(){
					if($(this).val()==''){checkvisable++;}
				});
				
				
				if($(this).val()==''&&checkvisable==0){
					
					var tabid= $(this).attr('data-tab');
					$('a[href="'+tabid+'"]').click();
					$(this).focus();
					event.preventDefault();
					return false;
				}
			});
	   });



	$('#add_service_form').ajaxForm(options);
	$('.button_close').on("click", function(){
	
	location.href="index.php?option=manage_category&itemid=4";
	});

function readURL(input,data,ior) {
	
		var numfile=input.files.length;
		
	for (i = 0; i < numfile; i++) {
    if (input.files && input.files[i]) {
        var reader = new FileReader();

        reader.onload = function (e) {
	
            $('#sortable').prepend('<div class="pull-left ui-state-default imgorder_block img'+data+'"><span class="img'+data+'" onClick="$(this).delimg()" data-id="img'+data+'" data-img="'+data+'"><span class="img_close"><i class="fa fa-times"></i></span></span><img src="'+e.target.result+'" width="auto" height="70"><input type="hidden" name="imgorder[]" value="'+data+'"/></div>');
			ior.appendTo('.img'+data);
			ior.remove();
			data++;
        }

        reader.readAsDataURL(input.files[i]);
    }
	}
}


	$.fn.delimg= function() {	
	var imgclass=$(this).attr('data-id');
	$('.'+imgclass).remove();
		var name=$(this).attr('data-name');
		if(typeof name==='undefined'){ }else{
			$('#sortable').append('<input type="hidden" name="del_img[]" value="'+name+'">');
		}
	}


	$( "#sortable" ).sortable();

	$( "#sortable" ).disableSelection();
	

	$.fn.setimg= function() {
		$(this).hide();	
		var id=$(this).attr('data-id');
		var numfile=this[0].files.length;
		var nextid=parseInt(id)+parseInt(numfile);
		var checkfile=readURL(this[0],id,$(this));	
		
		
$('.showimg').prepend('<div class="pull-left"><input type="file" name="file[]" id="file[]" class="imgup2" placeholder="รูป" onchange="$(this).setimg()" data-id="'+nextid+'"/></div>');
		if(checkfile===false){
			$(this).val('');
			
		}
		var oldimg_num = $('input[name="old_img[]"]').length;
		
		if(oldimg_num>0){
		$( "#sortable" ).sortable( "disable" );
		}
	}

	  

	});
</script>
