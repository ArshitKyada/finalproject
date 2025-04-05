<?php 

session_start();
include_once 'preloader.php';
include_once 'connect.php';
include_once 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sellerId = $_SESSION['user_id'];

$sqlShippingAddresses = "
    SELECT p.full_name, p.email, p.address, p.city, p.state, p.zip_code, pr.product_name
    FROM payments p
    JOIN products pr ON p.product_id = pr.id
    WHERE pr.seller_id = $sellerId
";

$resultShippingAddresses = mysqli_query($conn, $sqlShippingAddresses);

if (!$resultShippingAddresses) {
    die("Database query failed: " . mysqli_error($conn));
}
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
    body {
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
        overflow: hidden;
    }

    .dashboard-content {
        flex: 1;
        padding: 16px;
        overflow-y: auto;
        max-height: calc(100vh - 190px);
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    @media (max-width: 768px) {
        .dashboard-content {
            padding: 8px;
        }

        th,
        td {
            padding: 8px;
        }
    }
    </style>
</head>

<body>
    <div class="seller-container">
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
        </header>

        <div class="main-content">
            <?php include_once 'sidebar.php'; ?>
            <main class="dashboard-content">
                <h2>Shipping Addresses for Your Products</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultShippingAddresses) > 0) {
                            while ($row = mysqli_fetch_assoc($resultShippingAddresses)) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['address']) . "</td>
                                    <td>" . htmlspecialchars($row['city']) . "</td>
                                    <td>" . htmlspecialchars($row['state']) . "</td>
                                    <td>" . htmlspecialchars($row['zip_code']) . "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No shipping addresses found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>