<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM users WHERE id = ?";
    
    // Initialize a statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Bind the user ID as an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to manage_users.php with a success message
        header("Location: manage_users.php?message=User  deleted successfully");
        exit();
    } else {
        // Redirect to manage_users.php with an error message
        header("Location: manage_users.php?message=Error deleting user");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect to manage_users.php if no ID is provided
    header("Location: manage_users.php?message=No user ID provided");
    exit();
}

// Close the database connection
$conn->close();
?>