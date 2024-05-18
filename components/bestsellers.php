<?php
// bestseller.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="slider-container">
        <div class="slider">
            <?php
            include "components/connection.php";

            // Fetch products from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            // Check if a search parameter is present in the URL
            $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
            // Set the number of columns
            $columnsDesktop = 3;
            $columnsMobile = 2;  // 2 products per slide on mobile
            $totalProducts = $result->num_rows;
            $totalSlidesDesktop = ceil($totalProducts / $columnsDesktop);
            $totalSlidesMobile = ceil($totalProducts / $columnsMobile);

            // Display products in slides
            for ($slide = 0; $slide < $totalSlidesDesktop; $slide++) {
                echo '<div class="slide">';
                for ($i = 0; $i < $columnsDesktop; $i++) {
                    if ($row = $result->fetch_assoc()) {
                        if (empty($searchTerm) || stripos($row['name'], $searchTerm) !== false) {
                            // Calculate actual price after applying offer
                            $actual_price = $row['mrp'] - ($row['mrp'] * ($row['offer'] / 100));

                            // Display product information within the card structure
                            echo '<div class="card">';
                            echo '<a href="product-info.php?id=' . $row['id'] . '" class="product-link">';
                            echo '<div class="card-img" style="background-image: url(\'images/' . $row['image_url'] . '\'); background-size: cover;"></div>';
                            echo '<div class="card-info">';
                            echo '<p class="text-title">' . $row['name'] . '</p>';
                            echo '<p class="text-body">' . $row['description'] . '</p>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                            echo '<span class="text-title">₹ ' . number_format($actual_price, 2) . '</span>';
                            echo '</a>';
                            echo '<button class="card-button" onclick="addToCart(' . $row['id'] . ', 1, ' . $actual_price . ')">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">';
                            echo '<path d="M7.72461 7.67001V6.70001C7.72461 4.45001 9.53461 2.24001 11.7846 2.03001C14.4646 1.77001 16.7246 3.88001 16.7246 6.51001V7.89001" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>';
                            echo '<path d="M9.22444 22H15.2244C19.2444 22 19.9644 20.39 20.1744 18.43L20.9244 12.43C21.1944 9.99 20.4944 8 16.2244 8H8.22444C3.95444 8 3.25444 9.99 3.52444 12.43L4.27444 18.43C4.48444 20.39 5.20444 22 9.22444 22Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>';
                            echo '<path d="M15.7201 12H15.7291" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
                            echo '<path d="M8.71912 12H8.7281" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
                            echo '</svg>';
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
                echo '</div>';
            }

            $conn->close();
            ?>
        </div>
        <div class="dot-navigation">
            <?php
            for ($i = 0; $i < $totalSlidesDesktop; $i++) {
                echo '<div class="dot" data-slide="' . $i . '"></div>';
            }
            ?>
        </div>
    </div>
    <script src="js/dot-slider.js"></script>
    <script>
        function addToCart(productId, quantity, price) {
            $.ajax({
                type: "POST",
                url: "add_cart.php",
                data: {
                    productId: productId,
                    productQuantity: quantity,
                    productPrice: price
                },
                success: function(data) {
                    alert("Product added to cart!");
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while adding the product to cart.");
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
