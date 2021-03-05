<?php 
session_start();

define("SERVER","localhost");
define("USER","root");
define("PASSWORD","");
define("DATABASE","restaurant");
define("SITEURL","http://localhost/restaurant/");


$connect = mysqli_connect(SERVER,USER,PASSWORD) or die(mysqli_error());
$database = mysqli_select_db($connect, DATABASE) or die(mysqli_error());  

?>