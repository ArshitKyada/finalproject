<?php
include_once 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $user_id = $_SESSION['user_id'] ?? 1; // Simulated logged-in user
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    if ($rating < 1 || $rating > 5) {
        die("Error: Invalid rating.");
    }

    if (empty($comment)) {
        die("Error: Comment cannot be empty.");
    }

    // Insert the review into the database
    $insert_review_sql = "INSERT INTO reviews (product_id, user_id, rating, comment) VALUES ($product_id, $user_id, $rating, ?)";
    $stmt = $conn->prepare($insert_review_sql);
    $stmt->bind_param("s", $comment);

    if ($stmt->execute()) {
        echo "<script>alert('Review submitted successfully!'); window.location.href = 'product_details.php?id=$product_id';</script>";
    } else {
        echo "<script>alert('Error submitting review.');</script>";
    }
}
?>