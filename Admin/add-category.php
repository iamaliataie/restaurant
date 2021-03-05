<?php include("parcials/menu.php") ?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="title text-center">
                <h2>Add new category</h2>
            </div>
            <?php 
                if(isset($_SESSION["add_failed"])){
                    echo $_SESSION["add_failed"];
                    unset($_SESSION["add_failed"]);
                }
            ?>
            <form action="" method="POST" class="form" enctype="multipart/form-data">
                <label for="fullname" >
                    Title<input type="text" class="pad radius full-width" name="title" id="" required>
                </label>

                    Image <input type="file" class="pad radius full-width" name="image" >

                    Featured <br>
                    <input type="radio" name="featured" value="yes"> Yes
                    <input type="radio" name="featured" value="no"> No
                    <br><br>
                    Active <br>
                    <input type="radio" name="active" value="yes"> Yes
                    <input type="radio" name="active" value="no"> No
                    <br><br>
                <input type="submit" name="add" class="btn-add radius" value="Add">
                <a href="manage-admin.php" class="btn-danger radius">Cancel</a>
            </form>
        </div>
    </section>

<?php include("parcials/footer.php") ?>
<?php 

    if(isset($_POST["add"])){
        $num = 1;
        $title = $_POST["title"];
        $image_name = $_FILES["image"]["name"];
        
        if($image_name != ""){
        $image_name = $_FILES["image"]["name"];
        $source_path = $_FILES["image"]["tmp_name"];
        
        $extension = end(explode('.',$image_name));
        $date = date('Y_m_d-H-i-s');
        $image_name = "Category".$date.".".$extension;

        $destination_path = "../images/category/".$image_name;
        }
        else{
            $image_name = "";
        }
        
        if(isset($_POST["featured"])){
            $feature = $_POST["featured"];
        }else{
            $feature = "no";
        }
        if(isset($_POST["active"])){
            $active = $_POST["active"];
        }else{
            $active = "no";
        }

        $query = "INSERT INTO Category SET 
            Title = '$title',
            Image_Name = '$image_name',
            Featured = '$feature',
            Active = '$active'";


        $result = mysqli_query($connect,$query);

        if($result){
            if($image_name != ""){
                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload){
                   $_SESSION["add-category"] = "<div class='success'>New category added successfully</div>";
                   header("location:".SITEURL."admin/manage-category.php");
                }else{
                    
                }
            }else{
                header("location:".SITEURL."admin/manage-category.php");
            }
        }
        else{
            header("location:".SITEURL."admin/manage-category.php");
        }
    }
    else{
        echo "not clicked";
    }


?>