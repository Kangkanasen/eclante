<body>
    <section class="body login">
        <?php
        include "components/header.php";
        ?>

        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 95px 10px;">
            <h2 class="create">Create an Account</h2>
            <form class="signup-form" method="post" action="connect.php">
                <label class="label" for="name">Full Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
                <label class="label" for="email">Email</label>
                <input type="email" name="email" placeholder="Enter an email" required>
                <label class="label" for="Password">Create Password</label>
                <input type="text" name="password" placeholder="Create a password" required>
                <div style="display: flex; gap: 6px;">
                    <input class="checkbox" type="checkbox" style="height: 10px; width: 10px; margin-top: 2px;">
                    <p>I agree to the terms & policy</p>
                </div>
                <button type="submit" name="register">Signup</button>
            </form>
            <div class="btn-bottom">Already have an account? <a href="login.php">Sign In</a></div>
        </section>
    </section>

    <?php
    include "components/footer.php";
    ?>
    
</body>

</html>
