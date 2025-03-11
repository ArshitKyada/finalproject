<?php
require 'connect.php'; // Include your database connection

// SQL to delete expired auctions
$sql = "DELETE FROM products WHERE end_time < NOW()";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
