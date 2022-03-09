<?php
function setval($val){
	if(isset($_POST[$val])){ return $_POST[$val]; }else{ return '';}
}



    ?>
