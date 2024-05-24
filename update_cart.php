<?php
session_start();
require 'components/connection.php';

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        $productId = mysqli_real_escape_string($conn, $_POST['productId']);
        $quantity = intval($_POST['quantity']);
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `user_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $productId, $userId);
            if (mysqli_stmt_execute($stmt)) {
                http_response_code(200);
                echo "Quantity updated successfully.";
            } else {
                http_response_code(500);
                echo "Error updating quantity: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            http_response_code(500);
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        http_response_code(400);
        echo "Product ID and quantity are required.";
    }
} else {
    http_response_code(401);
    echo "Unauthorized access. Please log in.";
}
?>
