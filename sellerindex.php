<?php
session_start();

function include_header() {
    if (isset($_SESSION['account_type'])) {
        if ($_SESSION['account_type'] === 'buyer') {
            include 'buyerheader.php';
        } elseif ($_SESSION['account_type'] === 'seller') {
            include 'sellerheader.php';
        }
    } else {
        include 'header.php';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Past Auctions</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            overflow-y: scroll;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(255, 255, 255);
        }

        .seller-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .seller-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .seller-header h1 {
            margin: 0;
            font-size: 24px;
            color: #343a40;
        }

        .seller-header .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .seller-table-container {
            margin-top: 20px;
            width: 100%;
            white-space: nowrap;
        }

        table {
            width: 100%;
            min-width: 1200px; /* Ensures scrollbar is always visible */
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: rgb(0, 0, 0);
            font-weight: bold;
            color: rgb(255, 255, 255);
        }

        @media (max-width: 768px) {
            .seller-header h1 {
                font-size: 20px;
            }

            .seller-header .btn {
                padding: 8px 16px;
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include_header(); ?>
    <div class="seller-container">
        <div class="seller-header">
            <h1>Your Auctions</h1>
            <a href="addproduct.php" class="btn">New Auction</a>
        </div>
        <div class="seller-table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Auctioned product</th>
                        <th>Category</th>
                        <th>Auction status</th>
                        <th>Reserve price ($)</th>
                        <th>Auction start time</th>
                        <th>Totals Bids</th>
                        <th>Auction end time</th>
                        <th>Highest bid price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add rows here -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
