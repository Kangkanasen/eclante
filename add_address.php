<?php
session_start();
require 'components/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO addresses (user_id, name, address, city, state, zip, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("issssss", $user_id, $name, $address, $city, $state, $zip, $phone);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $address_id = $stmt->insert_id;
            $response = [
                'success' => true,
                'address' => [
                    'id' => $address_id,
                    'name' => htmlspecialchars($name),
                    'address' => htmlspecialchars($address),
                    'city' => htmlspecialchars($city),
                    'state' => htmlspecialchars($state),
                    'zip' => htmlspecialchars($zip),
                    'phone' => htmlspecialchars($phone)
                ]
            ];
        } else {
            $response = ['success' => false];
        }
        $stmt->close();
    } else {
        $response = ['success' => false];
    }

    echo json_encode($response);
}
?>
