<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="body">
    <?php
    include "components/header.php";
    ?>

    <div class="myorders">

        <div class="sidenav">
            <h1>username</h1>
            <h2>omuk@gmail.com</h2>

            <div class="pages">
                <div class="box">
                    <a href="myprofile.php">
                        <img src="images/btn1.png" alt="Image 1">
                        My profile
                    </a>
                </div>
                <div class="box">
                    <a href="#">
                        <img src="images/btn2.svg" alt="Image 2">
                        Orders
                    </a>
                </div>
                <div class="box">
                    <a href="#">
                        <img src="images/btn3.svg" alt="Image 3">
                        Rewards
                    </a>
                </div>
                <div class="box">
                    <a href="addresses.php">
                        <img src="images/btn4.svg" alt="Image 4">
                        Addresses
                    </a>
                </div>
                <div class="box">
                    <a href="change-password.php">
                        <img src="images/btn5.svg" alt="Image 5">
                        Change password
                    </a>
                </div>
                <div class="box clicked">
                    <a href="faq.php">
                        <img src="images/btn6.svg" alt="Image 6">
                        FAQ
                    </a>
                </div>
                <div class="box last">
                    <a href="logout.php">
                        <img src="images/btn7.png" alt="Image 7">
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <section class="orders">
            <h2>FAQ</h2>
            <br>
            <hr><br>
            
        </section>
    </div>

</body>

</html>