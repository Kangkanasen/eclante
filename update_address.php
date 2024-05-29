<?php
session_start();
require 'components/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $address_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];

    $sql = "UPDATE addresses SET name = ?, address = ?, city = ?, state = ?, zip = ?, phone = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ssssssii", $name, $address, $city, $state, $zip, $phone, $address_id, $user_id);
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
