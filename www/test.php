<?php

$mydatabase="cp897163_envirservi_web";
date_default_timezone_set('Asia/Bangkok');
// $ConnectDB = mysqli_connect("localhost","cp897163_mysql","3wV08KgHc",$mydatabase) ;

$servername = "localhost";
$username = "cp897163_mysql";
$password = "3wV08KgHc";

// Create connection
mysqli_connect($servername, $username, $password, $mydatabase);
 
if(mysqli_connect_error())
    echo "Connection Error.";
else
    echo "Database Connection Successfully.";


?>