
  

                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                              <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/customer-128x128.jpg" alt="User Image">
                              </div>
                              <!-- /.widget-user-image -->
                              
                              <h3 class="widget-user-username"><?php echo $data['name']; ?></h3>
                              <h5 class="widget-user-desc">รหัสลูกค้า: <?php echo str_pad($data['cusid'],4,'0',STR_PAD_LEFT);?></h5>
                              
                            </div>
                            <div class="box-footer no-padding">
                              <ul class="nav nav-stacked">
                                <li><a href="javascript:;">เบอร์ติดต่อ <span class="pull-right "><?php echo $data['tel']; ?></span></a></li>
                                <li><a href="javascript:;">อีเมล <span class="pull-right "><?php echo $data['email']; ?></span></a></li>
                                
                              </ul>
                            </div>
                          </div>
                          <!-- /.widget-user -->
                          
                          
                          
		<div class="row">
        

            
        <div class="col-md-12">
			<div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">No.</span>
              <span class="info-box-number"><?php echo str_pad($_GET['id'],4,'0',STR_PAD_LEFT);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
        	<div class="col-md-12">
                <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa  fa-flag" aria-hidden="true"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">สถานะ</span>
                  <span class="info-box-number"><?php echo $data['status_name'];?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            	
            </div>
            
        	<div class="col-md-12">
                <div class="info-box">
                <span class="info-box-icon label-primary"><i class="fa  fa-calendar" aria-hidden="true"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">วันที่รับงาน</span>
                  <span class="info-box-number"><?php echo date("d/m/Y",strtotime($data['addDate']));?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            	
            </div>
            
        	<div class="col-md-12">
                <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">หมวดหมู่</span>
                  <span class="info-box-number"><?php echo $data['category_name'];?></span>
                </div>
                <!-- /.info-box-content -->
              </div> 
           
            </div>

        	
    	</div>
        
 

