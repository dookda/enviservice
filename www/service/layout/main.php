<?php


if($usertype=='1'||$usertype=='2'){}else{ die('ไม่อนุญาตให้เข้าถึงข้อมูลนี้');}
?>
<style>
.item{    padding: 5px 0 5px;}
</style>

<section class="content">
<?php include('main/top_button.php');?>
      
<div class="row">
<?php include('main/last_list.php');?>
<?php include('main/last_customer.php');?>
</div>

</section>