<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="css/style.css">
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
            <a class="active" href="index.php">Home</a>
            <a href="auctions.php">Auctions</a>
            <a href="sellerindex.php">Dashboard</a>
            <a href="index.php#contact">Contact</a>
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