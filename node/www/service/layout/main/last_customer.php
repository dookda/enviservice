<?php
$nums_cus_all=0;
$sql='SELECT * FROM `env_customer` ORDER BY `id` DESC';
$result=mysqli_query($ConnectDB,$sql);
$nums_cus_all = mysqli_num_rows($result);

?>
           <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">ลูกค้าล่าสุด</h3>

                  <div class="box-tools pull-right">
          <span data-toggle="tooltip" title="" class="badge label-danger" data-original-title="ทั้งหมด <?php echo $nums_cus_all; ?> ท่าน"><?php echo $nums_cus_all; ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
<?php
$sql='SELECT * FROM `env_customer` ORDER BY `id` DESC LIMIT 0,8';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>
                    <li>
                      <a href="index.php?option=customer_detail&itemid=5&id=<?php echo $data['id']?>"><img src="dist/img/customer-128x128.jpg" alt="User Image"></a>
                      <a class="users-list-name" href="index.php?option=customer_detail&itemid=5&id=<?php echo $data['id']?>"><?php echo $data['name']?></a>
                      <span class="users-list-date"><?php echo date('d M y',strtotime($data['registerDate']));?></span>
                    </li>
<?php
		}
	}

?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="index.php?option=customer&itemid=5">ดูทั้งหมด</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
