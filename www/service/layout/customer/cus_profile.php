<?php
$where=' WHERE `env_list`.`customer_id` = '.quote($_GET['id']);
$sql='SELECT `env_list`.*,
`env_customer`.`name`,
`env_customer`.`tel`,
`env_status`.`status_name`, 
`env_category`.`category_name`, 
`env_category`.`id` as catid 
FROM `env_list` 
LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id` 
LEFT JOIN `env_status` ON  `env_list`.`list_status` = `env_status`.`status_code` 
LEFT JOIN `env_category` ON  `env_list`.`list_category` = `env_category`.`id`
'.$where.' ORDER BY  `env_list`.`id` DESC';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
?>
  

                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                              <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/customer-128x128.jpg" alt="User Image">
                              </div>
                              <!-- /.widget-user-image -->
                             
                              <h3 class="widget-user-username"><?php echo $data['name']; ?></h3>
                              <h5 class="widget-user-desc">รหัสลูกค้า: <?php echo str_pad($data['id'],4,'0',STR_PAD_LEFT);?></h5>
                            </div>
                            <div class="box-footer no-padding">
                              <ul class="nav nav-stacked">
                                <li><a href="javascript:;">เบอร์ติดต่อ <span class="pull-right "><?php echo $data['tel']; ?></span></a></li>
                                <li><a href="javascript:;">อีเมล <span class="pull-right "><?php echo $data['email']; ?></span></a></li>
                                <li><a href="javascript:;">งานทั้งหมด <span class="pull-right badge bg-red"><?php echo $nums; ?></span></a></li>
                                <li><a href="javascript:;">วันที่ลงทะเบียน <span class="pull-right "><?php echo date('d M y',strtotime($data['registerDate']));?></span></a></li>
                                
                              </ul>
                            </div>
                          </div>
                          <!-- /.widget-user -->
  
 

