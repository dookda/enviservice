
                    <div class="add_property">
                        <form role="form" id="add_user_form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                	<div>
                        <input name="name" type="text" class="form-control" placeholder="ชื่อ - นามสกุล" required="required">
                    </div>
                 </div>

                <div class="form-group">
                    <div>
                        <div><input name="User" type="text" class="form-control" id="user_login" placeholder="ชื่อผู้ใช้ (Username)" required="required"> </div> 
                    </div>
                </div>
                <div class="form-group">
                	<div>
                        <input name="Pass" type="password" class="form-control" id="pass_login" placeholder="รหัสผ่าน" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                    	<input name="confirm_Pass" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required="required">
                    </div>
                </div>
                
                <div class="form-group">
                	<div>

                    		<div><input name="Email" type="email" placeholder="อีเมล" class="form-control" required="required"> </div>
                    	
                    </div>
                </div>
                <?php include('perm_input.php'); ?>

                        <div class="modal-footer clearfix foot2">
                     	 <button type="submit" class="btn btn-success pull-right save_button"><i class="fa fa-spinner fa-spin fa-fw " style="display:none"> </i>บันทึก</button>
                      		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
              			</div>
              	</form>
               </div>
         
          <script>

jQuery(document).ready( function($) {
	
	$('.m_list2').on('click',function(){
		console.log($(this).prop('checked'));
		if($(this).prop('checked')==true){
		$('.m_cus1, .m_cus2').prop('checked','checked');
		}
	});
	$('.m_cus1, .m_cus2').on('click',function(){
		var m_list2=$('.m_list2').prop('checked');
		var m_cus1_2=$(this).prop('checked');
		if(m_cus1_2==false&&m_list2==true){
		$('.m_list2').prop('checked',false);
		}
	});
	$('.m_cus1, .m_list1').on('click',function(){
		
		var m_input=$(this).prop('checked');
		var name= $(this).attr('name');
		if(m_input==false){
		$('input[name="'+name+'"]').prop('checked',false);
		}
	});

	 var options = { 
	    url: 'layout/member/save.php', 
		dataType:'json',
		beforeSubmit:  function(){
	   		$('.save_button').attr('disabled','disabled');
			$('.save_button i').show();
			}, 
		success:   function(data) {

		if(data.status){
				switch(data.status){
				case'1':	
					alert('เพิ่มข้อมูลเรียบร้อยแล้ว');
					location.reload();
					break;	
				case'2':	
					alert('รหัสผ่านไม่ตรงกัน');
					break;	
				case'3':	
					alert('อีเมล มีอยู่ในระบบแล้ว');
					break;	
				case'4':	
					alert('ชื่อผู้ใช้ มีอยู่ในระบบแล้ว');
					break;	
				case'5':	
					alert('รหัสผ่านน้อยกว่า 4 ตัวอักษร');
					break;
				default:
					alert(data.status);
					break;
				}
				if(data.status!='1'){
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
	$('#add_user_form').ajaxForm(options);


});
</script>