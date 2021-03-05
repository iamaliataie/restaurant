<?php include("menu.php") ?>
    <!-- navbar -->


    <!-- search bar -->
    <section class="search padding">
        <div class="container">
            <div class="search-bar text-center">
                <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">
                    <input type="search" name="search" placeholder="type your keyword">
                    <input type="submit" value="Search" class="btn">
                </form>
            </div>
        </div>
    </section>
    <?php 
        if(isset($_SESSION["food-order"])){
            echo $_SESSION["food-order"];
            unset($_SESSION["food-order"]);
        }
    ?>
    <!-- Explore Food -->
    <section class="explore-food padding">
        <div class="container">
            <div class="title text-center">
                <h2>Explore Food</h2>
            </div>
            <div class="food-boxes">
                <?php 
                $query = "SELECT * FROM Category WHERE Featured = 'yes' AND Active = 'yes' LIMIT 3";
                $result = mysqli_query($connect,$query);
                if($result){
                    foreach($result as $list):
                        $category_image = $list["Image_Name"];
                        $category_name = $list["Title"];?>

                        <div class="box">
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $category_image; ?>" alt="food1" class="img-responsive img-curve">
                            <h2 class="food-title"><?php echo $category_name; ?></h2>
                        </div>

                   <?php endforeach;}
                
                ?>
                
            </div>
        </div>
    </section>

    <!-- Food menu -->
    <section class="food-menu padding">
        <div class="container">
            <div class="title text-center">
                <h2>Food Menu</h2>
            </div>
            <div class="food-items">
                
                    <?php 
                        $query = "SELECT * FROM Food WHERE Featured = 'yes' AND Active = 'yes' LIMIT 6";
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
    </section>

    <!-- social media -->


    <!-- footer -->
    <?php include("footer.php") ?>