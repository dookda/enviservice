<div class="box">

<div class="box-header with-border">
                  <h3 class="box-title">ประวัติการใช้บริการ</h3>

                </div>        
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="table-responsive">
                <div class="row" style=" margin-right: 0; margin-left: 0; ">
                <div class="col-md-12">
              <table id="list_table" class="table table-bordered table-striped dataTable no-margin" role="grid" aria-describedby="example1_info">
                <thead>
                <tr>
                	<th>หัวข้อ</th>
                    <th>หมวดหมู่</th>
                    <th>สถานะ</th>
                    <th>วันที่รับงาน</th>
                </tr>
                	</thead>
                <tbody>
                

                
<?php
	if($nums!=0){
		while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))	{
?>
                <tr>
                  <td><a href="index.php?option=list_detail&itemid=2&id=<?php echo $data['id'];?>"><?php echo $data['list_title'];?></a></td>
                  <td><?php echo $data['category_name'];?></td>
                  <td><?php echo $data['status_name'];?></td>
                  <td><?php echo $data['addDate'];?></td>
                </tr>
<?php
		}
	}

?>
                </tbody>

              </table>
              
              
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
         
          
					<?php if($usertype=='1'||in_array("edit_cus", $perm_data)){ ?>
                  <button type="button" onclick="location.href='index.php?option=edit_customer&itemid=5&id=<?php echo $_GET['id']; ?>'" class="btn bg-blue btn-sm "><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;แก้ไข</button>
                  <?php } ?>
                  <?php if($usertype=='1'||in_array("del_cus", $perm_data)){ ?>
                  <button type="button" class="btn bg-red btn-sm del_product i-del2" data-id="<?php echo $data['id'];?>" data-image="<?php echo htmlspecialchars($data['images']);?>"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;ลบ</button>
                  <?php } ?>
                     <div class="box-tools pull-right">
<button onclick="location.href='index.php?option=customer&itemid=5'" type="button" class="btn btn-default btn-sm i-del del_product_all">ย้อนกลับ</button>
                  </div>
                   
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#list_table").DataTable();

  });
</script>