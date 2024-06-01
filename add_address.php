<?php
session_start();
require 'components/connection.php'; // Database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Set the response header to application/json

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'] ?? '';
        $address = $_POST['address'] ?? '';
        $city = $_POST['city'] ?? '';
        $state = $_POST['state'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $phone = $_POST['phone'] ?? '';

        if ($name && $address && $city && $state && $zip && $phone) {
            $sql = "INSERT INTO addresses (user_id, name, address, city, state, zip, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                $response = ['success' => false, 'message' => 'Prepare failed: ' . htmlspecialchars($conn->error)];
            } else {
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
                    $response = ['success' => false, 'message' => 'Insert failed'];
                }

                $stmt->close();
            }
        } else {
            $response = ['success' => false, 'message' => 'Incomplete data'];
        }
    } else {
        $response = ['success' => false, 'message' => 'User not logged in'];
    }
} else {
    http_response_code(405); // Method Not Allowed
    $response = ['success' => false, 'message' => 'Method not allowed'];
}

echo json_encode($response);
?>
