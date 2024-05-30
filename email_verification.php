<?php
// Database connection
include "components/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
    $email = $_POST['email'];
    $verificationCode = $_POST['verification_code'];

    // Verify code logic ...

    // Update verification status
    $updateUserQuery = $conn->prepare("UPDATE users_signup SET is_verified = 1 WHERE email = ?");
    $updateUserQuery->bind_param("s", $email);
    if ($updateUserQuery->execute()) {
        // Start a session upon successful verification
        session_start();
        
        // Retrieve user data
        $getUserQuery = $conn->prepare("SELECT id, email FROM users_signup WHERE email = ?");
        $getUserQuery->bind_param("s", $email);
        $getUserQuery->execute();
        $getUserResult = $getUserQuery->get_result();
        $userData = $getUserResult->fetch_assoc();
        
        // Store user data in session variables
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_email'] = $userData['email'];
        
        // Redirect to dashboard or another page
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to verify email: " . $conn->error; // Print error message
    }

    $updateUserQuery->close();
}

$conn->close();
?>
