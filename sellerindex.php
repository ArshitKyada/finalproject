
<?php

include_once 'header.php';

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
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fc;
        color: #343a40;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .seller-container {
        width: 100%;
        padding: 20px;
    }

    .seller-header {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        padding: 20px;
        background: #f1f5fc;
        border-bottom: 2px solid #ddd;
        flex-wrap: wrap;
    }

    .seller-header h1 {
        font-size: 22px;
        font-weight: 600;
        color: #343a40;
        margin: 0;
    }

    .seller-header .btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s ease-in-out;
        white-space: nowrap;
    }

    .seller-header .btn:hover {
        background-color: #0056b3;
    }

    .seller-table-container {
        width: 100%;
        overflow-x: auto;
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        min-width: 800px;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
        font-size: 15px;
        white-space: nowrap;
    }

    th {
        background-color: #f1f5fc;
        font-weight: bold;
        color: #343a40;
    }

    tbody tr:hover {
        background-color: #f8f9fc;
    }

    @media (max-width: 768px) {
        .seller-container {
            padding: 10px;
        }

        .seller-header {
            flex-direction: column;
            text-align: center;
        }

        .seller-header h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .seller-header .btn {
            font-size: 14px;
            padding: 8px 16px;
            width: 100%;
            text-align: center;
            margin-top: 5px;
        }

        .seller-table-container {
            overflow-x: auto;
        }

        table {
            min-width: 600px;
        }

        th, td {
            font-size: 14px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        th, td {
            font-size: 13px;
            padding: 8px;
        }

        .seller-header h1 {
            font-size: 18px;
        }

        .seller-header .btn {
            font-size: 13px;
            padding: 6px 12px;
        }
    }
    </style>
</head>

<body>
    <div class="seller-container">
        <div class="seller-header">
            <h1>Your Past Auctions</h1>
            <a href="addproduct.php" class="btn">New Auction</a>
        </div>
        <div class="seller-table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Auctioned Product</th>
                        <th>Category</th>
                        <th>Auction Status</th>
                        <th>Reserve Price ($)</th>
                        <th>Auction Start Time</th>
                        <th>Total Bids</th>
                        <th>Auction End Time</th>
                        <th>Highest Bid Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add rows dynamically using PHP -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
