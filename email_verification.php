<?php
// Database connection
include "components/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['verification_code'])) {
    $email = $_POST['email'];
    $verificationCode = $_POST['verification_code'];

    // Prepare statement to verify code
    $verifyCodeQuery = $conn->prepare("
        SELECT u.id
        FROM users_signup u
        JOIN email_verifications ev ON u.id = ev.user_id
        WHERE u.email = ? AND ev.verification_code = ?
    ");
    $verifyCodeQuery->bind_param("ss", $email, $verificationCode);
    $verifyCodeQuery->execute();
    $verifyCodeQuery->store_result();

    if ($verifyCodeQuery->num_rows > 0) {
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
            
            // Respond with success
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to verify email: ' . $conn->error]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        exit();
    }

    $verifyCodeQuery->close();
    $updateUserQuery->close();
}

$conn->close();
?>
