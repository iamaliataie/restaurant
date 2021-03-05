<?php include("menu.php");
    $id = $_GET["id"];
    $query = "SELECT * FROM Food WHERE id = $id";
    $result = mysqli_query($connect,$query);
    $food = mysqli_fetch_assoc($result);
    $food_name = $food["Title"];
    $food_price = $food["Price"];
    $food_image = $food["Image_Name"];
?>

<div class="main-content">
    <div class="container">
        <div class="title">
            <h1>Order</h1>
        </div>
        <form action="" method="POST" class="form border">
            <div class="food-section">
                <div class="food-image ">
                    <img src="<?php echo SITEURL; ?>/images/Food/<?php echo $food_image; ?>" class="img-responsive radius">
                </div>
                <div class="food-description">
                    <h2><?php echo $food_name; ?></h2>
                    <h4>$<?php echo $food_price; ?></h4>
                    <br>
                    <label for="">Quantity:</label>
                    <input type="number" name="quantity" class=" pad radius" value="1" id="">
                </div>
            </div>
            <div class="customer-section border">
                <label for="">Full Name</label>
                <input type="text" name="fullname" class="pad radius" value="ali">
                <br>
                <label for="">Mobile</label>
                <input type="text" name="contact" class="pad radius" value="0767014769">
                <br>
                <label for="">Email</label>
                <input type="email" name="email" class="pad radius" value="iamaliataie@gmail.com">
                <br><br>
                <label for="">Address</label>
                <textarea name="address" class="pad radius" cols="30" rows="10"></textarea>
                <input type="submit" name="order" value="Order" class="btn-update pad radius">
            </div>
        </form>
    </div>
</div>
<?php include("footer.php");

        if(isset($_POST["order"])){
            $quantity = $_POST["quantity"];
            $price = $food_price;
            $total = $quantity * $price;
            $name = $_POST["fullname"];
            $contact = $_POST["contact"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $status = "Ordered";
            $Title = $food_name;

            $query="INSERT INTO Food_Order SET 
                Food = '$Title',
                Price = $price,
                Quantity = $quantity,
                Total = $total,
                Order_Date = CURRENT_TIMESTAMP,
                Status = '$status',
                Customer_Name = '$name',
                Customer_Contact = '$contact',
                Customer_Email = '$email',
                Customer_Address = '$address'";

            $result = mysqli_query($connect,$query);
            if($result){
                $_SESSION["food-order"] = "<div class='text-center'><p class='success'>Your ordered successfully</p></div>";
                header("location:".SITEURL);
            }
            else{
                echo "query error";
            }
        }
        else{
            echo "not clicked";
        }



?>