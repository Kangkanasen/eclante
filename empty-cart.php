<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>

<body>
    <div class="body">
        <?php
        include "components/header.php";
        ?>

        <section class="empty-cart ">
            <h1>Your Cart is Empty</h1>

            <div>
                <a href="shop-now.php">SHOP</a>
                <a href="product-page.php?id=8">GLOW WITH DUO</a>
            </div>
            <div>
                <a href="search-results.php?q=radiance" class="static-suggestion">RADIANCE</a>
                <a href="search-results.php?q=brilliance" class="static-suggestion">BRILLIANCE</a>
            </div>
            <a href="index.php">ABOUT</a>

        </section>
    </div>

    <?php
    include "components/footer.php"
    ?>
</body>