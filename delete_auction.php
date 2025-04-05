<?php
require 'connect.php'; 

$sql = "
    DELETE FROM products 
    WHERE end_time < NOW() 
    AND id NOT IN (SELECT DISTINCT product_id FROM bid)
";

if (mysqli_query($conn, $sql)) {
    echo "Expired auctions with no bids deleted successfully.";
} else {
    error_log("Error deleting expired auctions: " . mysqli_error($conn)); 
    echo "Error: Unable to delete expired auctions. Please try again later.";
}

mysqli_close($conn);
?>
