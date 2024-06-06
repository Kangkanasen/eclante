<?php
session_start();
include "product-info-fetch.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>


<body>
    <section class="body product-page">
        <?php
        include "components/header.php";
        ?>
        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="productId" value="<?php echo $product_id; ?>">
            <input type="hidden" name="price" value="<?php echo $actual_price; ?>">

            <section class="product-page-body">
                <div class="label">
                    <a href="index.php">home</a>/<a href="shop-now.php">shop</a>/<a href=""><?php echo $name; ?></a>
                </div>
                <div class="product">
                    <div class="all-imgs">
                        <div class="other-img-anchor">
                            <a href="#" class="image-link" data-src="<?php echo $image_url; ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>"></a>
                            <!-- Display other images -->
                            <?php if (!empty($more_image_1)) : ?>
                                <a href="#" class="image-link" data-src="<?php echo $more_image_1; ?>"><img src="<?php echo $more_image_1; ?>" alt="Image 1"></a>
                            <?php endif; ?>
                            <?php if (!empty($more_image_2)) : ?>
                                <a href="#" class="image-link" data-src="<?php echo $more_image_2; ?>"><img src="<?php echo $more_image_2; ?>" alt="Image 2"></a>
                            <?php endif; ?>
                            <?php if (!empty($more_image_3)) : ?>
                                <a href="#" class="image-link" data-src="<?php echo $more_image_3; ?>"><img src="<?php echo $more_image_3; ?>" alt="Image 3"></a>
                            <?php endif; ?>
                            <?php if (!empty($more_image_4)) : ?>
                                <a href="#" class="image-link" data-src="<?php echo $more_image_4; ?>"><img src="<?php echo $more_image_4; ?>" alt="Image 4"></a>
                            <?php endif; ?>
                        </div>

                        <div class="img-con">
                            <img src="<?php echo $image_url; ?>" alt="">
                        </div>
                    </div>
                    <div class="product-details">
                        <h2 class="product-name"><?php echo $name; ?></h2><br><br>
                        <p class="quantity">50ml (1.69 fl.oz)</p><br>
                        <!-- fix display review number with star -->
                        <!-- <div class="ratings">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <p class="reviews-num">36 reviews</p>
                        </div> -->
                        <div class="price">
                            <h3 class="recent-price">₹<?php echo $actual_price; ?></h3>
                            <h3 class="mrp">₹<?php echo $mrp; ?></h3>
                            <h3 class="off">34 % off</h3>
                        </div>
                        <div class="add-to-cart-opt">
                            <div class="add-to-cart">
                                <span class="plus" onclick="increaseValue()"><i>+</i></span>
                                <input name="quantity" class="num-of-product" id="myInput" type="number" value="1" min="1" max="10" style="padding-right: 11px;">
                                <span class="minus" onclick="decreaseValue()"><i>-</i></span>
                            </div>
                            <button class="cart-btn" data-product-id="1">Add to cart<img src="images/shopping-cart-2-line.png"></button>
                        </div>
                        <div class="options4">
                            <ul>
                                <li><a href="#" id="descriptionLink">Description</a></li>
                                <li><a href="#" id="howToUseLink">How to Use</a></li>
                                <li><a href="#" id="ingredientsLink">Ingredients</a></li>
                                <li><a href="#" id="whoCanUseLink">Who Can Use</a></li>
                            </ul>

                            <div id="loadedSection">

                                <!-- This is where the section will be loaded -->
                            </div>
                            <div class="other-info">
                                <a href="#">Shipping</a>

                                <a href="#">Return & Refund</a>

                                <a href="#">Payment</a>
                            </div>
                        </div>
                    </div>
                    <!-- class "product" second column ends here -->
                </div>

                </div>
            </section>
        </form>
        <section class="related-products">
            <h1>Related products</h1>
            <?php
            include "components/bestsellers.php"
            ?>
        </section>
    </section>
    <?php
    include "components/footer.php"
    ?>
</body>
<script>
    // quantity
    function increaseValue() {
        var input = document.getElementById('myInput');
        var newValue = parseInt(input.value) + 1;
        input.value = newValue > 9 ? 9 : newValue;
    }

    function decreaseValue() {
        var input = document.getElementById('myInput');
        var newValue = parseInt(input.value) - 1;
        input.value = newValue < 1 ? 1 : newValue;
    }

    // images display on click
    $(document).ready(function() {
        $('.image-link').click(function(event) {
            event.preventDefault();

            // Get the image source from the data attribute
            var imgSrc = $(this).data('src');

            // Replace the image in the .img-con container
            $('.img-con img').attr('src', imgSrc);
        });
    });


    // on click descriptions display
    $(document).ready(function() {
        // Function to load product information using AJAX
        function loadSection(section, id) {
            $.ajax({
                url: "load_section.php", // URL to your PHP file to fetch data
                type: "GET",
                data: {
                    section: section,
                    id: id
                }, // Send the section and id parameters
                success: function(data) {
                    $("#loadedSection").html(data); // Replace the content of #loadedSection
                },
                error: function() {
                    $("#loadedSection").html("Error loading section."); // Error message if request fails
                }
            });
        }

        // Click event handlers for each link
        $("#descriptionLink").on("click", function(event) {
            loadSection('description_details', <?php echo $product_id; ?>);
            $(this).addClass("clicked").siblings().removeClass("clicked");
        });

        $("#howToUseLink").on("click", function(event) {
            loadSection('how_to_use', <?php echo $product_id; ?>);
            $(this).addClass("clicked").siblings().removeClass("clicked");
        });

        $("#ingredientsLink").on("click", function(event) {
            loadSection('Ingredients', <?php echo $product_id; ?>);
            $(this).addClass("clicked").siblings().removeClass("clicked");
        });

        $("#whoCanUseLink").on("click", function(event) {
            loadSection('who_can_use', <?php echo $product_id; ?>);
            $(this).addClass("clicked").siblings().removeClass("clicked");
        });

        // Load the first section by default when the page loads
        loadSection('description_details', <?php echo $product_id; ?>);
        $("#descriptionLink").addClass("clicked"); // Add "clicked" class to the first link
    });

    // add to cart
</script>


</html>