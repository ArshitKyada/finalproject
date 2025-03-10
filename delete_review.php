<?php
include_once 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = intval($_POST['review_id']);
    $product_id = intval($_POST['product_id']); // Get the product ID from the POST request
    $user_id = $_SESSION['user_id'] ?? 1; // Simulated logged-in user

    // Check if the review belongs to the user
    $check_review_sql = "SELECT user_id FROM reviews WHERE id = $review_id";
    $check_result = $conn->query($check_review_sql);
    
    if ($check_result->num_rows > 0) {
        $review_row = $check_result->fetch_assoc();
        if ($review_row['user_id'] == $user_id) {
            // Delete the review
            $delete_review_sql = "DELETE FROM reviews WHERE id = $review_id";
            if ($conn->query($delete_review_sql) === TRUE) {
                echo "<script>alert('Review deleted successfully!'); window.location.href = 'product_details.php?id=$product_id';</script>"; // Use the product ID here
            } else {
                echo "<script>alert('Error deleting review.');</script>";
            }
        } else {
            echo "<script>alert('You cannot delete this review.');</script>";
        }
    } else {
        echo "<script>alert('Review not found.');</script>";
    }
}
?>