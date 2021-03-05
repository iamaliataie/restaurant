<?php 
    include("../config/constrants.php");

    $id = $_GET["id"];

    $query = "DELETE FROM Food_Order WHERE id = $id";
    $result = mysqli_query($connect,$query);
    if($result){
        $_SESSION["order-deleted"] = "<div class='success'>Order deleted successfully</div>";
        header("location:".SITEURL."admin/manage-order.php");
    }
    else{
        $_SESSION["order-deleted"] = "<div class='failed'>Order deletion failed</div>";
        header("location:".SITEURL."admin/manage-order.php");
    }
?>