<?php include("parcials/menu.php");

    $id = $_GET["id"];
    $query = "SELECT * FROM Users WHERE id = $id";
    $result = mysqli_query($connect, $query);
    if($result){
        if($result -> num_rows == 1){
            $row = $result -> fetch_assoc();
            $password = $row["Password"];   
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
                <h2>Password Change</h2>
            </div>
            <?php 
                if(isset($_SESSION["password"])){
                    echo $_SESSION["password"];
                    unset($_SESSION["password"]);
                }
                if(isset($_SESSION["password-match"])){
                    echo $_SESSION["password-match"];
                    unset($_SESSION["password-match"]);
                }
                if(isset($_SESSION["password-update"])){
                    echo $_SESSION["password-update"];
                    unset($_SESSION["password-update"]);
                }
            ?>
            <form action="" method="POST" class="form">
                <label for="fullname" >
                    Old Password<input type="password" class="pad radius full-width" name="old-password" required>
                </label>
                <label for="username">
                    New Password <input type="password" class="pad radius full-width" name="new-password" required>
                </label>
                <label for="username">
                    Confirm Password <input type="password" class="pad radius full-width" name="confirm-password" required>
                </label>
                <input type="submit" name="update-password" class="btn-update radius" value="Update Password">
                <a href="manage-admin.php" class="btn-danger radius">Cancel</a>
            </form>
        </div>
    </section>

<?php include("parcials/footer.php"); ?>
<?php 

    if (isset($_POST["update-password"])) {

        $current_password = md5($_POST["old-password"]);
        $new_password = md5($_POST["new-password"]);
        $confirm_password = md5($_POST["confirm-password"]);

        if($current_password == $password){
            if($new_password == $confirm_password){

                $query2 = "UPDATE Users SET 
                    Password = '$new_password' 
                    WHERE id = $id
                ";
                
                $result = mysqli_query($connect,$query2);
                if($result){
                    $_SESSION["password-update"] = "<div class='success'>password updated successfully.</div>";
                    header("location:".SITEURL."Admin/manage-admin.php");
                }
                else{
                    $_SESSION["password-update"] = "<div class='failed centerone'>something went wrong on database</div>";
                    header("location:password-update.php?id=$id");
                }

            }
            else{
                $_SESSION["password-match"] = "<div class='failed centerone'>passwords did not match.</div>";
                header("location:password-update.php?id=$id");
            }
        }
        else{
            $_SESSION["password"] = "<div class='failed centerone'>current password is incorrect.</div>";
            header("location:password-update.php?id=$id");
        }
    }

?>