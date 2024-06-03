<?php
session_start();
include "components/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<script>location.href='login.php'</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['productId'];

    // Check if the product is already in favorites
    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert the product into the favorites table
        $insert_sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
            echo "Product added to favorites!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Product is already in favorites.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
