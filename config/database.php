<?php session_start();?>
<?php

define('DB_HOST','localhost');
define('DB_USER','priyanka');
define('DB_PASS','12345678');
define('DB_NAME','car_rental');

//create connection
$conn=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//check connection
if($conn->connect_error){
    die('Con failed'.$conn->connect_error); //kill everything here
}

//to see if connected
//echo 'CONNECTED';
?>