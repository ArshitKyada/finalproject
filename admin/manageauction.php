<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        main {
            flex-grow: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top:20px;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #333;
        }

        .divider {
            width: 100%;
            height: 4px;
            background-color: rgb(0, 0, 0);
            margin-bottom: 24px;
        }

        .auction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .auction-table th,
        .auction-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .auction-table th {
            background-color: rgb(18, 55, 85);
            color: white;
            font-weight: 500;
        }

        .auction-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .auction-table tr:hover {
            background-color: #e2e8f0;
        }

        .button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: gold; /* Yellow for Edit button */
            color: black; /* Text color for better contrast */
        }

        .edit-button:hover {
            background-color: rgb(180, 163, 17); /* Darker yellow on hover */
        }

        .delete-button {
            background-color: red; /* Red for Delete button */
            color: white; /* Text color */
        }

        .delete-button:hover {
            background-color: #c62828; /* Darker red on hover */
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between buttons */
        }
    </style>
</head>

<body>
    <?php include_once 'sidebar.php'; ?>
    <main>
        <h2>Manage Auctions</h2>
        <div class="divider"></div>

        <?php if (isset($_GET['message'])): ?>
            <div style="color: green; margin-bottom: 20px;">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <table class="auction-table">
            <thead>
                <tr>
                    <th>Auction ID</th>
                    <th>Product Name</th>
                    <th>Starting Price</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../connect.php';

                // Query to get all auctions
                $sql = "SELECT * FROM products"; // Assuming your auctions table is named 'products'
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['product_name']}</td>
                                <td>{$row['starting_bid']}</td> <!-- Ensure this matches your database column -->
                                <td>{$row['end_time']}</td>
                                <td class='action-buttons'>
                                    <a href='edit_auction.php?id={$row['id']}' class='button edit-button'>Edit</a>
                                    <a href='delete_auction.php?id={$row['id']}' class='button delete-button' onclick='return confirm(\"Are you sure you want to delete this auction?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No auctions found</td></tr>";
                 }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>