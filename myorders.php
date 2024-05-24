<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
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
                    <a href="#">
                        <img src="images/btn1.png" alt="Image 1">
                        My profile
                    </a>
                </div>
                <div class="box clicked">
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
                    <a href="#">
                        <img src="images/btn4.svg" alt="Image 4">
                        Addresses
                    </a>
                </div>
                <div class="box">
                    <a href="#">
                        <img src="images/btn5.svg" alt="Image 5">
                        Change password
                    </a>
                </div>
                <div class="box">
                    <a href="#">
                        <img src="images/btn6.svg" alt="Image 6">
                        FAQ
                    </a>
                </div>
                <div class="box last">
                    <a href="#">
                        <img src="images/btn7.png" alt="Image 7">
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <section class="orders">



            <h2>Your Orders</h2>
            <br>
            <hr><br>
            <div class="ordered-products">
                <?php

                require "components/connection.php";
                $sql = "SELECT * FROM `orders`";
                $result = mysqli_query($conn, $sql);

                // Check if any orders are found
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each order
                    while ($order = mysqli_fetch_assoc($result)) {
                        echo "<div class='an-order'>";
                        echo "<div class='details'>";
                        echo "<div class='info'>";
                        echo "<h3>ORDER PLACED</h3>";
                        echo "<br>";
                        echo "<h3>" . $order['created_at'] . "</h3>"; // Assuming 'created_at' is the column storing order placement date
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<h3>TOTAL</h3>";
                        echo "<br>";
                        echo "<h3>$" . $order['total'] . "</h3>"; // Assuming 'total' is the column storing order total
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<h3>SHIP TO</h3>";
                        echo "<br>";
                        echo "<h3>" . $order['name'] . "</h3>"; // Assuming 'name' is the column storing user's full name
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<h3>ORDER ID</h3>";
                        echo "<br>";
                        echo "<h3>" . $order['id'] . "</h3>"; // Assuming 'id' is the primary key of the 'orders' table
                        echo "</div>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='delivery-date'>";
                        echo "Estimate Delivery by " . date('m/d/Y', strtotime('+3 days', strtotime($order['created_at']))); // Assuming delivery takes 3 days
                        echo "</div>";
                        echo "<br><br>";

                        // Fetch ordered products data
                        $orderId = $order['id'];
                        $orderedProductsSql = "SELECT op.*, p.name AS product_name, p.image_url FROM `ordered-products` AS op JOIN `products` AS p ON op.product_id = p.id WHERE op.order_id = '$orderId'";
                        $orderedProductsResult = mysqli_query($conn, $orderedProductsSql);

                        // Check if any products are found for the current order
                        if (mysqli_num_rows($orderedProductsResult) > 0) {
                            // Loop through each ordered product
                            while ($product = mysqli_fetch_assoc($orderedProductsResult)) {
                                echo "<div class='display-product'>";
                                echo "<div class='quantity'>" . $product['quantity'] . "</div>"; // Display quantity
                                echo "<div class='col1'><img src='images/" . $product['image_url'] . "' alt='an image of your order'></div>";
                                echo "<div class='col2'>";
                                echo "<div class='name'>" . $product['product_name'] . "</div>";
                                echo "<a href='#'>Buy Again</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        echo "</div>"; // Close 'an-order' div
                    }
                } else {
                    // Display message if no orders are found
                    echo "No orders found.";
                }
                ?>
            </div>
        </section>
    </div>

</body>
<!-- <?php
// include "components/footer.php";
?> -->