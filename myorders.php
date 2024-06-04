<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require "components/connection.php";

$user_id = $_SESSION['user_id'];
?>

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
                <div class="box clicked">
                    <a href="#">
                        <img src="images/btn2.svg" alt="Image 2">
                        Orders
                    </a>
                </div>
                <div class="box">
                    <a href="rewards.php">
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
                <div class="box">
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
            <h2>Your Orders</h2>
            <br>
            <hr><br>
            <div class="ordered-products">
                <?php
                // Fetch orders for the logged-in user
                $sql = "SELECT * FROM `orders` WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if any orders are found
                if ($result->num_rows > 0) {
                    // Loop through each order
                    while ($order = $result->fetch_assoc()) {
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
                        echo "<h3>₹" . $order['total'] . "</h3>"; // Assuming 'total' is the column storing order total
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

                        // Calculate estimated delivery date
                        $estimatedDeliveryDate = date('Y-m-d', strtotime('+3 days', strtotime($order['created_at'])));
                        $currentDate = date('Y-m-d');

                        // Display estimated delivery or delivered date
                        echo "<div class='delivery-date'>";
                        if ($order['status'] === 'cancelled') {
                            echo "Order has been cancelled";
                        } elseif ($currentDate < $estimatedDeliveryDate) {
                            echo "Estimate Delivery by " . date('m/d/Y', strtotime($estimatedDeliveryDate));
                        } else {
                            echo "Delivered on " . date('m/d/Y', strtotime($estimatedDeliveryDate));
                        }

                        // Display the download button for each order
                        echo "<form action='invoice.php' method='post'>";
                        echo "<input type='hidden' name='order_id' value='" . $order['id'] . "'>";
                        echo "<button style='background-color:transparent; padding:8px; font-family: Inter; border-radius:6px; border:1px solid #ffbcbc; cursor:pointer;' type='submit' name='download_invoice'><i class='fa-solid fa-floppy-disk' style='color: #ffbcbc; margin-right:8px;'></i> Invoice</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "<br><br>";

                        // Fetch ordered products data
                        $orderId = $order['id'];
                        $orderedProductsSql = "SELECT op.*, p.name AS product_name, p.image_url, p.mrp, p.offer FROM `ordered-products` AS op JOIN `products` AS p ON op.product_id = p.id WHERE op.order_id = ?";
                        $stmtProducts = $conn->prepare($orderedProductsSql);
                        if ($stmtProducts === false) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmtProducts->bind_param("i", $orderId);
                        $stmtProducts->execute();
                        $orderedProductsResult = $stmtProducts->get_result();

                        // Check if any products are found for the current order
                        if ($orderedProductsResult->num_rows > 0) {
                            // Loop through each ordered product
                            while ($product = $orderedProductsResult->fetch_assoc()) {
                                $actualPrice = $product['mrp'] * ((100 - $product['offer']) / 100);

                                echo "<div class='display-product'>";
                                echo "<div class='quantity'>" . $product['quantity'] . "</div>"; // Display quantity
                                echo "<div class='col1'><img src='images/" . $product['image_url'] . "' alt='an image of your order'></div>";
                                echo "<div class='col2'>";
                                echo "<div class='name'>" . $product['product_name'] . "</div>";

                                // Display "Buy Again" or "Cancel" button based on the delivery date
                                if ($order['status'] === 'cancelled') {
                                    echo "<a href='#' onclick=\"addToCart(" . $product['product_id'] . ", 1, " . $actualPrice . ")\">Buy Again</a>";
                                } elseif ($currentDate < $estimatedDeliveryDate) {
                                    echo "<a class='cancel-btn' href='cancel-order.php?order_id=" . $order['id'] . "'>Cancel</a>";
                                } else {
                                    echo "<a href='#' onclick=\"addToCart(" . $product['product_id'] . ", 1, " . $actualPrice . ")\">Buy Again</a>";
                                }

                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        echo "</div>"; // Close 'an-order' div
                    }
                } else {
                    // Display message if no orders are found
                    echo "<div class='no-orders' style='width:100%; display:flex; flex-direction:column; justify-content:center; align-items:center; margin-top:50px;'>";
                    echo "<img src='images/paper-bag.png' alt=''>";
                    echo "You don't have any orders yet";
                    echo "<a class='start-shopping' href='shop-now.php'>START SHOPPING</a>";
                    echo "</div>";
                }

                $conn->close();
                ?>
            </div>


        </section>
    </div>
    <?php
    include "components/footer.php"
    ?>
</body>
<script>
    function addToCart(productId, quantity, price) {
        console.log("Product ID:", productId);
        console.log("Quantity:", quantity);
        console.log("Price:", price);

        $.ajax({
            type: "POST",
            url: "add_to_cart.php",
            data: {
                productId: productId,
                productQuantity: quantity,
                productPrice: price
            },
            success: function(data) {
                alert("Product added to cart!");
            },
            error: function(xhr, status, error) {
                alert("An error occurred while adding the product to cart.");
                console.log(xhr.responseText);
            }
        });
    }
</script>

</html>