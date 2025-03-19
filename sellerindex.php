<?php
session_start(); // Start the session
include_once 'connect.php'; // Include your database connection
include_once 'header.php';

// Fetch total active auctions based on end_time without prepared statements
$sql = "SELECT COUNT(*) as total_active_auctions FROM products WHERE end_time > NOW()";
$result = mysqli_query($conn, $sql);
$totalActiveAuctions = mysqli_fetch_assoc($result)['total_active_auctions'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Seller Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f7fafc;
            overflow: hidden;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .seller-container,
        .main-content {
            width: 100%;
        }

        .seller-header {
            background-color: rgb(0, 0, 0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .seller-header h1 {
            font-size: 20px;
            color: rgb(255, 255, 255);
        }

        .seller-header-right {
            display: flex;
            align-items: center;
        }

        .notification-button {
            background: none;
            border: none;
            cursor: pointer;
            color: rgb(255, 255, 255);
            margin-right: 16px;
        }

        .main-content {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
            overflow-y: hidden;
        }

        .dashboard-content {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            max-height: calc(100vh - 190px);
        }

        .overview-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .card {
            background-color: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            flex: 1 1 250px;
        }

        .icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .icon.blue {
            background-color: #ebf8ff;
            color: #3182ce;
        }

        .icon.green {
            background-color: #f0fff4;
            color: #38a169;
        }

        .icon.red {
            background-color: #fff5f5;
            color: #e53e3e;
        }

        .card-title {
            font-size: 16px;
            color: #4a5568;
        }

        .card-value {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
        }

        .recent-auctions {
            background-color: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .recent-auctions h2 {
            font-size: 20px;
            margin -bottom: 16px;
            color: #4a5568;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background-color: #f7fafc;
            color: #4a5568;
        }

        .active {
            color: #38a169;
        }

        .closed {
            color: #e53e3e;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .dashboard-content {
                padding-bottom: 60px;
            }

            .overview-cards {
                flex-direction: column;
            }

            .card {
                flex: 1;
                text-align: center;
                flex-direction: column;
            }

            .icon {
                margin-bottom: 8px;
            }

            .seller-header h1 {
                font-size: 18px;
            }

            .notification-button {
                margin-right: 8px;
            }
        }
    </style>
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
                            <p class="card-value">$5,230</p>
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
                <div class="recent-auctions">
                    <h2>Recent Auctions</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Auction</th>
                                    <th>Bids</th>
                                    <th>Highest Bid</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Vintage Watch</td>
                                    <td>15</td>
                                    <td>$150</td>
                                    <td class="active">Active</td>
                                </tr>
                                <tr>
                                    <td>Classic Car</td>
                                    <td>20</td>
                                    <td>$25,000</td>
                                    <td class="active">Active</td>
                                </tr>
                                <tr>
                                    <td>Antique Vase</td>
                                    <td>10</td>
                                    <td>$300</td>
                                    <td class="closed">Closed</td>
                                </tr>
                                <tr>
                                    <td>Modern Art Piece</td>
                                    <td>5</td>
                                    <td>$1,200</td>
                                    <td class="active">Active</td>
                                </tr>
                                <tr>
                                    <td>Collectible Coins</td>
                                    <td>8</td>
                                    <td>$450</td>
                                    <td class="closed">Closed</td>
                                </tr>
                                <tr>
                                    <td>Rare Stamp Collection</td>
                                    <td>12</td>
                                    <td>$1,000</td>
                                    <td class="active">Active</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>