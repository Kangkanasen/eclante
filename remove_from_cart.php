<?php
// Start the session to access session variables
session_start();

// Include the database connection file
require 'components/connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check if cart item ID is provided in the request
    if (isset($_POST['cartItemId'])) {
        // Sanitize input
        $cartItemId = mysqli_real_escape_string($conn, $_POST['cartItemId']);

        // Fetch the cart item from the database
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM `cart` WHERE `id` = '$cartItemId' AND `user_id` = '$userId'";
        $result = mysqli_query($conn, $sql);

        // Check if the cart item exists
        if (mysqli_num_rows($result) == 1) {
            // Remove the cart item from the database
            $deleteSql = "DELETE FROM `cart` WHERE `id` = '$cartItemId'";
            if (mysqli_query($conn, $deleteSql)) {
                // Return success response
                http_response_code(200);
                echo json_encode(["message" => "Product removed from cart successfully."]);
            } else {
                // Return error response
                http_response_code(500);
                echo json_encode(["error" => "Error removing product from cart: " . mysqli_error($conn)]);
            }
        } else {
            // Return error response if cart item doesn't belong to the user or doesn't exist
            http_response_code(404);
            echo json_encode(["error" => "Cart item not found."]);
        }
    } else {
        // Return error response if cart item ID is not provided
        http_response_code(400);
        echo json_encode(["error" => "Cart item ID is required."]);
    }
} else {
    // Return error response if user is not logged in
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access. Please log in."]);
}
?>
