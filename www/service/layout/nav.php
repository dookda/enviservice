      <!-- Left side column. contains the logo and sidebar -->
      <?php  if(isset($_GET['itemid'])&&$_GET['itemid']!=''){$itemid=$_GET['itemid'];}else{$itemid='';}?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
<?php 

								echo '<img alt="Image" src="images/logo_mini.png" width="45" height="auto" class="img-circle">';
							
?>
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION["user_name"]; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

<br/>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->

            
            <?php if($usertype=='1'||$usertype=='2'){ ?>
            <li class="<?php if($itemid==''){echo 'active';} ?>">
              <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
            </li>
            <?php } ?>
            <!--<li class="<?php if($itemid=='1'){echo 'active';} ?>">
              <a href="index.php?option=personnel&itemid=1"><i class="fa fa-th-list" aria-hidden="true"></i> <span>ข้อมูลนักศึกษาและบุคลากร</span> </a> 
            </li>-->
            <?php if($usertype=='1'||in_array("add_list", $perm_data)){ ?>
            <li class="<?php if($itemid=='1'){echo 'active';} ?>">
              <a href="index.php?option=add_list&itemid=1"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>รับงาน</span> </a>
            </li>    
            <?php } ?> 
            <?php if($usertype=='1'||$usertype=='2'){ ?>
            <li class="<?php if($itemid=='2'){echo 'active';} ?>">
              <a href="index.php?option=list&itemid=2"><i class="fa  fa-pencil-square" aria-hidden="true"></i> <span>จัดการงาน</span> </a>
            </li>  
            <?php } ?> 
            <?php if($usertype=='1'){ ?>
            <li class="<?php if($itemid=='3'){echo 'active';} ?>">
              <a href="index.php?option=manage_status&itemid=3"><i class="fa  fa-flag" aria-hidden="true"></i> <span>สถานะ</span> </a>
            </li>  
            <?php } ?>  
            <?php if($usertype=='1'){ ?>
            <li class="<?php if($itemid=='4'){echo 'active';} ?>">
              <a href="index.php?option=manage_category&itemid=4"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>หมวดหมู่</span> </a>
            </li>   
            <?php } ?>
            <?php if($usertype=='1'||$usertype=='2'){ ?>
            <li class="<?php if($itemid=='5'){echo 'active';} ?>">
              <a href="index.php?option=customer&itemid=5"><i class="fa fa-users"></i> <span>ลูกค้า</span> </a>
            </li>
            <?php } ?>
            <?php if($usertype=='1'){ ?>
            <li class="<?php if($itemid=='6'){echo 'active';} ?>">
              <a href="index.php?option=member&itemid=6"><i class="fa  fa-user"></i> <span>ผู้ใช้</span> </a>
            </li>
            <?php } ?>
            <?php if($usertype=='1'){ ?>
            <li class="treeview <?php if($itemid=='7'){echo 'active';} ?>">
              <a href="index.php?option=setting&itemid=7"><i class="fa fa-gear"></i> <span>ตั้งค่า</span> </a>

            </li>
            <?php } ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
