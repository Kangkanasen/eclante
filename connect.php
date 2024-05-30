
<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


// Database connection
include "components/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    

    // Check if email is already registered
    $checkUserQuery = $conn->prepare("SELECT id FROM users_signup WHERE email = ?");
    $checkUserQuery->bind_param("s", $email);
    $checkUserQuery->execute();
    $checkUserQuery->store_result();

    if ($checkUserQuery->num_rows > 0) {
        echo "Email already registered.";
    } else {
        // Insert user into database
        $insertUserQuery = $conn->prepare("INSERT INTO users_signup (name, email, password) VALUES (?, ?, ?)");
        $insertUserQuery->bind_param("sss", $name, $email, $password);
        if ($insertUserQuery->execute()) {
            $userId = $insertUserQuery->insert_id;
            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Insert verification code into database
            $insertCodeQuery = $conn->prepare("INSERT INTO email_verifications (user_id, verification_code) VALUES (?, ?)");
            $insertCodeQuery->bind_param("is", $userId, $verificationCode);
            $insertCodeQuery->execute();

            // Send verification email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'kangkanasenforever333@gmail.com';
                $mail->Password = 'yjmq hsmb lghi quor';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('no-reply@yourdomain.com', 'Mailer');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = 'Your verification code is: ' . $verificationCode;
                $mail->AltBody = 'Your verification code is: ' . $verificationCode;

                $mail->send();
                header("Location: verify-form.php?email=$email");
            } catch (Exception $e) {
                echo "Failed to send verification email. Mailer Error: {$mail->ErrorInfo}";
                $mail->SMTPDebug = 2;

            }
        } else {
            echo "Failed to register user.";
        }
    }

    $checkUserQuery->close();
}

$conn->close();
?>


