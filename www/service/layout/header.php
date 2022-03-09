<?php
/*$allCount=0;
$sql2='SELECT count(`readStatus`) as statusCount FROM `eco_sales_order` WHERE `readStatus`="0" LIMIT 0 , 1';
$result2=mysqli_query($ConnectDB,$sql2);
$dataCount=mysqli_fetch_array($result2, MYSQLI_ASSOC);
$allCount=$dataCount['statusCount'];*/
$statusCount=0;
$usertype=$_SESSION["usertype"];
		$perm_data=array();
		if(isset($_SESSION["perm"])&&gettype(json_decode($_SESSION["perm"]))=='array'){
			$perm_data=json_decode($_SESSION["perm"]);		
		}
?>
      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ENV</b></span>
          <!-- logo for regular state and mobile devices -->
          <span><?php echo $main_config['web_name']; ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
  <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
			<?php if($usertype=='1'||in_array("add_list", $perm_data)){ ?>
		  <li class="messages-menu">
            <a href="index.php?option=add_list&itemid=1">
              <i class="fa fa-plus-square"></i>
            
            </a>

          </li>
          <?php } ?>
          
		  <li class="messages-menu">
            <a href="index.php?option=list&itemid=2">
              <i class="fa  fa-pencil-square"></i>
            
            </a>

          </li>
          <?php if($usertype=='1'||$usertype=='2'){ ?>
		  <li class="messages-menu">
            <a href="index.php?option=customer&itemid=5">
              <i class="fa fa-users"></i>
            
            </a>

          </li>
          <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php 
		                       
								echo '<img alt="Image" src="images/logo_mini.png" width="25" height="auto" class="img-circle" style=" margin-bottom: -10px; margin-top: -10px; ">';
							
?>
                  <span class="hidden-xs"><?php echo $_SESSION["user_name"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
<?php 
		                     
								echo '<img alt="Image" src="images/logo_mini.png" width="150" height="auto" class="img-circle">';
							
?>
                
                    <p>
                      <?php echo $_SESSION["user_name"]; ?>
                     
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->

                  <li class="user-footer">

                    <div class="text-center">
                    <form id="admin_logout" action="layout/member/logout.php" method="post" enctype="multipart/form-data">
                                     
                      <a href="#" class="btn btn-default btn-flat logout">ออกจากระบบ</a>
                    </form>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
    
            </ul>
          </div>
        </nav>
      </header>
<script>
jQuery(document).ready( function($) {

	   var logout = { 
	 
		
		dataType:  'json',
	    beforeSubmit:  function(){

			}, 
		success:   function(data) {

			if(data.status=='1'){
				window.location.reload();
			}
		
	   },
       complete: function() {
		
	   },
	   error:   function(data) {console.log('ระบบทำงานผิดพลาด '+data);}
	   };


			$('.btn-flat.logout').click(function(){
				
							$('#admin_logout').ajaxForm(logout);
							$('#admin_logout').submit();
			});
  		
	

		
});
</script>

