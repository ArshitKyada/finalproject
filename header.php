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
            <a class="btn" href="registration.php">Sign up</a>
        </nav>
    </header>
    <script src="js/script.js"></script>
</body>

</html>
