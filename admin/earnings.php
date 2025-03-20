<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings - Auction Management System</title>
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
            flex:1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            margin-top:20px;
        }

        .earnings-summary {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px; /* Increased max-width */
            text-align: center;
        }

        .earnings-summary p {
            font-size: 30px;
            margin: 10px 0;
        }

        .payments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .payments-table th,
        .payments-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .payments-table th {
            background-color: rgb(13, 50, 81);
            color: white;
            font-weight: 500;
        }

        .payments-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .payments-table tr:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>

<body>
    <?php include_once 'sidebar.php'; ?>
    <main>
        <h2>Earnings Summary</h2>
        <div class="divider"></div>

        <div class="earnings-summary">
            <?php
            include_once '../connect.php';

            // Query to get all payments using the correct column name
            $sql = "SELECT amount_due FROM payments"; // Use the correct column name
            $result = $conn->query($sql);

            $totalEarnings = 0;

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $totalEarnings += $row['amount_due']; // Use the correct column name
                }
            } else {
                echo "<p>Error retrieving payments: " . $conn->error . "</p>";
            }

            // Calculate 5% of total earnings
            $fivePercent = $totalEarnings * 0.05;

            // Display results
            echo "<p>Total Earnings:<strong> $" . number_format($fivePercent, 2) . "</strong></p>";
            ?>
        </div>

        <h3>Payments Details</h3>
        <table class="payments-table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Amount Due</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to get all payment details
                $sql = "SELECT id, amount_due, created_at FROM payments"; // Adjust the query to include the correct date column
                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>"; // Display payment ID
                        echo "<td>$" . number_format($row['amount_due'], 2) . "</td>"; // Display amount due
                        echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>"; // Display payment date
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Error retrieving payment details: " . $conn->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>