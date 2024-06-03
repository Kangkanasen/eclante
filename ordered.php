<?php
// Start the session to access session variables
session_start();

// Include the database connection file
require 'components/connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve form data
    $userId = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zipCode = isset($_POST['zip_code']) ? mysqli_real_escape_string($conn, $_POST['zip_code']) : null;
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod']); // Retrieve payment method
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Insert into orders table
    $sql = "INSERT INTO `orders`(`name`, `address`, `city`, `state`, `zip`, `phone`, `payment_method`, `created_at`, `user_id`, `total`,`status`) 
            VALUES ('$name', '$address', '$city', '$state', '$zipCode', '$phone', '$paymentMethod', NOW(), '$userId', '$total','$status')";
    
    if (mysqli_query($conn, $sql)) {
        // Order inserted successfully
        // Retrieve the last inserted order ID
        $orderId = mysqli_insert_id($conn);

        // Retrieve product IDs and quantities from the cart table
        $productIds = array(); // Array to store product IDs
        $quantities = array(); // Array to store quantities

        $sql = "SELECT `product_id`, `quantity` FROM `cart` WHERE `user_id` = '$userId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Add product ID and quantity to respective arrays
                $productIds[] = $row['product_id'];
                $quantities[] = $row['quantity'];
            }
        }

        // Insert product IDs and quantities into ordered-products table
        for ($i = 0; $i < count($productIds); $i++) {
            $productId = mysqli_real_escape_string($conn, $productIds[$i]);
            $quantity = mysqli_real_escape_string($conn, $quantities[$i]);
            
            // Insert into ordered-products table
            $sql = "INSERT INTO `ordered-products`(`order_id`, `product_id`, `quantity`) 
                    VALUES ('$orderId', '$productId', '$quantity')";
            
            mysqli_query($conn, $sql);
        }

        // Delete rows from cart table when order done successfully
        $sql = "DELETE FROM `cart` WHERE `user_id` = '$userId'";
        mysqli_query($conn, $sql);

        // Redirect to success page or perform any other action
        header("Location: order-placed-successfully.php");
        exit();
    } else {
        // Error inserting order
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // User is not logged in
    echo "Unauthorized access. Please log in.";
}
?>
