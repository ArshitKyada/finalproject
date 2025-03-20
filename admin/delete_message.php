<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the ID and convert it to an integer

    // Create the SQL query to delete the message
    $sql = "DELETE FROM contactus WHERE id = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the messages page with a success message
        header("Location: contact.php?message=Message deleted successfully");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: contact.php?error=Error deleting message: " . $conn->error);
        exit();
    }
} else {
    // Redirect back with an error message if ID is not set
    header("Location: messages.php?error=No ID provided");
    exit();
}

$conn->close(); // Close the database connection
?>
