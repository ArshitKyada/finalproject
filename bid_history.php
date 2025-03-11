<?php
session_start(); // Start the session to access session variables
include_once 'connect.php'; // Include your database connection file
include_once 'header.php'; // Include your header
include_once 'preloader.php'; // Include your preloader

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to view your bid history.");
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch all products for which the user has placed bids along with the current highest bid
$bid_history_sql = "
    SELECT p.id AS product_id, p.product_name, b.id AS bid_id, b.bid_amount, b.bid_time, u.username,
           (SELECT MAX(bid_amount) FROM bid WHERE product_id = p.id) AS current_highest_bid
    FROM bid b 
    JOIN products p ON b.product_id = p.id 
    JOIN users u ON b.user_id = u.id 
    WHERE b.user_id = $user_id 
    ORDER BY b.bid_time DESC
";

$bid_history_result = $conn->query($bid_history_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bid History</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .bid-history-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #0A3D62;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0A3D62;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-bids {
            text-align: center;
            color: #888;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="bid-history-container">
        <h2>Your Bid History</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Your Bid Amount</th>
                    <th>Bid Time</th>
                    <th>Current Highest Bid</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bid_history_result->num_rows > 0): ?>
                    <?php while ($row = $bid_history_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td>$<?php echo number_format($row['bid_amount'], 2); ?></td>
                            <td><?php echo date('F j, Y, g:i a', strtotime($row['bid_time'])); ?></td>
                            <td>$<?php echo number_format($row['current_highest_bid'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-bids">No bids placed yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php
    $conn->close(); // Close the database connection
    ?>
</body>

</html>