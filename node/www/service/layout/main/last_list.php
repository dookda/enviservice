<?php
	$where="";
	$nums_list_all=0;
	$sql='SELECT `env_list`.`id`, `env_list`.`list_title`, `env_list`.`addDate`,
	`env_customer`.`name`
	FROM `env_list` 
	LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id` 
	LEFT JOIN `env_status` ON  `env_list`.`list_status` = `env_status`.`status_code` 
	LEFT JOIN `env_category` ON  `env_list`.`list_category` = `env_category`.`id`
	'.$where.'ORDER BY  `env_list`.`addDate` DESC';
	$result=mysqli_query($ConnectDB,$sql);
	$nums_list_all = mysqli_num_rows($result);
?> 
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">รายการล่าสุด</h3>

                  <div class="box-tools pull-right">
                  <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="ทั้งหมด <?php echo $nums_list_all; ?> รายการ"><?php echo $nums_list_all; ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
<div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>หัวข้อ</th>
                    <th>ลูกค้า</th>
                    <th>วันที่รับงาน</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
	$where="";
	$sql='SELECT `env_list`.`id`, `env_list`.`list_title`, `env_list`.`addDate`,
	`env_customer`.`id` as `cusid`, `env_customer`.`name`
	FROM `env_list` 
	LEFT JOIN `env_customer` ON  `env_customer`.`id` = `env_list`.`customer_id` 
	LEFT JOIN `env_status` ON  `env_list`.`list_status` = `env_status`.`status_code` 
	LEFT JOIN `env_category` ON  `env_list`.`list_category` = `env_category`.`id`
	'.$where.'ORDER BY  `env_list`.`addDate` DESC LIMIT 0,10';
	$result=mysqli_query($ConnectDB,$sql);
	$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>
                  <tr>
                    <td><a href="index.php?option=list_detail&itemid=2&id=<?php echo $data['id'];?>"><?php echo str_pad($data['id'],4,'0',STR_PAD_LEFT);?></a></td>
                    <td><a href="index.php?option=list_detail&itemid=2&id=<?php echo $data['id'];?>"><?php echo $data['list_title'];?></a></td>
                    <td><a href="index.php?option=customer_detail&itemid=5&id=<?php echo $data['cusid'];?>"><?php echo $data['name'];?></a></td>
                    <td>
                      <?php echo date('d/m/Y',strtotime($data['addDate']));?>
                    </td>
                  </tr>
<?php
		}
	}

?>
                  </tbody>
                </table>
              </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="index.php?option=list&itemid=2">ดูทั้งหมด</a>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->