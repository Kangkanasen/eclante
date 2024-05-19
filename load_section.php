<?php
// Include your connection file
include "components/connection.php";

// Check if section and product ID are provided in the URL
if (isset($_GET['section']) && isset($_GET['id'])) {
    $section = mysqli_real_escape_string($conn, $_GET['section']);
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare SQL statement to fetch product details based on section and product ID
    $sql = "SELECT $section FROM products WHERE id = $product_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $data = $row[$section];

        // Return the data
        echo $data;
    } else {
        echo "Product not found.";
    }

    // Close connection
    $conn->close();
} else {
    echo "Section or product ID not provided.";
}
?>

