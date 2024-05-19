<?php
include "components/connection.php";

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare SQL statement to fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    
    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product found, fetch details
        $row = $result->fetch_assoc();

        // Product details
        $name = $row['name'];
        $mrp = $row['mrp'];
        $description = $row['description'];
        $image_url = 'images/' . $row['image_url'];
        $more_image_1 = 'images/' . $row['more_image_1'];
        $more_image_2 = 'images/' . $row['more_image_2'];
        $more_image_3 = 'images/' . $row['more_image_3'];
        $more_image_4 = 'images/' . $row['more_image_4'];
        $description_details = $row['description_details'];
        $how_to_use = $row['how_to_use'];
        $ingredients = $row['Ingredients'];
        $who_can_use = $row['who_can_use'];
        $offer = $row['offer'];
        // Calculate actual price after applying offer
        $actual_price = $mrp - ($mrp * ($offer / 100));
    } else {
        // Product not found
        echo "Product not found.";
    }   
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if no product ID is provided
    // Change this to your homepage or product listing page
    exit();
}

?>