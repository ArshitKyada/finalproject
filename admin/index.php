<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Auction Management System</title>
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
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px; /* Adjusted margin for better spacing */
            color: black;
        }

        .divider {
            width: 100%;
            height: 4px;
            background-color: rgb(0, 0, 0);
            margin-bottom: 24px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Space between cards */
        }

        .card {
            background-color:rgb(16, 42, 81);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 250px; /* Fixed width for square boxes */
            height: 100px; /* Fixed height for square boxes */
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .total-users, .contact-messages, .total-auctions {
            font-size: 24px;
            font-weight: bold;
            color:rgb(255, 255, 255);
            padding: 30px;
        }

        @media (max-width: 768px) {
            .card {
                width: 100%; /* Full width on smaller screens */
                height: auto; /* Auto height for flexibility */
            }

            h2 {
                font-size: 24px;
            }

            .total-users, .contact-messages, .total-auctions {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include_once 'sidebar.php'; ?>
    <main>
        <h2>Dashboard</h2>
        <div class="divider"></div> <!-- Divider line added here -->
        
        <div class="card-container">
            <div class="card">
                <div class="total-users">
                    <?php
                    include_once '../connect.php';

                    // Query to get total users
                    $sql = "SELECT COUNT(*) as total FROM users"; // Assuming your users table is named 'users'
                    $result = $conn->query($sql);
                    $totalUsers = ($result->num_rows > 0) ? $result->fetch_assoc()['total'] : 0;
                    ?>
                    Total Users: <?php echo $totalUsers; ?>
                </div>
            </div>

            <div class="card">
                <div class="contact-messages">
                    <?php
                    // Query to get total contact messages
                    $sql = "SELECT COUNT(*) as total FROM contactus"; // Assuming your contact messages table is named 'contactus'
                    $result = $conn->query($sql);
                    $totalMessages = ($result->num_rows > 0) ? $result->fetch_assoc()['total'] : 0;
                    ?>
                    Messages: <?php echo $totalMessages; ?>
                </div>
            </div>

            <div class="card">
                <div class="total-auctions">
                    <?php
                    // Query to get total auctions
                    $sql = "SELECT COUNT(*) as total FROM products"; // Assuming your auctions table is named 'products'
                    $result = $conn->query($sql);
                    $totalAuctions = ($result->num_rows > 0) ? $result->fetch_assoc()['total'] : 0;
                    ?>
                    Total Auctions: <?php echo $totalAuctions; ?>
                </div>
            </div>
        </div>

    </main>
</body>

</html>