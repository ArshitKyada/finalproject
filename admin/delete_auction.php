<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the auction
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manageauction.php"); // Redirect to manage auctions page
        exit();
    } else {
        echo "Error deleting auction.";
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
