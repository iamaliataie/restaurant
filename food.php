<?php include("menu.php") ?>

    <div class="main-content">
        <div class="container ">
            <br><br>
            <div class="search-bar text-center">
                <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">
                    <input type="search" name="search" placeholder="type your keyword">
                    <input type="submit" value="Search" class="btn">
                </form>
            </div>
            <div class="padding">
            <div class="title text-center"><h2>Food Menu</h2></div>
            <div class="food-items">
            
                    <?php 
                        $query = "SELECT * FROM Food WHERE Featured = 'yes' AND Active = 'yes'";
                        $result = mysqli_query($connect,$query);
                        foreach($result as $food):
                            $food_id = $food["id"];
                            $food_name = $food["Title"];
                            $food_description = $food["Description"];
                            $food_price = $food["Price"];
                            $food_image = $food["Image_Name"]; ?>
                            <div class="item img-curve">
                            <div class="img">
                                <img src="<?php echo SITEURL; ?>/images/Food/<?php echo $food_image; ?>" alt="" class="img-responsive img-curve">
                            </div>
                            <div class="item-description">
                                <h3 class="item-title"><?php echo $food_name; ?></h3>
                                <p class="item-price">$<?php echo $food_price; ?></p>
                                <p><?php echo $food_description; ?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>/order.php?id=<?php echo $food_id; ?>" class="btn"> Order Now</a>
                            </div>
                            </div>

                    <?php endforeach;?>
            </div>
            </div>
        </div>
    </div>

<?php include("footer.php") ?>