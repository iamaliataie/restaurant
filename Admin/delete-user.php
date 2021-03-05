<?php 
    include("../config/constrants.php");
    $id = $_GET["id"];
    $query = "DELETE FROM Users WHERE id = $id";
    $result = mysqli_query($connect,$query);
    if($result){
        $_SESSION["user_deleted"] = '<div class="success">User Deleted Successfully</div>';
        header("location:".SITEURL."Admin/manage-admin.php");
    }
?>