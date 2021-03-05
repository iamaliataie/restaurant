<?php 
    if(!isset($_SESSION["username"])){
        header("location:".SITEURL."admin/login.php");
    }
?>