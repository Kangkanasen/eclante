<?php
session_start();
require 'components/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $address_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Unset the previous default address
    $unset_sql = "UPDATE addresses SET is_default = 0 WHERE user_id = ?";
    $unset_stmt = $conn->prepare($unset_sql);
    if ($unset_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $unset_stmt->bind_param("i", $user_id);
    $unset_stmt->execute();
    $unset_stmt->close();

    // Set the new default address
    $set_sql = "UPDATE addresses SET is_default = 1 WHERE id = ? AND user_id = ?";
    $set_stmt = $conn->prepare($set_sql);
    if ($set_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $set_stmt->bind_param("ii", $address_id, $user_id);
    $set_stmt->execute();

    if ($set_stmt->affected_rows > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false];
    }
    $set_stmt->close();
    echo json_encode($response);
}
?>
