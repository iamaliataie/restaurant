<?php include("menu.php") ?>

<div class="main-content">
    <div class="container padding">
    <div class="title text-center">
                <h2>Categories</h2>
            </div>
            <div class="food-boxes">
                <?php 
                $query = "SELECT * FROM Category WHERE Featured = 'yes' AND Active = 'yes'";
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
</div>
<?php include("footer.php") ?>