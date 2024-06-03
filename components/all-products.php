<?php
include "components/connection.php";


// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if a search parameter is present in the URL
$searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
// Set the number of columns and rows
$columns = 3;
$rows = ceil($result->num_rows / $columns);

// Display products in a grid
echo '<div style="display: grid; grid-template-columns: repeat(' . $columns . ', 1fr); row-gap: 40px;">';

while ($row = $result->fetch_assoc()) {
    // Initialize $isFavorite for each product
    $isFavorite = false;

    // Prepare SQL statement to check if the product is in favorites for the current user
    $check_favorite_sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
    $stmt_favorite = $conn->prepare($check_favorite_sql);
    $stmt_favorite->bind_param("ii", $user_id, $row['id']);
    // Execute the prepared statement
    $stmt_favorite->execute();
    $result_favorite = $stmt_favorite->get_result();

    // If the product is in favorites, set $isFavorite to true
    if ($result_favorite->num_rows > 0) {
        $isFavorite = true;
    }

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
    echo '<div>';
    // Inside the while loop where you display products
    echo '<button class="fav-btn' . ($isFavorite ? ' filled' : '') . '" onclick="addToFavorites(' . $row['id'] . ', ' . $user_id . ', this)"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.5685 19.076C11.2568 19.186 10.7435 19.186 10.4318 19.076C7.7735 18.1685 1.8335 14.3826 1.8335 7.96596C1.8335 5.13346 4.116 2.8418 6.93016 2.8418C8.5985 2.8418 10.0743 3.64846 11.0002 4.89513C11.926 3.64846 13.411 2.8418 15.0702 2.8418C17.8843 2.8418 20.1668 5.13346 20.1668 7.96596C20.1668 14.3826 14.2268 18.1685 11.5685 19.076Z" stroke="#F38BA0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </button>';
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
    echo '</div>';
    echo '</div>';
}

echo '</div>';

$conn->close();
?>

<script>
            function showNotification(message) {
            var notification = document.getElementById("notification");
            notification.innerText = message;
            notification.className = "notification show";
            setTimeout(function() {
                notification.className = notification.className.replace(" show", "");
            }, 2000);
        }

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
                showNotification("Product added to cart!");
            },
            error: function(xhr, status, error) {
                showNotification("An error occurred while adding the product to cart.");
                console.log(xhr.responseText);
            }
        });
    }


    $('.fav-btn').each(function(index, element) {
        var productId = $(this).data('product-id');
        var favoriteButton = $(this);

        $.ajax({
            type: "POST",
            url: "check_favorites.php",
            data: {
                productId: productId,
                userId: <?php echo $user_id; ?> // Pass the user's ID
            },
            success: function(data) {
                if (data === "true") {
                    favoriteButton.addClass('filled');
                }
            },
            error: function(xhr, status, error) {
                console.log("An error occurred while checking favorites status.");
                console.log(xhr.responseText);
            }
        });
    });

    function addToFavorites(productId, element) {
    $.ajax({
        type: "POST",
        url: "add_to_favorites.php",
        data: {
            productId: productId
        },
        success: function(data) {
            if (data.trim() === "Please log in first.") {
                alert(data);
                window.location.href = "login.php"; // Redirect to login page if not logged in
            } else if (data.trim() === "Product added to favorites!") {
                var favButton = $(element);
                favButton.addClass('filled'); // Add filled class to the favorite button
                showNotification("Product added to favorites!"); // Display notification
                // Reload the page to display the filled color
                setTimeout(function() {
                    location.reload();
                }, 1000); 
            } else {
                showNotification(data.trim()); // Display other response messages
            }
        },
        error: function(xhr, status, error) {
            showNotification("An error occurred while adding the product to favorites.");
            console.log(xhr.responseText);
        }
    });
}

</script>