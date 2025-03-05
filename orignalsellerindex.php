<?php
include_once 'header.php'; 
include_once 'connect.php'; 

// Check if a product is being deleted
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM products WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Product deleted successfully.'); window.location.href='sellerindex.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the product.');</script>";
    }
}

// Fetch product data from the database
$query = "SELECT * FROM products"; 
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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

    .update-btn {
        background-color: #28a745;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }

    .update-btn:hover {
        background-color: #218838;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }

    .delete-btn:hover {
        background-color: #c82333;
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
                        <th>Auction Start Time</th>
                        <th>Auction End Time</th>
                        <th>Reserve Price ($)</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['end_time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['starting_bid']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>
                                    <a href='updateauction.php?id=" . $row['id'] . "' class='update-btn'>Update</a>
                                    <a href='?delete_id=" . $row['id'] . "' class='delete-btn'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No auctions found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
