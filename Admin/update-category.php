<?php include("parcials/menu.php");

    $id = $_GET["id"];

    $query = "SELECT * FROM Category WHERE id = $id";

    $result = mysqli_query($connect,$query);
    
    $row = mysqli_fetch_assoc($result);

    $id = $row["id"];
    $title = $row["Title"];
    $image_name = $row["Image_Name"];
    $featured = $row["Featured"];
    $active = $row["Active"];
?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="update-category">
                <div>
                    <div class="title text-center">
                        <h2>Update category</h2>
                    </div>
                    <?php 
                        if(isset($_SESSION["add_failed"])){
                            echo $_SESSION["add_failed"];
                            unset($_SESSION["add_failed"]);
                        }
                    ?>
                    <form action="" method="POST" class="form" enctype="multipart/form-data">
                        <label for="fullname" >
                            Title<input type="text" class="pad radius full-width" name="title" value="<?php echo $title; ?>" required>
                        </label>

                            Image <input type="file" class="pad radius full-width" name="image" >

                            Featured <br>
                            <input type="radio" name="featured" <?php if($featured == "yes"){echo "checked";} ?> value="yes"> Yes
                            <input type="radio" name="featured" <?php if($featured == "no"){echo "checked";} ?> value="no"> No
                            <br><br>
                            Active <br>
                            <input type="radio" name="active" <?php if($active == "yes"){echo "checked";} ?> value="yes"> Yes
                            <input type="radio" name="active" <?php if($active == "no"){echo "checked";} ?> value="no"> No
                            <br><br>
                            <input type="hidden" name="current-image" value="<?php echo $image_name; ?>">
                        <input type="submit" name="update" class="btn-update radius" value="Update">
                        <a href="manage-category.php" class="btn-danger radius">Cancel</a>
                    </form>
                </div>
                <div>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive radius" alt="">
                </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>
<?php 
    if (isset($_POST["update"])) {
        $Title = $_POST["title"];
        $Current_image = $_POST["current-image"];
        $Featured = $_POST["featured"];
        $Active = $_POST["active"];
        $New_image = $_FILES["image"]["name"];

        if($New_image != ""){
            $New_image = $_FILES["image"]["name"];
            $source_path = $_FILES["image"]["tmp_name"];
        
            $extension = end(explode('.',$New_image));
            $date = date('Y_m_d-H-i-s');
            $New_image = "Category".$date.".".$extension;

            $destination_path = "../images/category/".$New_image;
        }else{
            $New_image = $Current_image;
        }

        $query = "UPDATE Category SET 
            Title = '$Title',
            Image_Name = '$New_image',
            Featured = '$Featured',
            Active = '$Active' 
            WHERE id = $id";

        $result = mysqli_query($connect,$query);
        if($result){
            if($New_image != $Current_image){
                $remove = unlink("../images/category/".$Current_image);
                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload){
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    echo "upload error";
                }
            }
            $_SESSION["update-category"] = "<div class='success'>". $Title ." updated successfully</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }else{
            echo "database failoure";
        }
    }
    echo $New_image;
?>