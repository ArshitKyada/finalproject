<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="css/style.css">
    <style>

        .nav .line {
            position: relative;
            text-decoration: none;
            padding-bottom: 5px;
        }

        .nav .line::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: #007bff;
            transition: width 0.3s ease-in-out;
        }

        .nav .line:hover::after {
            width: 100%;
        }

        .btn {
            padding: 8px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <i class="fas fa-gavel"></i>
            AUCTIONEERS
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
        <nav class="nav">
            <a class="line" href="index.php">Home</a>
            <a class="line" href="index.php">About Us</a>
            <a class="line" href="auctions.php">Browse Product</a>
            <a class="line" href="index.php">Blog</a>
            <a class="line" href="index.php#contact">Contact</a>

            <?php 
            if (!empty($_SESSION['account_type'])) {
                if ($_SESSION['account_type'] === 'seller') {
                    echo '<a class="line" href="sellerindex.php">Dashboard</a>';
                } elseif ($_SESSION['account_type'] === 'buyer') {
                    echo '<a class="line" href="bidhistory.php">Bid History</a>';
                }
                echo '<a class="btn" href="logout.php">Logout</a>'; // Logout button
            } else {
                echo '<a class="btn" href="registration.php">Sign up</a>'; // Sign up button
            }
            ?>
        </nav>
    </header>
    <script src="js/script.js"></script>
</body>

</html>
