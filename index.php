<?php
session_start();

function include_header() {
    if (isset($_SESSION['account_type'])) {
        if ($_SESSION['account_type'] === 'buyer') {
            include 'buyerheader.php';
        } elseif ($_SESSION['account_type'] === 'seller') {
            include 'sellerheader.php';
        }
    } else {
        include 'header.php';
    }
}
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
        #scrollUp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <?php include_header(); ?>

    <div class="container" id="home">
        <div class="content">
            <h1 class="headline">Winning bids, one click at a time</h1>
            <p class="subheadline">Where auctions meet technology for a seamless bidding experience.</p>
            <div class="buttons">
                <a href="#" class="button view-auctions">View Auctions</a>
                <a href="#" class="button watch-video">Watch Video</a>
            </div>
        </div>
        <div class="illustration">
            <img src="images/image.png" alt="Auction Illustration">
        </div>
    </div>

    <div class="trusted-section" id="trusted">
        <h2>TRUSTED BY 20,000+ ORGANIZATIONS WORLDWIDE</h2>
        <div class="trusted-logos">
            <img alt="Lilly logo" height="50" src="images/1.png" width="100" />
            <img alt="Grabyo logo" height="50" src="images/3.png" width="100" />
            <img alt="Myob logo" height="50" src="images/4.png" width="100" />
            <img alt="LifeGroups logo" height="50" src="images/5.png" width="100" />
            <img alt="Belimo logo" height="50" src="images/6.png" width="100" />
        </div>
    </div>

    <div class="category-container" id="categories">
        <h2>OUR CATEGORIES</h2>
        <h1>Find Products By Category</h1><br>
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
    include_once 'contact.php';
    include_once 'footer.php';
    ?>

    <button id="scrollUp"><i class="fas fa-arrow-up"></i></button>

    <script src="js/script.js"></script>
    <script>
        const scrollUpButton = document.getElementById('scrollUp');

        window.onscroll = function() {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                scrollUpButton.style.display = 'block';
            } else {
                scrollUpButton.style.display = 'none';
            }
        };

        scrollUpButton.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
</body>

</html>
