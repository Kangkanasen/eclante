<?php
// check_favorites.php
session_start();
include "components/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['productId'];

    // Check if the product is in favorites for the user
    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false"; // If the user is not logged in or if the request method is not POST
}
?>
