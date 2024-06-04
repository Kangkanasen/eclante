<?php
session_start();
include "components/connection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>location.href='login.php'</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the count of favorite products for the logged-in user
$count_sql = "SELECT COUNT(*) as favorite_count FROM favorites WHERE user_id = ?";
$stmt = $conn->prepare($count_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$count_result = $stmt->get_result();
$fav_count_row = $count_result->fetch_assoc();
$fav_count = $fav_count_row['favorite_count'];

// Fetch favorite products for the logged-in user
$sql = "SELECT p.* FROM products p INNER JOIN favorites f ON p.id = f.product_id WHERE f.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Set the number of columns and rows
$columns = 3;
$rows = ceil($result->num_rows / $columns);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>

<body>
    <section class="body">
        <?php
        include "components/header.php";
        ?>
    </section>

    <section class="body">
        <section class="all-products">
            <div class="header">
                <h1>Favorites <span>(<?php echo $fav_count; ?> items)</span></h1>
            </div>

            <div class="slider-container products">
                <?php
                // Display products in a grid
                echo '<div style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); row-gap: 40px;">';

                while ($row = $result->fetch_assoc()) {
                    // Calculate actual price after applying offer
                    $actual_price = $row['mrp'] - ($row['mrp'] * ($row['offer'] / 100));

                    // Display product information within the card structure
                    echo '<div class="slide">';
                    echo '<div class="card">';
                    echo '<a href="product-page.php?id=' . $row['id'] . '" class="product-link">'; // Link to product page
                    echo '<div class="card-img" style="background-image: url(\'images/' . $row['image_url'] . '\'); background-size: cover;"></div>';
                    echo '<div class="card-info">';
                    echo '<p class="text-title">' . $row['name'] . '</p>';
                    echo '<p class="text-body">' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer">';
                    echo '<span class="text-title">₹ ' . number_format($actual_price, 2) . '</span>'; // Display actual price
                    echo '</a>';
                    echo '<div style="display:flex; gap:2px; margin-right:2px;">';
                    echo '<button class="card-button" onclick="addToCart(' . $row['id'] . ', 1, ' . $actual_price . ')">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">';
                    echo '<path d="M7.72461 7.67001V6.70001C7.72461 4.45001 9.53461 2.24001 11.7846 2.03001C14.4646 1.77001 16.7246 3.88001 16.7246 6.51001V7.89001" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>';
                    echo '<path d="M9.22444 22H15.2244C19.2444 22 19.9644 20.39 20.1744 18.43L20.9244 12.43C21.1944 9.99 20.4944 8 16.2244 8H8.22444C3.95444 8 3.25444 9.99 3.52444 12.43L4.27444 18.43C4.48444 20.39 5.20444 22 9.22444 22Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>';
                    echo '<path d="M15.7201 12H15.7291" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
                    echo '<path d="M8.71912 12H8.7281" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
                    echo '</svg>';
                    echo '</button>';
                    echo '<button class="remove-btn" data-product-id="' . $row['id'] . '"><img src="images/delete.png" alt="Delete"></button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
                ?>

            </div>
        </section>

        <?php
        include "notification.php"
        ?>

    </section>

    <?php
    include "components/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function addToCart(productId, quantity, price) {
            console.log("Product ID:", productId);
            console.log("Quantity:", quantity);
            console.log("Price:", price);

            $.ajax({
                type: "POST",
                url: "add_to_cart.php",
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



        $(document).ready(function() {
            $('.remove-btn').click(function() {
                var productId = $(this).data('product-id');
                var cardElement = $(this).closest('.card');

                $.ajax({
                    type: "POST",
                    url: "delete_favorite.php",
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status == 'success') {
                            cardElement.remove(); // Remove the product card from the DOM
                            var favoriteCount = parseInt($('h1 span').text().split(' ')[0]);
                            $('h1 span').text((favoriteCount - 1) + ' items'); // Update the favorite count
                            showNotification('Product removed from favorites!'); // Show notification
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while removing the product from favorites.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        // notification
        function showNotification(message) {
            var notification = $('#notification');
            notification.text(message);
            notification.addClass('show');
            setTimeout(function() {
                notification.removeClass('show');
            }, 2000);
        }
    </script>

</body>

</html>