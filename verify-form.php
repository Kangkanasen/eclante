<body>
    <section class="body login">
        <?php
        include "components/header.php";
        ?>

        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 95px 10px;">
            <h2 class="create">Verify</h2>
            <p class="label" style="margin-bottom: 50px; font-weight:300;">We have sent a verification code to your email</p>
            <form class="signup-form" method="post" action="email_verification.php">
                <label class="label" for="name">Verification code</label>
                <input type="text" name="verification_code" minlength="6" maxlength="6" placeholder="Enter your verification code" required>
                <?php if (isset($_GET['email'])) : ?>
                    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                <?php endif; ?>
                <button type="submit" name="verify" class="action">Verify Me</button>
            </form>


            </div>
        </section>
    </section>

    <?php
    include "components/footer.php";
    ?>

</body>

</html>