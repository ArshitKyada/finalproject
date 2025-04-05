<?php
session_start();
include_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Session lost! Please log in again.'); window.history.back();</script>";
        exit();
    }

    // Retrieve user and product details
    $user_id = intval($_SESSION['user_id']); 
    $product_id = intval($_POST['product_id']);
    $bid_amount = floatval($_POST['bid_amount']);
    $bid_time = date("Y-m-d H:i:s");

    // Check if the auction is still open
    $query = "SELECT end_time FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row || strtotime($row['end_time']) < time()) {
        echo "<script>alert('Auction has ended.'); window.history.back();</script>";
        exit();
    }

    // Insert the bid into the database
    $query = "INSERT INTO bids (product_id, user_id, bid_amount, bid_time) 
              VALUES ($product_id, $user_id, $bid_amount, '$bid_time')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Bid placed successfully!'); window.location.href='auctions.php?id=$product_id';</script>";
    } else {
        echo "<script>alert('Failed to place bid.'); window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
