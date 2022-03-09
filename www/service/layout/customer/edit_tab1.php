          <section class="content">
  
           <div class="row">
                <div class="col-md-4">
              		<b>ชื่อ - นามสกุล <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="ชื่อ - นามสกุล" required="required" value="<?php echo $data['name']; ?>" data-tab="#tab1"  >
                        <input type="hidden" name="customer_id" value="<?php echo $_GET['id']; ?>">
    				</div>
                </div>
                <div class="col-md-4">
              		<b>เบอร์ติดต่อ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                        <input type="text" name="tel" class="form-control" placeholder="เบอร์ติดต่อ" required="required" value="<?php echo $data['tel']; ?>" data-tab="#tab1"  >
                       
    				</div>
                </div>
                <div class="col-md-4">
              		<b>อีเมล</b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" name="email" class="form-control" placeholder="อีเมล" value="<?php echo $data['email']; ?>" data-tab="#tab1"  >
                     
    				</div>
                </div>

            </div>
 

            </section>