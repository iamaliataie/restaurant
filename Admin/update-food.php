<?php include("parcials/menu.php");

    $id = $_GET["id"];

    $query = "SELECT * FROM Food WHERE id = $id";

    $result = mysqli_query($connect,$query);
    
    $row = mysqli_fetch_assoc($result);

    $id = $row["id"];
    $title = $row["Title"];
    $description = $row["Description"];
    $price = $row["Price"];
    $image_name = $row["Image_Name"];
    $featured = $row["Featured"];
    $active = $row["Active"];
    $currrent_category = $row["Category_Id"];
?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="update-category">
                <div>
                    <div class="title text-center">
                        <h2><?php echo $title; ?></h2>
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
                            Description <textarea class="full-width pad radius" name="description"><?php echo $description; ?></textarea><br>
                            Price<input type="number" class="pad radius full-width" name="price" value="<?php echo $price;?>" required>
                            Image <input type="file" class="pad radius full-width" name="image" >
                            Category <select name="category" class="pad radius full-width">
                            
                    <?php 
                        $query = "SELECT * FROM Category WHERE Active='yes'";
                        $result = mysqli_query($connect,$query);
                        if($result -> num_rows > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $Category_id = $row["id"];
                                $Category_title = $row["Title"]; ?>
                            <option <?php if($Category_id == $currrent_category){echo "selected";} ?> value="<?php echo $Category_id; ?>"><?php echo $Category_title; ?></option>
                            <?php }
                        }else{?>
                            <option value="0">No Active Category</option>
                        <?php }?>
                        
                    </select><br><br>
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
                        <a href="manage-food.php" class="btn-danger radius">Cancel</a>
                    </form>
                </div>
                <div>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive radius" alt="">
                </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>
<?php 
    if(isset($_POST["update"])){
        
        $Title = $_POST["title"];
        $Description = $_POST["description"];
        $Price = $_POST["price"];
        $Category = $_POST["category"];
        $Featured = $_POST["featured"];
        $Active = $_POST["active"];
        $Current_image = $_POST["current-image"];
        $New_image = $_FILES["image"]["name"];
        
        if($New_image != ""){
            $New_image = $_FILES["image"]["name"];
            $source_path = $_FILES["image"]["tmp_name"];

            $extension = end(explode('.',$New_image));
            $date = date('Y_m_d-H-i-s');
            $New_image = "Food".$date.".".$extension;

            $destination = "../images/Food/".$New_image;
        }
        else{
            $New_image = $Current_image;
        }

        $query = "UPDATE Food SET 
            Title = '$Title',
            Description = '$Description',
            Price = $Price,
            Image_Name = '$New_image',
            Category_Id = '$Category',
            Featured = '$Featured',
            Active = '$Active' 
            WHERE id = $id;
        ";

        $result = mysqli_query($connect,$query);
        if($result){
            if($New_image != $Current_image){
                $path = "../images/Food/".$Current_image;
                $remove = unlink($path);
                if($remove){
                    echo "image removed";
                }else{
                    echo "remove failed";
                }
                $upload = move_uploaded_file($source_path,$destination);
                if($upload){
                    $_SESSION["image-update"] = "<div class='success'>Image updated successfully</div>";
                   header("location:".SITEURL."admin/manage-food.php");
                }else{
                    echo " upload failed";
                }
            }
            $_SESSION["food-update"] = "<div class='success'>$Title updated successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else{
            echo "query error";
        }
    }
?>