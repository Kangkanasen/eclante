<?php
include "components/connection.php";

$query = $_GET['q'];
$suggestions = [];

if ($query) {
    $stmt = $conn->prepare("SELECT id, name, mrp, offer, image_url FROM products WHERE name LIKE ?");
    $likeQuery = "%" . $query . "%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // Calculate the actual price
        $actual_price = $row['mrp'] - ($row['mrp'] * ($row['offer'] / 100));
        $row['actual_price'] = round($actual_price, 2); // Round to 2 decimal places
        $suggestions[] = $row;
    }

    $stmt->close();
}

$conn->close();

echo json_encode($suggestions);
?>
