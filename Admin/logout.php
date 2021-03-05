<?php 
    include("../config/constrants.php");
    session_destroy();
    header("location:".SITEURL."admin/login.php");
?>