<?php
session_start();
require 'components/connection.php'; // Include your database connection file

if (isset($_GET['order_id']) && isset($_SESSION['user_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the order belongs to the logged-in user and if it can be cancelled
    $sql = "SELECT * FROM `orders` WHERE `id` = ? AND `user_id` = ? AND `status` = 'pending'";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the order status to 'cancelled'
        $updateSql = "UPDATE `orders` SET `status` = 'cancelled' WHERE `id` = ?";
        $updateStmt = $conn->prepare($updateSql);
        if ($updateStmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $updateStmt->bind_param("i", $order_id);
        $updateStmt->execute();

        if ($updateStmt->affected_rows > 0) {
            echo "Order has been cancelled successfully.";
        } else {
            echo "Failed to cancel the order.";
        }
    } else {
        echo "Order not found or cannot be cancelled.";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
