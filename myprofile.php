<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require 'components/connection.php'; // Database connection

$user_id = $_SESSION['user_id'];
$fullname = $dob = $gender = $email = $phone = '';
$totalSpent = 0;
$numOrders = 0;
$numAddresses = 0;

// Fetch total amount spent by the user
$sqlTotalAmount = "SELECT SUM(total) AS total_spent FROM orders WHERE user_id = ?";
$stmtTotalAmount = $conn->prepare($sqlTotalAmount);
$stmtTotalAmount->bind_param("i", $user_id);
$stmtTotalAmount->execute();
$stmtTotalAmount->bind_result($totalSpent);
$stmtTotalAmount->fetch();
$stmtTotalAmount->close();

// Fetch the number of orders made by the user
$sqlNumOrders = "SELECT COUNT(id) AS num_orders FROM orders WHERE user_id = ?";
$stmtNumOrders = $conn->prepare($sqlNumOrders);
$stmtNumOrders->bind_param("i", $user_id);
$stmtNumOrders->execute();
$stmtNumOrders->bind_result($numOrders);
$stmtNumOrders->fetch();
$stmtNumOrders->close();

// Fetch the number of addresses for the user
$sqlNumAddresses = "SELECT COUNT(id) AS num_addresses FROM addresses WHERE user_id = ?";
$stmtNumAddresses = $conn->prepare($sqlNumAddresses);
$stmtNumAddresses->bind_param("i", $user_id);
$stmtNumAddresses->execute();
$stmtNumAddresses->bind_result($numAddresses);
$stmtNumAddresses->fetch();
$stmtNumAddresses->close();

// Fetch user data from the database
$sql = "SELECT name, dob, gender, email, phone FROM users_signup WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
  die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fullname, $dob, $gender, $email, $phone);
$stmt->fetch();
$stmt->close();

// Update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $sql = "UPDATE users_signup SET name = ?, dob = ?, gender = ?, email = ?, phone = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
  }
  $stmt->bind_param("sssssi", $fullname, $dob, $gender, $email, $phone, $user_id);
  $stmt->execute();
  $stmt->close();

  // Refresh the page to reflect the updated data
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>

<body class="body">
  <?php
  include "components/header.php";
  ?>

  <div class="myorders">


    <div class="sidenav">
      <h1>username</h1>
      <h2>omuk@gmail.com</h2>

      <div class="pages">
        <div class="box clicked">
          <a href="#">
            <img src="images/btn1.png" alt="Image 1">
            My profile
          </a>
        </div>
        <div class="box">
          <a href="myorders.php">
            <img src="images/btn2.svg" alt="Image 2">
            Orders
          </a>
        </div>
        <div class="box">
          <a href="#">
            <img src="images/btn3.svg" alt="Image 3">
            Rewards
          </a>
        </div>
        <div class="box">
          <a href="addresses.php">
            <img src="images/btn4.svg" alt="Image 4">
            Addresses
          </a>
        </div>
        <div class="box">
          <a href="#">
            <img src="images/btn5.svg" alt="Image 5">
            Change password
          </a>
        </div>
        <div class="box">
          <a href="#">
            <img src="images/btn6.svg" alt="Image 6">
            FAQ
          </a>
        </div>
        <div class="box last">
          <a href="logout.php">
            <img src="images/btn7.png" alt="Image 7">
            <span>Logout</span>
          </a>
        </div>
      </div>
    </div>
    <section>
      <div class="tracker">

        <div class="track">
          <h2>Total Spent</h2>
          <h2><?php echo $totalSpent; ?></h2>
        </div>
        <div class="track">
          <h2>All Orders</h2>
          <h2><?php echo $numOrders; ?></h2>
        </div>

        <div class="track">
          <h2>Addresses</h2>
          <h2><?php echo htmlspecialchars($numAddresses); ?></h2>
        </div>
      </div>
      <form action="myprofile.php" method="POST">
        <h2>Profile Information</h2>
        <br>
        <hr>
        <br>
        <label for="fullname">Full Name</label>
        <input name="fullname" type="text" value="<?php echo htmlspecialchars($fullname); ?>"><br><br>
        <div style="display: flex; width: 90%;">
          <div style="display: flex; flex-direction: column; width: 50%;">
            <label for="dob">Date of Birth</label>
            <input name="dob" type="date" value="<?php echo htmlspecialchars($dob); ?>">
          </div>
          <div style="display: flex; flex-direction: column; width: 20%;">
            <label for="gender">Gender</label>
            <select name="gender" id="">
              <option value="select" class="hidden" <?php echo $gender == '' ? 'selected' : ''; ?>>Select</option>
              <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
              <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
              <option value="Others" <?php echo $gender == 'Others' ? 'selected' : ''; ?>>Others</option>
            </select>
          </div>
        </div>
        <br><br>
        <h2>Contact Methods</h2>
        <br>
        <hr>
        <br>
        <div style="display: flex; width: 90%;">
          <div style="display: flex; flex-direction: column; width: 50%;">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
          </div>
          <div style="display: flex; flex-direction: column; width: 50%;">
            <label for="phone">Phone</label>
            <input placeholder="+ 91" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
          </div>
        </div>
        <br><br>
        <button class="update-btn" type="submit">Update</button>
      </form>
    </section>
  </div>
</body>

</html>