<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>


<body>
    <section class="body">
        <?php
        include "components/header.php";
        ?>
    </section>
    <section class="banner">
        <div id="carousel-container">
            <div id="image-carousel">
                <div class="carousel-item">
                    <img src="images/Outdoor-Cosmetics-Branding-Mockup-vol2 4.png" alt="Image 1">
                    <div class="carousel-text">
                        <h1>Unveil Your Radiance with Eclanté</h1>
                        <p><span>Experience the transformative power of our Radiance Reveal Face Serum.</span> Watch as your skin glows with luminosity and radiance. Embrace the allure of enchanting beauty. Eclanté – Elevate Your Skincare Ritual</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/Outdoor-Cosmetics-Branding-Mockup-vol2 4 (1).png" alt="Image 2">
                    <div class="carousel-text">
                        <h1>Unveil Your Radiance with Eclanté</h1>
                        <p><span>Experience the transformative power of our Radiance Reveal Face Serum.</span> Watch as your skin glows with luminosity and radiance. Embrace the allure of enchanting beauty. Eclanté – Elevate Your Skincare Ritual</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/Outdoor-Cosmetics-Branding-Mockup-vol2 4 (2).png" alt="Image 3">
                    <div class="carousel-text">
                        <h1>Unveil Your Radiance with Eclanté</h1>
                        <p><span>Experience the transformative power of our Radiance Reveal Face Serum.</span> Watch as your skin glows with luminosity and radiance. Embrace the allure of enchanting beauty. Eclanté – Elevate Your Skincare Ritual</p>
                    </div>
                </div>
            </div>

            <div id="dot-container"></div>
        </div>
        <script src="js/image-carousel.js"></script>
    </section>
    <section class="body">
        <section class="all-products">
            <div class="header">
                <h1>All Products</h1>

            </div>


            <div class="slider-container products">
                <?php
                include "components/all-products.php";
                ?>
            </div>
        </section>
    </section>
    <?php
    include "components/footer.php";
    ?>
</body>

</html>