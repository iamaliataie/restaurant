<?php include("parcials/menu.php") ?>

    <!-- main content -->
    <section class="main-content">
        <div class="wrapper">
            <div class="title text-center">
                <h2>Add new admin</h2>
            </div>
            <?php 
                if(isset($_SESSION["add_failed"])){
                    echo $_SESSION["add_failed"];
                    unset($_SESSION["add_failed"]);
                }
            ?>
            <form action="" method="POST" class="form">
                <label for="fullname" >
                    Full Name<input type="text" class="pad radius full-width" name="fullname" id="" required>
                </label>
                <label for="username">
                    Username <input type="text" class="pad radius full-width" name="username" id="" required>
                </label>
                <label for="password">
                    Password <input type="password" class="pad radius full-width" name="password" id="" required>
                </label>
                <input type="submit" name="register" class="btn-add radius" value="Register">
                <a href="manage-admin.php" class="btn-danger radius">Cancel</a>
            </form>
        </div>
    </section>

<?php include("parcials/footer.php") ?>
<?php 

    if(isset($_POST["register"]))
    {
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $query = "INSERT INTO Users SET
            Fullname = '$fullname',
            Username = '$username',
            Password = '$password'
        ";

        $result = mysqli_query($connect,$query);
        if($result){
            $_SESSION["user_added"] = '<div class="success">'.$fullname.' Added Successfully</div>';
            header("location:".SITEURL."Admin/manage-admin.php");
        }
        else{
            $_SESSION["add_failed"] = '<div class="failed">User Registration Failed.</div>';
            header("location:Admin/manage-admin.php");
        }

    }
    else{
        
    }
      

?>