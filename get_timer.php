<?php
include_once 'connect.php';

// Set the timezone to IST
date_default_timezone_set('Asia/Kolkata');

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    echo json_encode(["error" => "Invalid product ID"]);
    exit();
}

// Fetch product details
$sql = "SELECT end_time FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $endTime = strtotime($row['end_time']); // Convert to UNIX timestamp
    $endTimeISO = date('Y-m-d\TH:i:sP', $endTime); // ISO 8601 format

    echo json_encode(["end_time" => $endTimeISO]);
} else {
    echo json_encode(["error" => "Product not found"]);
}

$stmt->close();
$conn->close();
?>
