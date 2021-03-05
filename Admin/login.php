<?php include("../config/constrants.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
     <!-- main content -->
     <section class="login-content">
        <div class="wrapper">
            <div class="sub-content">
                <div class="title text-center">
                    <h2>Login</h2>
                </div>
                <?php 
                    if(isset($_SESSION["login-failed"])){
                        echo $_SESSION["login-failed"];
                        unset($_SESSION["login-failed"]);
                    }
                ?>
                <form action="" method="POST" class="form">
                    <label for="username">
                        Username <input type="text" class="pad radius full-width" name="username" id="" required>
                    </label>
                    <label for="password">
                        Password <input type="password" class="pad radius full-width" name="password" id="" required>
                    </label>
                    <input type="submit" name="login" class="btn-add radius" value="Login">
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php 

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $query = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password'";
        $result = mysqli_query($connect,$query);

        if($result){
            
            if($result -> num_rows == 1){

                $_SESSION["username"] = $username;
                header("location:".SITEURL."admin/manage-admin.php");
            }
            else{
                $_SESSION["login-failed"] = "<div class='failed centerone'>Incorrect username or password</div>";
                header("location:".SITEURL."admin/login.php");
            }
        }
        else{
            echo "database error";
        }
    }

?>

