<?php
session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="body">
        <?php
        include "components/header.php";

        ?>

        <div class="myorders">
            <div class="sidenav">
                <h1>username</h1>
                <h2>omuk@gmail.com</h2>

                <div class="pages">
                    <div class="box">
                        <a href="myprofile.php">
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
                        <a href="rewards.php">
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
                    <div class="box clicked">
                        <a href="change-password.php">
                            <img src="images/btn5.svg" alt="Image 5">
                            Change password
                        </a>
                    </div>
                    <div class="box">
                        <a href="faq.php">
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
            <section class="orders">
                <h2>Change password</h2>
                <br>
                <hr><br>
                <form id="password-form" method="post" action="password-changed.php">
                    <label class="label" for="new-password">New password</label>
                    <input type="password" id="new-password" name="new-password" required>
                    <br><br>
                    <label class="label" for="confirm-password">Confirm new password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <p id="error-message" style="width:100%; color: red; display: none; margin-bottom: 20px; margin-top:5px; font-family: Inter; font-size: 10px; display: flex; justify-content: flex-end;"></p>
                    <button class="update-btn" type="submit">Update</button>
                </form>
            </section>
        </div>
        <div id="notification" class="notification"></div>
    </div>
    <?php
    include "components/footer.php"
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var notification = document.getElementById('notification');
            <?php if (isset($_SESSION['notification'])) : ?>
                notification.innerHTML = "<?php echo $_SESSION['notification']; ?>";
                notification.classList.add('show');
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 2000); // 2 seconds
                <?php unset($_SESSION['notification']); ?>
            <?php endif; ?>

            var form = document.getElementById('password-form');
            form.addEventListener('submit', function(event) {
                var newPassword = document.getElementById('new-password').value;
                var confirmPassword = document.getElementById('confirm-password').value;

                if (newPassword !== confirmPassword) {
                    event.preventDefault();
                    document.getElementById('error-message').textContent = 'Passwords do not match.';
                    document.getElementById('error-message').style.display = 'flex';
                }
            });
        });
    </script>
</body>

</html>