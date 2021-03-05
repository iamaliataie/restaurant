<?php include("parcials/menu.php") ?>

<section class="main-content">
        <div class="wrapper">
            <div class="content">
                <h2>Manage Food</h2>
                <?php 
                    if(isset($_SESSION["add-food"])){
                        echo $_SESSION["add-food"];
                        unset($_SESSION["add-food"]);
                    }
                    echo "\n";
                    if(isset($_SESSION["add-image"])){
                        echo $_SESSION["add-image"];
                        unset($_SESSION["add-image"]);
                    }
                    echo "\n";
                    if(isset($_SESSION["food-delete"])){
                        echo $_SESSION["food-delete"];
                        unset($_SESSION["food-delete"]);
                    }
                    echo "\n";
                    if(isset($_SESSION["food-image-delete"])){
                        echo $_SESSION["food-image-delete"];
                        unset($_SESSION["food-image-delete"]);
                    }
                    echo "\n";
                    if(isset($_SESSION["image-update"])){
                        echo $_SESSION["image-update"];
                        unset($_SESSION["image-update"]);
                    }
                    echo "\n";
                    if(isset($_SESSION["food-update"])){
                        echo $_SESSION["food-update"];
                        unset($_SESSION["food-update"]);
                    }
                
                ?>
                <div class="add-button">
                    <a href="add-food.php" class="btn-add radius" >Add Food</a>
                </div>

                <div class="cards">
                    <?php 
                        $query = "SELECT * FROM Food";
                        $result = mysqli_query($connect,$query);
                        if($result -> num_rows >0){
                            foreach($result as $item):
                                $id = $item["id"];
                                $item_title = $item["Title"];
                                $item_description = $item["Description"];
                                $item_price = $item["Price"];
                                $item_image = $item["Image_Name"];
                                $item_category = $item["Category_Id"];
                                $featured = $item["Featured"];
                                $active = $item["Active"];?>

                    <div class="card-item radius">
                        <div class="card-img">
                        <img src="<?php echo SITEURL; ?>images/Food/<?php echo $item_image; ?>" class="img-responsive" alt="">
                        </div>
                        <div class="title">
                            <h2><?php echo $item_title; ?></h2>
                        </div>
                        <div>
                            <h4>$<?php echo $item_price; ?></h4>
                            <hr>
                            <p><?php echo $item_description; ?></p>
                        </div>
                        <div>
                            <div class="category-type"><?php if($item_category == 31){echo "Hamburger";} 
                                elseif ($item_category == 28) {echo "Pizza";}
                                elseif ($item_category == 30) {echo "Kebab";}
                            ?></div>
                            <?php if($featured == "yes"){
                                ?>
                                    <span class="success">Featured</span>
                            <?php }else{?><span class="failed">Not Featured</span><?php } ?>
                            <?php if($active == "yes"){
                                ?>
                                    <span class="success">Activated</span>
                            <?php }else{?><span class="failed">Not Activated</span><?php } ?>
                        </div>
                        <div class="settings">
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-update radius">update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image-name=<?php echo $item_image; ?>" class="btn-danger radius">delete</a>
                        </div>
                    </div>

                        <?php endforeach;
                        }else{?>
                            <div class="failed">Nothing to show!</div>
                        <?php }?>
                </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>