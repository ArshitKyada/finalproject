<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        nav a {
            text-decoration: none;
            padding-bottom: 5px;
            position: relative;
        }



        /* Left to Right Underline Effect */
        nav .line::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: #007bff;
            transition: width 0.3s ease-in-out;
        }

        nav .line:hover::after {
            width: 100%;
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
        <nav>
            <a class="line" href="index.php">Home</a>
            <a class="line" href="auctions.php">Auctions</a>
            <a class="line" href="sellerindex.php">Dashboard</a>
            <a class="line" href="index.php#contact">Contact</a>
            <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'seller'): ?>
                <a class="btn" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="btn" href="registration.php">Sign up</a>
            <?php endif; ?>
        </nav>
    </header>
    <script src="js/script.js"></script>
</body>

</html>
