<?php
session_start();
require 'components/connection.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST and if the productId is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"])) {

    // Sanitize and validate the input data
    $productId = intval($_POST["productId"]);
    $productQuantity = intval($_POST["quantity"]);
    $productPrice = floatval($_POST["price"]);
    // Extract the POST data
    extract($_POST);

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Check if the product with the same size already exists in the cart
        $sql = "SELECT * FROM `cart` WHERE `user_id` = '".$_SESSION['user_id']."' AND `product_id` = '$productId'";
        // Debugging: Display SQL query
        echo "Debug: SQL Query: $sql<br>";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            // If the product with the same size exists, update its quantity
            $row = mysqli_fetch_assoc($result);
            $newQuantity = $row['quantity'] + $productQuantity;

            $sql = "UPDATE `cart` SET `quantity` = $newQuantity WHERE `user_id` = '".$_SESSION['user_id']."' AND `product_id` = '$productId'";
            // Debugging: Display SQL query
            echo "Debug: SQL Query: $sql<br>";
            $query = mysqli_query($conn, $sql);
        } else {
            // If the product with the same size doesn't exist, insert a new record
            $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `price`, `time`) 
                    VALUES ('".$_SESSION['user_id']."', '$productId', '$productQuantity', '$productPrice', NOW())";
            // Debugging: Display SQL query
            echo "Debug: SQL Query: $sql<br>";
            $query = mysqli_query($conn, $sql);
        }

        // Check if the query was successful
        if ($query) {
            echo "<script>alert('Product added to your cart!')</script>"; 
            echo "<script>location.href='shop-now.php'</script>";
        } else {
            echo "<script>alert('An error occurred while adding the product to your cart.')</script>";
            echo "<script>location.href='shop-now.php'</script>";
        }
    } else {
        echo "<script>alert('User not logged in')</script>"; 
        echo "<script>location.href='login.php'</script>";
    }
}
?>
