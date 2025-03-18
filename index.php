<?php
include_once 'preloader.php';
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
    /* Hide scrollbar */
    body::-webkit-scrollbar {
        display: none;
    }

    /* Apply background image only to the content section */
    .container {
        background-image: url('images/back.png'); /* Ensure the path is correct */
        background-size: cover; /* Cover the entire section */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* No repeating */
        padding: 50px; /* Add padding for better spacing */
        border-radius: 10px; /* Rounded corners for a nice effect */
    }

    .categories .category a {
        display: inline-block;
        overflow: hidden;
        border-radius: 10px;
    }

    .categories .category a img {
        transition: transform 0.3s ease-in-out;
    }

    .categories .category a:hover img {
        transform: scale(1.1);
    }
</style>

</head>

<body>

    <div class="container" id="home">
        <div class="content"><br><br>
            <h1 class="headline">Winning bids, one click at a time</h1>
            <br>
            <div class="buttons">
                <a href="auctions.php" class="button view-auctions">View Auctions</a>
                <a href="#" class="button watch-video">Watch Video</a>
            </div>
        </div>
        <div class="illustration">
            <img src="images/image.png" alt="Auction Illustration">
        </div>
    </div>


    <!-- New Trusted Section -->
    <div class="trusted-section">
        <div class="trusted-container">
            <h2 class="trusted-title">Trusted By 500+ Businesses</h2>
            <p class="trusted-description">
                Explore the world's best & largest Bidding marketplace with our beautiful Bidding products.
                We want to be a part of your smile, success, and future growth.
            </p>
            <div class="trusted-grid">
                <div class="trusted-item">
                    <img src="images/1.png" alt="Stanford">
                </div>
                <div class="trusted-item">
                    <img src="images/2.png" alt="Laravel">
                </div>
                <div class="trusted-item">
                    <img src="images/3.png" alt="Svelte">
                </div>
                <div class="trusted-item">
                    <img src="images/4.png" alt="Discord">
                </div>
                <div class="trusted-item">
                    <img src="images/5.png" alt="ASN Bank">
                </div>
                <div class="trusted-item">
                    <img src="images/6.png" alt="WeeWorld">
                </div>
                <div class="trusted-item">
                    <img src="images/7.png" alt="Inside the Hotel">
                </div>
            </div>
        </div>
    </div>

    <div class="category-container" id="categories">
        <h1>OUR CATEGORIES</h1><br>
        <div class="categories">
            <div class="category">
                <h3>Smart Phones</h3>
                <a href="#">
                    <img alt="Smart Phones" height="200" src="images/9.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Clothing</h3>
                <a href="#">
                    <img alt="Clothing" height="200" src="images/10.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Smart Watches</h3>
                <a href="#">
                    <img alt="Smart Watches" height="200" src="images/11.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Home Decor</h3>
                <a href="#">
                    <img alt="Home Decor" height="200" src="images/12.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Computers & Accessories</h3>
                <a href="#">
                    <img alt="Computers & Accessories" height="200" src="images/13.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Jewellery & Gemstones</h3>
                <a href="#">
                    <img alt="Jewellery & Gemstones" height="200" src="images/14.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Books & Literature</h3><br>
                <a href="#">
                    <img alt="Books & Literature" height="200" src="images/15.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Sports Equipment</h3>
                <a href="#">
                    <img alt="Sports Equipment" height="200" src="images/16.png" width="200" />
                </a>
            </div>
            <div class="category">
                <h3>Art & Collectibles</h3><br>
                <a href="#">
                    <img alt="Art & Collectibles" height="200" src="images/8.jpg" width="200" />
                </a>
            </div>
        </div>
    </div>

    <?php 
    include_once 'faq.php';
    include_once 'comments.php';
    include_once 'contact.php';
    include_once 'footer.php';
    ?>

    <script src="js/script.js"></script>

</body>

</html>