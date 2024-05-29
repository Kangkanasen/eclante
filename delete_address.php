<?php
session_start();
require 'components/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $address_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM addresses WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ii", $address_id, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false];
    }
    $stmt->close();
    echo json_encode($response);
}
?>
