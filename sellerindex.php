<?php
session_start();
include_once 'connect.php';
include_once 'header.php';

$userId = $_SESSION['user_id'];

// Fetch total revenue
$sqlRevenue = "
    SELECT SUM(p.amount_due) as total_revenue 
    FROM payments p
    JOIN products pr ON p.product_id = pr.id 
    WHERE pr.seller_id = $userId
";
$resultRevenue = mysqli_query($conn, $sqlRevenue);
$totalRevenue = mysqli_fetch_assoc($resultRevenue)['total_revenue'] ?? 0;

// Deduct 5% fee
$totalRevenue *= 0.95;

// Fetch total withdrawn amount
$sqlWithdrawals = "SELECT SUM(amount) as total_withdrawn FROM withdrawals WHERE seller_id = $userId";
$resultWithdrawals = mysqli_query($conn, $sqlWithdrawals);
$totalWithdrawn = mysqli_fetch_assoc($resultWithdrawals)['total_withdrawn'] ?? 0;

// Calculate available balance
$availableBalance = $totalRevenue - $totalWithdrawn;

// Fetch active auctions
$sqlActiveAuctions = "SELECT COUNT(*) as total_active_auctions FROM products WHERE end_time > NOW() AND seller_id = $userId";
$resultActiveAuctions = mysqli_query($conn, $sqlActiveAuctions);
$totalActiveAuctions = mysqli_fetch_assoc($resultActiveAuctions)['total_active_auctions'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/sellerstyle.css">
    <style>
        .withdraw-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .withdraw-button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .withdraw-button:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body>
    <div class="seller-container">
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
            <div class="header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <div class="main-content">
            <?php include_once 'sidebar.php'; ?>
            <main class="dashboard-content">
                <div class="overview-cards">
                    <div class="card">
                        <div class="icon blue"><i class="fas fa-gavel"></i></div>
                        <div>
                            <p class="card-title">Active Auctions</p>
                            <p class="card-value"><?php echo htmlspecialchars($totalActiveAuctions); ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon green"><i class="fas fa-dollar-sign"></i></div>
                        <div>
                            <p class="card-title">Total Revenue</p>
                            <p class="card-value">$<?php echo number_format($totalRevenue, 2); ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon green"><i class="fas fa-wallet"></i></div>
                        <div>
                            <p class="card-title">Available Balance</p>
                            <p class="card-value">$<?php echo number_format($availableBalance, 2); ?></p>
                            <a href="withdraw.php" class="withdraw-button">Withdraw</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
