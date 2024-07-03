<div class="row">
<div class="col-md-12">
          <div class="box box box-primary">
            <div class="box-header">
              

  
            </div>
            <div class="box-body pad table-responsive">
<?php if($usertype=='1'){ ?> 
<a href="index.php?option=student&itemid=7" class="btn btn-app">
                <i class="fa fa-th-list"></i> ข้อมูลนักศึกษา
              </a>
<a href="index.php?option=personnel&itemid=6" class="btn btn-app">
                <i class="fa fa-th-list"></i> ข้อมูลบุคลากร
              </a>
<a href="index.php?option=alumni&itemid=5" class="btn btn-app">
                <i class="fa fa-th-list"></i> ข้อมูลศิษย์เก่า
              </a>
<?php } ?>
<a href="index.php?option=news&itemid=2" class="btn btn-app">
				<i class="fa fa-file-text" aria-hidden="true"></i> ข่าวสาร
              </a>
<a href="index.php?option=activities&itemid=3" class="btn btn-app">
                <i class="fa fa-cubes" aria-hidden="true"></i> กิจกรรม
              </a>
<?php if($usertype=='1'){ ?>

<a href="index.php?option=slide&itemid=9" class="btn btn-app">
                <i class="fa fa-photo"></i> สไลด์
              </a>
<a href="index.php?option=member&itemid=4" class="btn btn-app">
                <i class="fa fa-users"></i> สมาชิก
              </a>
<a href="#" class="btn btn-app">
                <i class="fa fa-gear"></i> ตั้งค่า
              </a>
<?php } ?>
            </div>
            </div>
            <!-- /.box -->
          </div>
        </div>