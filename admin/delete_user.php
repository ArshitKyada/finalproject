<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Start a transaction to ensure all deletions happen together
    $conn->begin_transaction();

    try {
        // Delete related payments records
        $deletePaymentsQuery = "DELETE FROM payments WHERE user_id = ?";
        $stmt = $conn->prepare($deletePaymentsQuery);
        $stmt->bind_param("i", $user_id); // Bind the user ID as an integer
        $stmt->execute();
        $stmt->close();

        // Delete related reviews records
        $deleteReviewsQuery = "DELETE FROM reviews WHERE user_id = ?";
        $stmt = $conn->prepare($deleteReviewsQuery);
        $stmt->bind_param("i", $user_id); // Bind the user ID as an integer
        $stmt->execute();
        $stmt->close();

        // Then, delete the user
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id); // Bind the user ID as an integer
        $stmt->execute();
        $stmt->close();

        // Commit the transaction if all queries are successful
        $conn->commit();

        // Redirect to manageusers.php with a success message
        header("Location: manageusers.php?message=User deleted successfully");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();

        // Redirect to manageusers.php with an error message
        header("Location: manageusers.php?message=Error deleting user: " . $e->getMessage());
        exit();
    }
} else {
    // Redirect to manageusers.php if no ID is provided
    header("Location: manageusers.php?message=No user ID provided");
    exit();
}

// Close the database connection
$conn->close();
?>