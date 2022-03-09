          <section class="content">
  
           <div class="row">
                <div class="col-md-12">
              		<b>หมวดหมู่ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="หมวดหมู่" required="required" value="<?php echo $data['category_name']; ?>" data-tab="#tab1"  >
                        <input type="hidden" name="category_id" value="<?php echo $_GET['id']; ?>">
    				</div>
                </div>
                
      

            </div>
 
            <div class="row">
                <div class="col-md-12">
                    <b>หมายเหตุ</b>
                    <div class="form-group">
                        <textarea name="note" class="form-control" placeholder="หมายเหตุ" data-tab="#tab1" style="max-width:100%; min-width:100%; min-height:100px" ><?php echo $data['category_description']; ?></textarea>
                    </div>
                </div>
            </div> 
            </section>