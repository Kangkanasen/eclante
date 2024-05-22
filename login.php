<body>

    <section class="body login">

        <?php
        include "components/header.php";
        ?>

        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 95px 10px;">
            <h2 class="create">Welcome back!</h2>
            <form class="signup-form" method="post" action="authenticate.php">

                <label class="label" for="email">Email Address</label>
                <input type="email" placeholder="Enter your email" name="email" required>
                <label class="label" for="Password">Password</label>
                <input type="password" placeholder="Enter your password" name="password" required>
                <div style="display: flex; gap: 6px;">
                    <input class="checkbox" type="checkbox" name="remember_me" style="height: 10px; width: 10px; margin-top: 2px;">
                    <p>Remember me</p>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="btn-bottom">Don’t have an account? <a href="signup.php">Sign Up</a></div>
        </section>
    </section>
    <?php
    include "components/footer.php";
    ?>

</body>

</html>