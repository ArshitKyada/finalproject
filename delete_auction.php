<?php
require 'connect.php'; // Include your database connection

// SQL to delete expired auctions with no bids
$sql = "
    DELETE FROM products 
    WHERE end_time < NOW() 
    AND id NOT IN (SELECT DISTINCT product_id FROM bid)
";

if (mysqli_query($conn, $sql)) {
    echo "Expired auctions with no bids deleted successfully.";
} else {
    error_log("Error deleting expired auctions: " . mysqli_error($conn)); // Log the error for debugging
    echo "Error: Unable to delete expired auctions. Please try again later.";
}

// Close the database connection
mysqli_close($conn);
?>