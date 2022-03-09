<style>
textarea{ width:100%; max-width:100%;  border: 1px solid #ccc;}
div#aioseop_snippet > h3 > a { color: #12c; text-decoration: none; }
div#aioseop_snippet > h3 { font-size: 16px; padding: 0; border: 0; background: inherit;     margin: 0; margin-bottom: 3px; }
div#aioseop_snippet > div > div > cite { color: #093; font-style: normal; }
.preview_snippet{padding: 10px; border: 1px solid #ccc;}
.c_red{ color:red;}
</style>
<section class="content-header">
          <h1>
            ตั้งค่า
          </h1>
<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">ตั้งค่า</li>
          </ol>
</section>
<section class="content"> 
<div class="box">



<div class="box-body">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
        <form class="form-horizontal setting_form" method="post" enctype="multipart/form-data">
          <div class="nav-tabs-custom">

            
            <div class="tab-content">

              <div class="active tab-pane" id="main">
<?php
	$main=new main();
	$data=$main->GetConfig();
	$logo=json_decode($data['logo'],true);
	$email=json_decode($data['email_setting'],true);


?>
   
                  <div class="form-group">
                    <label class="col-sm-2 control-label">โลโก้</label>

                    <div class="col-sm-10">
                <div class="form-group clearfix">
                    <div class="imgdelimg1" id="sortable">
                     <?php
                        if($logo!=''){
                            
                           
                                echo '<div class="pull-left ui-state-default imgorder_block img0"">
                                                        <span onclick="$(this).delimg()" style="display:none" class="img_close delimg dimgi0" data-id="img0" data-img="0"  data-name="'.$logo['img'][0].'"><i class="fa fa-times"></i></span>
                                                        <img src="'.str_replace('|','',$logo['img'][0]).'" alt="logo" style="max-width:100%;" >
                                                       <input type="hidden" name="imgorder[]" value="oimg0"/>
                                                <input type="hidden" name="old_img[]" value="'.$logo['img'][0].'" class="img0"/></div>';
                            
                        }
                    ?>
                	</div> 
                </div>
                <div class="form-group">
                    <small>(รองรับไฟล์ jpg, jpeg, png, gif)</small>
                    <div class="showimg"></div>
                    <?php
                        $lastinputid=0;
                        if($logo['img'][0]!=''){
                            $lastinputid=count($logo['img'][0])+1;
                        }
                    ?>
                    <input type="file" name="file[]" id="file[]" onchange="$(this).setimg()" data-id="<?php echo $lastinputid; ?>"/>
                </div>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อเว็บ <span class="c_red">*</span></label>

                    <div class="col-sm-10">
                      <input type="text" name="web_name" class="form-control" placeholder="ชื่อเว็บ" value="<?php echo $data['web_name']; ?>" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">URL</label>

                    <div class="col-sm-10">
                      <input type="text" name="url" class="form-control" placeholder="URL" value="<?php echo $data['url']; ?>" required="required">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">ที่อยู่ <span class="c_red">*</span></label>

                    <div class="col-sm-10">
                      <textarea name="web_address" class="form-control" placeholder="ที่อยู่" required="required"><?php echo $data['web_address']; ?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-2 control-label"><h4>การส่งเมล</h4></div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Host</label>

                    <div class="col-sm-10">
                      <input type="text" name="mail[]" class="form-control" placeholder="Host" value="<?php echo $email[0]; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">SMTPSecure</label>

                    <div class="col-sm-10">
                      <input type="text" name="mail[]" class="form-control" placeholder="SMTPSecure" value="<?php echo $email[1]; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" name="mail[]" class="form-control" placeholder="Username" value="<?php echo $email[2]; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="mail[]" class="form-control" placeholder="Password" value="<?php echo $email[3]; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Port</label>

                    <div class="col-sm-10">
                      <input type="text" name="mail[]" class="form-control" placeholder="Port" value="<?php echo $email['4']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อผู้ส่ง</label>

                    <div class="col-sm-10">
                      <input type="text" name="mail[]" class="form-control" placeholder="ชื่อผู้ส่ง" value="<?php echo $email[5]; ?>">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                      	<button type="submit" class="btn btn-danger save_button"><i class="fa fa-spinner fa-spin fa-fw " style="display:none"> </i>บันทึก</button>
                    </div>
                  </div>
                

              </div>
              <!-- /.tab-pane -->



            </div>
           
            <!-- /.tab-content -->
          </div></form>
          <!-- /.nav-tabs-custom -->
        </div> 
        <!-- /.col -->
      </div>
      <!-- /.row -->
</div>
</div>
</section>  
<script src="./plugins/iCheck/icheck.min.js"></script>
<script>
jQuery(document).ready( function($) {
  	   var options = { 
	 	url:'layout/setting/save.php',
		dataType:'json',
	    beforeSubmit:  function(arr, $form){
	   		$('.save_button').attr('disabled','disabled');
			$('.save_button i').show();
			}, 
		success:   function(data) {
		
				switch(data.status){
				case'OK':
					alert('บันทึกข้อมูลเรียบร้อยแล้ว');
					location.reload();
					break;	
				default:
					alert(data.status);
					break;
					$('.save_button').removeAttr('disabled');
					$('.save_button i').hide();
				}

			
				
			
	   },
       complete: function() {
		
	   },
       error: function(data) {
				alert('Error '+data.responseText);
					$('.save_button').removeAttr('disabled');
					$('.save_button i').hide();
	   }
	   };


	$('.setting_form').ajaxForm(options);
	
	$.fn.setimg= function() {

		var id=$(this).attr('data-id');
		var numfile=this[0].files.length;
		var nextid=parseInt(id)+parseInt(numfile);
		var checkfile=readURL(this[0],id);	
		if(checkfile===false){
			$(this).val('');
		}
	}
	$.fn.delimg= function() {	
	var imgclass=$(this).attr('data-id');
	$('.'+imgclass).remove();
	}
function readURL(input,data) {
	
		var numfile=input.files.length;
		var imgdata=[];
	for (i = 0; i < numfile; i++) {
	var ftype=input.files[i].type;
	if(ftype=='image/jpeg'||ftype=='image/pjpeg'||ftype=='image/png'||ftype=='image/gif'){
		
	}else{
		return false;	
	}
    if (input.files && input.files[i]) {
        var reader = new FileReader();

		var iall=numfile*2;
        reader.onload = function (e) {
	
           imgdata.push('<div class="pull-left ui-state-default imgorder_block img'+data+'"><span class="img_close img'+data+'" onClick="$(this).delimg()" style="display:none" data-id="img'+data+'" data-img="'+data+'"><i class="fa fa-times"></i></span><img src="'+e.target.result+'" width="auto" height="70"><input type="hidden" name="imgorder[]" value="'+data+'"/></div>');
			data++;
			numfile++;
			if(numfile==iall){
				$('#sortable .img_close').click();
				$('#sortable').prepend(imgdata);
			}
		}

        reader.readAsDataURL(input.files[i]);
    }
	}
}
	

});
</script>

