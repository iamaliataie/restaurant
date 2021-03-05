<?php 

    include("parcials/menu.php");

    $id = $_GET["id"];
    $image_name = $_GET["image-name"];

    $query = "DELETE FROM Food WHERE id = $id";

    $result = mysqli_query($connect,$query);

    if($result){
        $path = "../images/Food/".$image_name;
        $remove_image = unlink($path);
        if($remove_image){
            $_SESSION["food-image-delete"] = "<div class='success'>Food image deleted successfully.</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }else{
            $_SESSION["food-image-delete"] = "<div class='failed'>Food image deleting failed.</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        $_SESSION["food-delete"] = "<div class='success'>Food deleting successfully.</div>";
            header("location:".SITEURL."admin/manage-food.php");
    }
    $_SESSION["food-delete"] = "<div class='failed'>Food deleted successfully.</div>";
        header("location:".SITEURL."admin/manage-food.php");

?>