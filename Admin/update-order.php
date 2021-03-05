<?php include("parcials/menu.php");

    $id = $_GET["id"];
    $query = "SELECT * FROM Food_Order WHERE id = $id";
    $result = mysqli_query($connect,$query);
    if($result){
        $row = mysqli_fetch_assoc($result);
        
        $order_price = $row["Price"];
        $order_quantity = $row["Quantity"];
        $order_status = $row["Status"];
        $order_total = $row["Total"];

    }else{
        echo "record not found";
    }
?>

<section class="main-content">
    <div class="wrapper">
        <div class="title text-center">
            <h2>Update Order</h2>
        </div>
        <form action="" method="POST" class="form">
            <label for="">Price</label>
            <input type="number" name="quantity" value="<?php echo $order_price; ?>" disabled class="full-width pad radius"><br>
            <label for="">Quantity</label>
            <input type="number" name="quantity" value="<?php echo $order_quantity; ?>" class="full-width pad radius"><br>
            <br>
            <label for="">Status</label>
            <input type="text" name="status" value="<?php echo $order_status; ?>" class="full-width pad radius">
            <br>
            <input type="submit"  name ="update" value="Update" class="btn-update radius">
        </form>
    </div>
</section>


<?php include("parcials/footer.php");

    if(isset($_POST["update"])){
        
        $quantity = $_POST["quantity"];
        $status = $_POST["status"];
        $total = $order_price * $quantity;

        $query = "UPDATE Food_Order SET 
            Quantity = $quantity,
            Total = $total,
            Status = '$status' 
            WHERE id = $id";

        $result = mysqli_query($connect,$query);
        if($result){
            $_SESSION["order-update"] = "<div class='success'>Order updated successfully</div>";
            header("location:".SITEURL."admin/manage-order.php");
        }
        else{
            $_SESSION["order-update"] = "<div class='failed'>Order Update failed</div>";
            header("location:".SITEURL."admin/manage-order.php");
        }

    }else{
        
    }




?>