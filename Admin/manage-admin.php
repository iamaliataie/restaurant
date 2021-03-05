<?php include("parcials/menu.php") ?>

<section class="main-content">
        <div class="wrapper">

            <div class="title">
                <h2>Manage Admins</h2>
            </div>
            <?php if(isset($_SESSION["user_added"])){
                echo $_SESSION["user_added"];
                unset($_SESSION["user_added"]);
                }
                if(isset($_SESSION["user_deleted"])){
                    echo $_SESSION["user_deleted"];
                    unset($_SESSION["user_deleted"]);
                }
                if(isset($_SESSION["update"])){
                    echo $_SESSION["update"];
                    unset($_SESSION["update"]);
                }
                if(isset($_SESSION["password-update"])){
                    echo $_SESSION["password-update"];
                    unset($_SESSION["password-update"]);
                }
                if(isset($_SESSION["user-not-found"])){
                    echo $_SESSION["user-not-found"];
                    unset($_SESSION["user-not-found"]);
                }
            ?>
            <div class="add-button">
                <a href="add-admin.php" class="btn-add radius" >Add Admin</a>
            </div>
            <table class="full-width tbl">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $rows = 1;
                    $query = "SELECT * FROM Users";
                    $result = mysqli_query($connect,$query);
                    if($result){
                        if($result -> num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $fullname = $row["Fullname"];
                                $username = $row["Username"];
                                $id = $row["id"];
                                if($rows%2 == 0){
                                ?>
                                    <tr class="text-center colored-row">
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="password-update.php?id=<?php echo $id; ?>" class="btn-add radius">Change Password</a>
                                            <a href="update-user.php?id=<?php echo $id;?>" class="btn-update radius">update</a>
                                            <a href="delete-user.php?id=<?php echo $id; ?>" class="btn-danger radius">delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }else{ ?>
                                        <tr class="text-center">
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="password-update.php?id=<?php echo $id; ?>" class="btn-add radius">Change Password</a>
                                            <a href="update-user.php?id=<?php echo $id; ?>" class="btn-update radius">update</a>
                                            <a href="delete-user.php?id=<?php echo $id; ?>" class="btn-danger radius">delete</a>
                                        </td>
                                    </tr>
                                <?php }
                                $rows += 1; 
                            }
                        }else{?>
                            <tr class="text-center nothing-to-show">
                                        <td colspan="4">Nothing to show</td>
                                    </tr>
                        <?php }
                    }
                ?>
                
            </table>
        </div>
    </section>

<?php include("parcials/footer.php") ?>