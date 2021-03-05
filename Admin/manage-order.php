<?php include("parcials/menu.php") ?>

<section class="main-content">
        <div class="wrapper">
            <div class="content">
                <h2>Manage Orders</h2>
                <?php 
                    if($_SESSION["order-deleted"]){
                        echo $_SESSION["order-deleted"];
                        unset($_SESSION["order-deleted"]);
                    }
                ?>
                    <div class="orderies">
                        <h2>Orders</h2>
                        <?php 
                            $query = "SELECT * FROM Food_Order WHERE Status = 'Ordered' ORDER BY id DESC";
                            $result = mysqli_query($connect,$query);
                            if($result -> num_rows >0){
                                foreach($result as $order):
                                    $order_id = $order["id"];
                                    $order_title = $order["Food"];
                                    $order_price = $order["Price"];
                                    $order_quantity = $order["Quantity"];
                                    $order_total = $order["Total"];
                                    $order_date = $order["Order_Date"];
                                    $order_status = $order["Status"];
                                    $customer_name = $order["Customer_Name"];
                                    $customer_contact = $order["Customer_Contact"];
                                    $customer_email = $order["Customer_Email"];
                                    $customer_address = $order["Customer_Address"]; ?>

                                    <div class="order-box">
                                        <div class="order-id bg-black">
                                            <h1><?php echo $order_id; ?></h1>
                                        </div>
                                        <div class="ordered-food">
                                            <div class="food-description">
                                                <div class="food-name bg-black"><?php echo $order_title; ?></div>
                                                <div class="order-date bg-black"><?php echo $order_date; ?></div>
                                                <?php if($order_status == "Ordered"){
                                                    echo "<div class='ordered'>Ordered</div>";
                                                }elseif($order_status == "Delivered"){
                                                    echo "<div class='delivered'>Delivered</div>";
                                                } ?>
                                            </div>
                                            <div class="food-bill">
                                                <div class="price-caption bg-black">Price:</div>
                                                <div class="food-price bg-black">$<?php echo $order_price; ?></div>
                                                <div class="quantity-caption bg-black">Quantity:</div>
                                                <div class="food-quantity bg-black"><?php echo $order_quantity; ?></div>
                                                <div class="total-caption btn-delete">Total</div>
                                                <div class="order-total btn-delete">$<?php echo $order_total; ?></div>
                                            </div>
                                        </div>
                                        <div class="line bg-black"></div>
                                        <div class="customer">
                                            <div class="part1">
                                                <div class="customer-name bg-black"><?php echo $customer_name; ?></div>
                                                <div class="customer-contact bg-black"><?php echo $customer_contact; ?></div>
                                            </div>
                                            <div class="part2">
                                                <div class="customer-address bg-black"><?php echo $customer_address; ?></div>
                                            </div>
                                            <div class="part3">
                                                <div class="customer-email bg-black"><?php echo $customer_email; ?></div>
                                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-update">update</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $order_id; ?>" class="btn-danger">delete</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach;}else{
                                echo "<div class='failed'>Nothin to show</div>";
                            }
                        ?>
                    </div>
                    <div class="orderies">
                        <h2>Delivered</h2>
                        <?php 
                            $query = "SELECT * FROM Food_Order WHERE Status = 'Delivered'";
                            $result = mysqli_query($connect,$query);
                            if($result -> num_rows >0){
                                foreach($result as $order):
                                    $order_id = $order["id"];
                                    $order_title = $order["Food"];
                                    $order_price = $order["Price"];
                                    $order_quantity = $order["Quantity"];
                                    $order_total = $order["Total"];
                                    $order_date = $order["Order_Date"];
                                    $order_status = $order["Status"];
                                    $customer_name = $order["Customer_Name"];
                                    $customer_contact = $order["Customer_Contact"];
                                    $customer_email = $order["Customer_Email"];
                                    $customer_address = $order["Customer_Address"]; ?>

                                    <div class="order-box">
                                        <div class="order-id bg-black">
                                            <h1><?php echo $order_id; ?></h1>
                                        </div>
                                        <div class="ordered-food">
                                            <div class="food-description">
                                                <div class="food-name bg-black"><?php echo $order_title; ?></div>
                                                <div class="order-date bg-black"><?php echo $order_date; ?></div>
                                                <?php if($order_status == "Ordered"){
                                                    echo "<div class='ordered'>Ordered</div>";
                                                }elseif($order_status == "Delivered"){
                                                    echo "<div class='delivered'>Delivered</div>";
                                                } ?>
                                            </div>
                                            <div class="food-bill">
                                                <div class="price-caption bg-black">Price:</div>
                                                <div class="food-price bg-black">$<?php echo $order_price; ?></div>
                                                <div class="quantity-caption bg-black">Quantity:</div>
                                                <div class="food-quantity bg-black"><?php echo $order_quantity; ?></div>
                                                <div class="total-caption delivered">Total</div>
                                                <div class="order-total delivered">$<?php echo $order_total; ?></div>
                                            </div>
                                        </div>
                                        <div class="line bg-black"></div>
                                        <div class="customer">
                                            <div class="part1">
                                                <div class="customer-name bg-black"><?php echo $customer_name; ?></div>
                                                <div class="customer-contact bg-black"><?php echo $customer_contact; ?></div>
                                            </div>
                                            <div class="part2">
                                                <div class="customer-address bg-black"><?php echo $customer_address; ?></div>
                                            </div>
                                            <div class="part3">
                                                <div class="customer-email bg-black"><?php echo $customer_email; ?></div>
                                                <div></div>
                                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-update">update</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach;}else{
                                echo "<div class='failed'>Nothin to show</div>";
                            }
                        ?>
                    </div>
            </div>
        </div>
    </section>

<?php include("parcials/footer.php") ?>