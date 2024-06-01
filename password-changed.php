<?php
// Database connection
include "components/connection.php";

// Ensure session is started
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to update your password.']);
    exit();
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new-password'])) {
    $newPassword = $_POST['new-password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the user's password in the database
    $updatePasswordQuery = $conn->prepare("UPDATE users_signup SET password = ? WHERE id = ?");
    $updatePasswordQuery->bind_param("si", $hashedPassword, $_SESSION['user_id']);

    if ($updatePasswordQuery->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password: ' . $conn->error]);
    }

    $updatePasswordQuery->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>
