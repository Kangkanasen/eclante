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

                // Redirect to dashboard or another page
                header("Location: index.php");
                exit();
            } else {
                // User is not verified
                echo "<script>alert('Your account is not verified. Please verify your email first.')</script>"; 
                echo "<script>location.href='login.php'</script>"; // Redirect back to login page
            }
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect email or password.')</script>"; 
            echo "<script>location.href='login.php'</script>"; // Redirect back to login page
        }
    } else {
        // User does not exist
        echo "<script>alert('User does not exist.')</script>"; 
        echo "<script>location.href='login.php'</script>"; // Redirect back to login page
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
