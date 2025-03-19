<?php
session_start(); // Start the session
include_once 'connect.php'; // Include your database connection
include_once 'header.php';

// Assuming user ID is stored in session
$userId = $_SESSION['user_id'];

// Fetch total active auctions for the user based on end_time
$sql = "SELECT COUNT(*) as total_active_auctions FROM products WHERE end_time > NOW() AND seller_id = $userId";
$result = mysqli_query($conn, $sql);
$totalActiveAuctions = mysqli_fetch_assoc($result)['total_active_auctions'];

// Fetch total revenue for the seller from the payments table
$sqlRevenue = "
    SELECT SUM(p.amount_due) as total_revenue 
    FROM payments p
    JOIN products pr ON p.product_id = pr.id 
    WHERE pr.seller_id = $userId
";
$resultRevenue = mysqli_query($conn, $sqlRevenue);
$totalRevenue = mysqli_fetch_assoc($resultRevenue)['total_revenue'] ?? 0; // Default to 0 if no revenue
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Seller Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/sellerstyle.css">
</head>

<body>
    <div class="seller-container">
        <!-- Header -->
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
            <div class="header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Sidebar -->
            <?php include_once 'sidebar.php'; ?>
            <!-- Dashboard Content -->
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
                            <p class="card-title">Total Sales</p>
                            <p class="card-value">$<?php echo number_format($totalRevenue, 2); ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon red"><i class="fas fa-users"></i></div>
                        <div>
                            <p class="card-title">Bidders</p>
                            <p class="card-value">45</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>