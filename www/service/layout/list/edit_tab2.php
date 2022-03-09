<div class="row">
	<div class="col-md-12">
    	<div class="problock">

            <div class="row">
                <div class="col-md-6">
                    <b>ชื่อ - นามสกุล <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" class="form-control find_name" placeholder="ชื่อ - นามสกุล" autocomplete="off"  required="required" data-tab="#tab1" disabled="disabled" value="<?php echo $data['name']; ?>"  >
    
                    </div>
                    <div id="name_area"></div>
                </div>
                <div class="col-md-6">
                    <b>เบอร์ติดต่อ <span class="c_red">*</span></b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                        <input type="tel" name="tel" class="form-control tel_input" placeholder="เบอร์ติดต่อ" required="required" disabled="disabled" data-tab="#tab1" value="<?php echo $data['tel']; ?>" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b>อีเมล</b>
                    <div class="form-group input-group">
                    	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control email_input" placeholder="อีเมล" disabled="disabled" data-tab="#tab1" value="<?php echo $data['email']; ?>" >
    
                    </div>
                </div>

            </div> 

            
       </div>

        
        
    

 
    </div>
</div>