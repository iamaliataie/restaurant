<?php include("parcials/menu.php"); ?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="content">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
                <div class="categories">
                    <div class="item text-center">
                        <?php 
                            $query = "SELECT * FROM Category";
                            $result = mysqli_query($connect,$query);
                            $count = mysqli_num_rows($result);
                        ?>
                        <h2><?php echo $count; ?></h2>
                        <h2>Categories</h2>
                    </div>
                    <div class="item text-center">
                        <?php 
                            $query = "SELECT COUNT(*) AS count FROM Food";
                            $result = mysqli_query($connect,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $output = $row["count"];
                            }
                        ?>
                        <h2><?php echo $output; ?></h2>
                        <h2>Foods</h2>
                    </div>
                    <div class="item text-center">
                        <?php 
                            $query = "SELECT * FROM Food_Order";
                            $result = mysqli_query($connect,$query);
                            $count = mysqli_num_rows($result);
                        ?>
                        <h2><?php echo $count; ?></h2>
                        <h2>Orders</h2>
                    </div>
                    <div class="item text-center">
                        <?php 
                            $query = "SELECT SUM(Total) AS total FROM Food_Order WHERE Status = 'Delivered'";
                            $result = mysqli_query($connect,$query);
                            $rows = mysqli_fetch_assoc($result);
                            $total = $rows["total"];
                        ?>
                        <h2>$<?php echo $total; ?></h2>
                        <h2>Cash</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>
