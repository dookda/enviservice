          <section class="content">
           <div class="row">
                <div class="col-md-12">
              		<b>หมวดหมู่ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-list-alt"></i></span>
                        <select class="form-control" name="category" style="width: 100%;" data-tab="#tab1" required>
                  <option value="">เลือกหมวดหมู่</option>
                        <?php 
						

						foreach($main->GetAllCategory() as $cat){
							if($data['list_category']==$cat['id']){
								echo '<option value="'.$cat['id'].'" selected>'.$cat['category_name'].'</option>';
							}else{
								echo '<option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
							}
						}
						?>
                </select>

    				</div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-12">
              		<b>สถานะ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-flag" aria-hidden="true"></i></span>
                        <select class="form-control" name="status" style="width: 100%;" data-tab="#tab1" required>
                  <option value="">เลือกสถานะ</option>
                        <?php 
						

						foreach($main->GetAllStatus() as $status){
							if($data['list_status']==$status['status_code']){
								echo '<option value="'.$status['status_code'].'" selected>'.$status['status_name'].'</option>';
							}else{
								echo '<option value="'.$status['status_code'].'">'.$status['status_name'].'</option>';
							}
						}
						?>
                </select>
                <input type="hidden" value="<?php echo $data['list_status']; ?>" name="oldstatus" />

    				</div>
                </div>

            </div>     
           <div class="row">
                <div class="col-md-12">
              		<b>หัวข้อ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-bookmark"></i></span>
                        <input type="text" name="title" class="form-control" placeholder="หัวข้อ" required="required" value="<?php echo $data['list_title']; ?>" data-tab="#tab1"  >
                        <input type="hidden" name="list_id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $data['customer_id']; ?>">
                        <input type="hidden" name="date" value="<?php echo $data['addDate']; ?>">
    				</div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-12">
              		<b>เพิ่มรายการ <span class="c_red">*</span></b>
                    <div class="input-group">
                    	<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <input type="text" name="list[]" class="form-control list_input" placeholder="ข้อความ" data-tab="#tab1"  >
                        <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-flat addlist">เพิ่ม</button>
                    </span>
                </div>
                    <div id="list_area" class="form-group ui-sortable" style=" background: #eee; padding: 15px; margin-top: 10px; ">
                    
    					<?php 
						$list_arr=json_decode($data['list_text']);
						foreach($list_arr as $i=>$list){
							if($list==''){ continue; }
							?>
							
<div style=" border-bottom: 2px solid #eeeeee;     background: #fff; padding: 10px; position: relative;" class="ui-state-default list_data" id="list<?php echo ($i-1); ?>"><span style="right: 5px; top: 8px;" class="img_close" onclick="$(this).dellist('list<?php echo ($i-1);?>')" ><i class="fa fa-times"></i></span><?php echo $list; ?><input type="hidden" name="list[]" value="<?php echo $list; ?>"/></div>
                            <?php
						}
						?></div>
                    </div>
            </div>
           <div class="row">
                <div class="col-md-12">
                    <div class="problock" style=" padding: 10px; background: #eee; margin-bottom: 8px; ">
                        <div class="form-group imgarea">
                            <b>รูป</b><small> (รองรับไฟล์ jpg, jpeg, png, gif) </small>                        
                            <div class="showimg">
                                <div class="pull-left">
                    <?php
                        $lastinputid=0;
                        if($data['images']!=''){
                            $lastinputid=count(json_decode($data['images'])->img);
							
                        }
                    ?>
                                    <input data-tab="#tab1" type="file" name="file[]" id="file[]" class="imgup2" placeholder="รูป" onchange="$(this).setimg()" data-id="<?php echo $lastinputid; ?>"/>
                                </div>
                             </div>
                        </div>
                        <div class="form-group clearfix" style="overflow:auto">
                            <div id="sortable">
                         <?php 
						 if($data['images']!=''){
							$images_arr=json_decode($data['images']);
							
							foreach($images_arr->img as $i=>$image){
								
							?>
<div class="pull-left ui-state-default imgorder_block img<?php echo $i; ?>"><span class="img<?php echo $i; ?>" onclick="$(this).delimg()" data-id="img<?php echo $i; ?>" data-img="<?php echo $i; ?>" data-name="<?php echo $image; ?>"><span class="img_close"><i class="fa fa-times"></i></span></span><img src="<?php echo str_replace('|','/thumb/',$image); ?>" width="auto" height="70"><input type="hidden" name="imgorder[]" value="oimg<?php echo $i; ?>" data-name="<?php echo $image; ?>">

					
                                                
                                                <input type="hidden" name="old_img[]" value="<?php echo $image; ?>" class="img<?php echo $i; ?>"/>
</div> 
                            
                            <?php
							}
							}
							?>
                        </div> 
                         </div> 
                        
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <b>หมายเหตุ</b>
                    <div class="form-group">
                        <textarea name="note" class="form-control" placeholder="หมายเหตุ" data-tab="#tab1" style="max-width:100%; min-width:100%" ><?php echo $data['note']; ?></textarea>
                    </div>
                </div>
            </div> 
            </section>