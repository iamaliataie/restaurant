<?php include("parcials/menu.php");

    $id = $_GET["id"];
    $query = "SELECT * FROM Users WHERE id = $id";
    $result = mysqli_query($connect, $query);
    if($result){
        if($result -> num_rows == 1){
            $row = $result -> fetch_assoc();
            $fullname = $row["Fullname"];
            $username = $row["Username"];
        }
        else{
            $_SESSION["user-not-found"] = "<div class='failed'>User not found.</div>";
            header("location:".SITEURL."Admin/manage-admin.php");
        }
    }

?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="title text-center">
                <h2>Update admin</h2>
            </div>
            <?php 
                if(isset($_SESSION["update"])){
                    echo $_SESSION["update"];
                    unset($_SESSION["update"]);
                }
            ?>
            <form action="" method="POST" class="form">
                <label for="fullname" >
                    Full Name<input type="text" class="pad radius full-width" name="fullname" value="<?php echo $fullname; ?>" required>
                </label>
                <label for="username">
                    Username <input type="text" class="pad radius full-width" name="username" value="<?php echo $username; ?>" required>
                </label>
                <input type="submit" name="update" class="btn-update radius" value="Update">
                <a href="manage-admin.php" class="btn-danger radius">Cancel</a>
            </form>
        </div>
    </section>

<?php include("parcials/footer.php"); ?>
<?php 

if(isset($_POST["update"])){
    $Fullname = $_POST["fullname"];
    $Username = $_POST["username"];

    $query = "UPDATE Users SET
        Fullname = '$Fullname',
        Username = '$Username'
        WHERE id = $id
    ";

    $result = mysqli_query($connect,$query);
    if($result){
        $_SESSION["update"] = "<div class='success'>User ". $id ." updated successfully!</div>";
        header("location:".SITEURL."Admin/manage-admin.php");
    }else{
        $_SESSION["update"] = '<div class="failed">Update Failed!</div>';
        header("location:manage-admin.php");
    }
}

?>