<?php 
    include("../config/constrants.php");
    $id = $_GET["id"];
    $image_name = $_GET["image-name"];
    $path = "../images/category/".$image_name;
    echo $image_name;
    echo $path;

    $query = "DELETE FROM Category WHERE id = $id";

    $result = mysqli_query($connect,$query);

    if($result){
        if($image_name != ""){
            $remove = unlink($path);
            if($remove){
                
            }
            else{
                $_SESSION["delete-category"] = "<div class='danger'>Category deletion failed</div>";
                   header("location:".SITEURL."admin/manage-category.php");
            }
        }else{
            $_SESSION["delete-category"] = "<div class='success'>Category deleted successfully</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }
        $_SESSION["delete-category"] = "<div class='success'>Category deleted successfully</div>";
        header("location:".SITEURL."admin/manage-category.php");
    }
    else{
        
    }
?>