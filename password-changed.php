<?php
// Database connection
include "components/connection.php";

// Ensure session is started
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['notification'] = 'You must be logged in to update your password.';
    header('Location: change-password.php');
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
        $_SESSION['notification'] = 'Password updated successfully.';
        header('Location: change-password.php');
        exit();
    } else {
        $_SESSION['notification'] = 'Failed to update password: ' . $conn->error;
        header('Location: change-password.php');
        exit();
    }

    $updatePasswordQuery->close();
} else {
    $_SESSION['notification'] = 'Invalid request.';
    header('Location: change-password.php');
    exit();
}

$conn->close();
?>
