<?php
include "components/connection.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users_signup (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful
        session_start(); // Start the session
        $_SESSION['user_id'] = mysqli_insert_id($conn); // Store the user ID in the session
        $_SESSION['user_name'] = $name; // Store the user's name in the session
        $_SESSION['user_email'] = $email; // Store the user's email in the session
        echo "<script>alert('Registration successful')</script>"; 
        echo "<script>location.href='index.php'</script>";
        exit(); // Exit after redirect
    } else {
        // Registration failed
        echo "<script>alert('Registration unsuccessful')</script>"; 
        echo "<script>location.href='signup.php'</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
