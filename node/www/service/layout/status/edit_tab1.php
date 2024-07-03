          <section class="content">
  
           <div class="row">
                <div class="col-md-4">
              		<b>สถานะ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-flag"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="สถานะ" required="required" value="<?php echo $data['status_name']; ?>" data-tab="#tab1"  >
                        <input type="hidden" name="status_id" value="<?php echo $_GET['id']; ?>">
    				</div>
                </div>
                
                <div class="col-md-4">
              		<b>รหัส <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-flag-o"></i></span>
                        <input type="text" name="code" class="form-control" placeholder="รหัส" required="required" value="<?php echo $data['status_code']; ?>" data-tab="#tab1"  >
                      
    				</div>
                </div>
                
                <div class="col-md-4">
              		<b>ค่าเริ่มต้น</b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><input type="checkbox" class="default_check"<?php if($data['status_begin']==1){ echo 'disabled="disabled"';} ?> name="default" <?php if($data['status_begin']==1){ echo 'checked="checked"';} ?>></span>
                        <input type="text" name="default_dis" class="form-control <?php if($data['status_begin']==1){ echo 'default_active';} ?>" placeholder="กำหนดสถานะนี้เป็นค่าเริ่มต้น" disabled="disabled" value="กำหนดสถานะนี้เป็นค่าเริ่มต้น" data-tab="#tab1"  >
                        
    				</div>
                </div>

            </div>
 
            <div class="row">
                <div class="col-md-12">
                    <b>หมายเหตุ</b>
                    <div class="form-group">
                        <textarea name="note" class="form-control" placeholder="หมายเหตุ" data-tab="#tab1" style="max-width:100%; min-width:100%; min-height:100px" ><?php echo $data['status_description']; ?></textarea>
                    </div>
                </div>
            </div> 
            </section>