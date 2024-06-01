<body>
    <section class="body login">
        <?php include "components/header.php"; ?>

        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 95px 10px;">
            <h2 class="create">Verify</h2>
            <p class="label" style="margin-bottom: 50px; font-weight: 300;">We have sent a verification code to your email</p>
            <form class="signup-form" id="verification-form">
                <label class="label" for="verification_code">Verification code</label>
                <input type="text" id="verification_code" name="verification_code" minlength="6" maxlength="6" placeholder="Enter your verification code" style="margin-bottom: 2px !important;" required>
                <!-- invalid messege -->
                <p id="error-message" style=" width:100%; color: red; display: none; font-family: Inter; font-size: 10px; margin-bottom: 20px; display: flex; justify-content: flex-end;"></p>
                <?php if (isset($_GET['email'])) : ?>
                    <input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
                <?php endif; ?>
                <button type="submit" class="action">Verify Me</button>
            </form>
            
        </section>
    </section>

    <?php include "components/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#verification-form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting the traditional way

                $.ajax({
                    type: 'POST',
                    url: 'email_verification.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            window.location.href = 'index.php'; // Redirect on success
                        } else {
                            $('#error-message').text(data.message).show(); // Show error message
                        }
                    }
                });
            });
        });
    </script>
</body>
