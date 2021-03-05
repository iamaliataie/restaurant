<?php include("parcials/menu.php") ?>

<section class="main-content">
        <div class="wrapper">
            <div class="content">
                <div class="title">
                    <h2>Categories</h2>
                </div>
                <?php 
                    if(isset($_SESSION["add-category"])){
                        echo $_SESSION["add-category"];
                        unset($_SESSION["add-category"]);
                    }
                    if(isset($_SESSION["delete-category"])){
                        echo $_SESSION["delete-category"];
                        unset($_SESSION["delete-category"]);
                    }
                    if(isset($_SESSION["update-category"])){
                        echo $_SESSION["update-category"];
                        unset($_SESSION["update-category"]);
                    }
                ?>
                <div class="add-button">
                    <a href="add-category.php" class="btn-add radius" >Add Category</a>
                </div>
                <div class="cards">
                    <?php 
                        $query = "SELECT * FROM Category";
                        $result = mysqli_query($connect, $query);
                        $count = mysqli_num_rows($result);
                        if($count > 0){
                        foreach($result as $item):
                            $id = $item["id"];
                            $item_title = $item["Title"];
                            $item_image = $item["Image_Name"];
                            $item_featured = $item["Featured"];
                            $item_active = $item["Active"];
                    ?>
                    <div class="card-item radius">
                        <div class="card-img">
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $item_image; ?>" class="img-responsive" alt="">
                        </div>
                        <div class="title">
                            <h3><?php echo $item_title; ?></h3>
                        </div>
                        <div>
                            <?php if($item_featured == "yes"){
                                ?>
                                    <span class="success">Featured</span>
                            <?php }else{?><span class="failed">Not Featured</span><?php } ?>
                            <?php if($item_active == "yes"){
                                ?>
                                    <span class="success">Activated</span>
                            <?php }else{?><span class="failed">Not Activated</span><?php } ?>
                        </div>
                        <div class="settings">
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-update radius">update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image-name=<?php echo $item_image; ?>" class="btn-danger radius">delete</a>
                        </div>
                    </div>
                    <?php endforeach; }
                        else{
                            ?>
                            <div style="background:yellow" class>
                                <h2 class="text-center">Nothing to Show</h2>
                            </div>
                            <?php
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>