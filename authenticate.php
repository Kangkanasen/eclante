<?php
include "components/connection.php";

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Convert email to lowercase for case-insensitive comparison
    $email = strtolower($email);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, email, password, is_verified FROM users_signup WHERE LOWER(email) = ?");
    $stmt->bind_param("s", $email);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, retrieve hashed password and verification status from the database
        $row = $result->fetch_assoc();
        $hashed_password_db = $row['password'];
        $is_verified = $row['is_verified'];

        // Verify if the entered password matches the hashed password from the database
        if (password_verify($password, $hashed_password_db)) {
            // Password is correct
            if ($is_verified) {
                // Start a session
                session_start();
                // Store user data in session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];

                // Return success response
                echo json_encode(['success' => true]);
                exit();
            } else {
                // User is not verified
                echo json_encode(['success' => false, 'message' => 'Your account is not verified. Please verify your email first.']);
                exit();
            }
        } else {
            // Incorrect password
            echo json_encode(['success' => false, 'message' => 'Incorrect email or password.']);
            exit();
        }
    } else {
        // User does not exist
        echo json_encode(['success' => false, 'message' => 'User does not exist.']);
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
