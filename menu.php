<?php include("config/constrants.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="<?php echo SITEURL; ?>"><img src="images/logo.png" alt="Terabyte"></a>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li><a href="<?php echo SITEURL; ?>/categories.php">Categories</a></li>
                        <li><a href="<?php echo SITEURL; ?>/food.php">Foods</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>