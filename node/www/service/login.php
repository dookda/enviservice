<?php session_start(); define('_PRIVATE_INCLUDE','loaded'); include('config.php');  

include('function/main.php'); 
$main= new main();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เข้าสู่ระบบ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/green.css">
  <style>
  .login-box-body, .register-box-body { background: #fff; padding: 40px 20px; }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
  <?php
  $main_data=$main->GetConfig();
  $logo=json_decode($main_data['logo'],true);

  ?>
    <img src="<?php echo str_replace('|','',$logo['img'][0]); ?>" alt="logo" style="max-width:100%;" >
  </div>
    <h3 class="login-box-msg" style=" font-size: 16pt; color: #000; "><?php echo $main_data['web_name']; ?></h3>

    <form id="login-form" name="login-form" action="layout/member/check_login.php" method="post">
      <div class="form-group has-feedback">
        <input name="User" type="text" class="form-control" placeholder="ชื่อผู้ใช้">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="Pass" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-12">
        	
          <button type="submit" class="btn btn-block btn-flat bg-green" style=" width: 120px; margin: 0 auto; ">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  <!-- /.social-auth-links --></div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="dist/js/jquery.form.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });
	   var options = { 
	 
 		dataType:'json',
	    beforeSubmit:  function(){

			}, 
		success:   function(data) {
			

			
			if(data.status==1){

				
					location.href="index.php";
				
			}else{
				alert(data.status);
			}
		
	   },
       complete: function() {
		
	   },
	   error: function(data){
		   
			alert('มีข้อผิดพลาด'+data.responseText);   
			
	   }
	   };
	 
	$('#login-form').ajaxForm(options);
  });
</script>
</body>
</html>
