
<div class="box">
<div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-fw fa-bullhorn"></i> <?php echo $data['list_title'];?></h3>


                </div>


<div class="box-body">
                
             
<div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th class="text-center" width="40">ลำดับ</th>
                    <th>รายการ</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
		$list_arr=json_decode($data['list_text']);
						foreach($list_arr as $i=>$list){
							if($list==''){ continue; }
?>
                <tr>
                  <td class="text-center"><?php echo ($i);?></td>
                  <td><?php echo $list;?></td>

                </tr>
<?php
		}
	

?>
                  </tbody>
                </table>
              </div>

</div>
              <div class="box-footer">
              <?php
			  if(trim($data['note'])!=''){
				  echo '<span style="color:red">หมายเหตุ:</span><br/>'.nl2br($data['note']);
			  }
			  ?>
<div class="box-tools pull-right">
                 
                  
                  </div>
              </div>
 </div>      
 
 
 <div class="box">
<div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-fw fa-photo"></i> รูป</h3>


                </div>


<div class="box-body">
                
    <ul class="users-list clearfix">         
                         <?php 
						 if($data['images']!=''){
							$images_arr=json_decode($data['images']);
							
							foreach($images_arr->img as $i=>$image){
								
							?>

                    <li>
                      <a data-fancybox="gallery" href="<?php echo str_replace('|','/',$image); ?>"><img src="<?php echo str_replace('|','/thumb/',$image); ?>" width="auto" height="auto" style="border-radius: 0;"></a>
                     
                      
                    </li>

                 
                            
                            <?php
							}
						 }
							?>
 				</ul>
</div>

       
 </div>           
					<?php if($usertype=='1'||in_array("edit_list", $perm_data)){ ?>
                  <button type="button" onclick="location.href='index.php?option=edit_list&itemid=2&id=<?php echo $_GET['id']; ?>'" class="btn bg-blue btn-sm "><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;แก้ไข</button>
                  <?php } ?>
                  <?php if($usertype=='1'||in_array("del_list", $perm_data)){ ?>
                  <button type="button" class="btn bg-red btn-sm del_product i-del2" data-id="<?php echo $data['id'];?>" data-image="<?php echo htmlspecialchars($data['images']);?>"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;ลบ</button>
                  <?php } ?>
                  <a href="print.php?id=<?php echo $_GET['id']; ?>" class="btn bg-purple btn-sm" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;พิมพ์</a>
                  <div class="box-tools pull-right">
<button onclick="location.href='index.php?option=list&itemid=2'" type="button" class="btn btn-default btn-sm i-del del_product_all">ย้อนกลับ</button>
                  </div>
       

