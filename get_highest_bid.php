<?php
include_once 'connect.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $highest_bid_sql = "
        SELECT user_id 
        FROM bid 
        WHERE product_id = $product_id 
        ORDER BY bid_amount DESC 
        LIMIT 1";
    $result = $conn->query($highest_bid_sql);
    $highest_bidder_id = null;

    if ($result->num_rows > 0) {
        $highest_bidder = $result->fetch_assoc();
        $highest_bidder_id = $highest_bidder['user_id'];
    }

    echo json_encode(['highest_bidder_id' => $highest_bidder_id]);
}
?>