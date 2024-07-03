          <section class="content">
           <div class="row">
                <div class="col-md-12">
              		<b>หมวดหมู่ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-list-alt"></i></span>
                        <select class="form-control" name="category" style="width: 100%;" data-tab="#tab1" required>
                  <option value="">เลือกหมวดหมู่</option>
                        <?php 
						
;
			
						foreach($main->GetAllCategory() as $cat){
							echo '<option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
						}
						?>
                </select>

    				</div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-12">
              		<b>หัวข้อ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa  fa-bookmark"></i></span>
                        <input type="text" name="title" class="form-control" placeholder="หัวข้อ" required="required" data-tab="#tab1"  >
    				</div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-12">
              		<b>เพิ่มรายการ <span class="c_red">*</span></b>
                    <div class="input-group">
                    	<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <input type="text" name="list[]" class="form-control list_input" placeholder="ข้อความ" required="required" data-tab="#tab1"  >
                        <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-flat addlist">เพิ่ม</button>
                    </span>
                </div>
                    <div id="list_area" class="form-group" style=" background: #eee; padding: 15px; margin-top: 10px; "></div>
    				
                    </div>
            </div>
           <div class="row">
                <div class="col-md-12">
                    <div class="problock" style=" padding: 10px; background: #eee; margin-bottom: 8px; ">
                        <div class="form-group imgarea">
                            <b>รูป</b><small> (รองรับไฟล์ jpg, jpeg, png, gif) </small>                        
                            <div class="showimg">
                                <div class="pull-left">
                                    <input data-tab="#tab1" type="file" name="file[]" id="file[]" class="imgup2" placeholder="รูป" onchange="$(this).setimg()" data-id="0"/>
                                </div>
                             </div>
                        </div>
                        <div class="form-group clearfix" style="overflow:auto">
                            <div id="sortable"></div>   
                        </div> 
                        
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <b>หมายเหตุ</b>
                    <div class="form-group">
                        <textarea name="note" class="form-control" placeholder="หมายเหตุ" data-tab="#tab1" style="max-width:100%; min-width:100%" >  </textarea>
                    </div>
                </div>
            </div> 
            </section>