<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <section class="body login">
        <?php include "components/header.php"; ?>
        
        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 95px 10px;">
            <h2 class="create">Welcome back!</h2>
            <form id="login-form" class="signup-form" method="post">
                <label class="label" for="email">Email Address</label>
                <input type="email" placeholder="Enter your email" name="email" required>
                <label class="label" for="Password">Password</label>
                <input type="password" placeholder="Enter your password" name="password" required>
                <p id="error-message" style="width:100%; color: red; display: none; margin-bottom: 20px; margin-top:5px; font-family: Inter; font-size: 10px; display: flex; justify-content: flex-end;"></p>
                <button type="submit">Login</button>
            </form>
            <div class="btn-bottom">Don’t have an account? <a href="signup.php">Sign Up</a></div>
        </section>
    </section>
    
    <?php include "components/footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Clear any previous error message
                $('#error-message').hide().text('');

                $.ajax({
                    type: 'POST',
                    url: 'authenticate.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = 'index.php'; // Redirect on successful login
                        } else {
                            $('#error-message').text(response.message).show(); // Show error message
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#error-message').text('An error occurred while processing your request.').show();
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>
</html>
