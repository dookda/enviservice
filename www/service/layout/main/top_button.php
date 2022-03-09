<div class="row">
<?php
$bg_arr=array('bg-aqua','bg-green','bg-yellow','bg-red');
$sql='SELECT `env_category`.`category_name`, `env_list`.`list_category`, COUNT(`env_list`.`list_category`) as `listnum` FROM `env_list` LEFT JOIN `env_category` ON `env_list`.list_category = `env_category`.`id` GROUP BY `env_list`.`list_category` ORDER BY `listnum` DESC LIMIT 0,4';
$result=mysqli_query($ConnectDB,$sql);
$nums = mysqli_num_rows($result);
$i=0;
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box <?php echo $bg_arr[$i]; ?>">
            <div class="inner">
              <h3><?php echo $data['listnum']; ?></h3>

              <p><?php echo $data['category_name']; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
            </div>
            <a href="index.php?option=list&itemid=2&catid=<?php echo $data['list_category']; ?>" class="small-box-footer">ดูรายการ</a>
          </div>
        </div>
        <!-- ./col -->
 
        <?php
		$i++;
		}
	}
		?>
        <!-- ./col -->
      </div>