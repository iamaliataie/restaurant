<?php include("parcials/menu.php") ?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="title text-center">
                <h2>Add new food</h2>
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
                    Description <textarea class="full-width pad radius" name="description"></textarea><br>
                    Price<input type="number" class="pad radius full-width" name="price" id="" required>
                    Image <input type="file" class="pad radius full-width" name="image" required>
                    Category <select name="category" class="pad radius full-width">
                            <option value="0">Select a category</option>
                    <?php 
                        $query = "SELECT * FROM Category WHERE Active='yes'";
                        $result = mysqli_query($connect,$query);
                        if($result -> num_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row["id"];
                                $Category = $row["Title"]; ?>
                            <option value="<?php echo $id; ?>"><?php echo $Category; ?></option>
                            <?php }
                        }else{?>
                            <option value="0">No Active Category</option>
                        <?php }?>
                        
                    </select><br><br>
                    Featured <br>
                    <input type="radio" name="featured" value="yes" > Yes
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

        $title = $_POST["title"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $image_name = $_FILES["image"]["name"];

        if($image_name != ""){
            $image_name = $_FILES["image"]["name"];
            $source_path = $_FILES["image"]["tmp_name"];
            $extension = end(explode('.',$image_name));
            $date = date('Y_m_d-H-i-s');
            $image_name = "Food".$date.".".$extension;

            $destination_path = "../images/Food/".$image_name;
        }else{
            $image_name = "";
        }

        if(isset($_POST["featured"])){
            $featured = $_POST["featured"];
        }else{
            $featured = "no";
        }

        if(isset($_POST["active"])){
            $active = $_POST["active"];
        }else{
            $active = "no";
        }
        
        // UPDATE `Food` SET `id`=[value-1],`Title`=[value-2],
        // `Description`=[value-3],`Price`=[value-4],
        // `Image_Name`=[value-5],`Category_Id`=[value-6],
        // `Featured`=[value-7],`Active`=[value-8]

        $query = "INSERT INTO Food SET 
            Title = '$title',
            Description = '$description',
            Price = $price,
            Image_Name = '$image_name',
            Category_Id = '$category',
            Featured = '$featured',
            Active = '$active'
        ";
        $result = mysqli_query($connect,$query);
        if($result){
            if($image_name != ""){
                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload){
                   $_SESSION["add-image"] = "<div class='success'>Image uploaded successfully</div>";
                   header("location:".SITEURL."admin/manage-category.php");
                }else{
                    $_SESSION["add-image"] = "<div class='danger'>Image uploading failed</div>";
                   header("location:".SITEURL."admin/manage-category.php");
                }
            }else{
                header("location:".SITEURL."admin/manage-category.php");
            }
            $_SESSION["add-food"] = "<div class='success'>New food added successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }else{
            echo "query error\n";
            echo $query;
        }
    }
    else{
        echo "not clicked";
    }



?>