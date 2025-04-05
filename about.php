<?php 
include_once 'header.php';
include_once 'preloader.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f7fafc;
        margin: 0;
        padding: 0;
    }

    body::-webkit-scrollbar {
        display: none;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }

    .hero-section {
        background-color: #fff;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        flex-wrap: wrap;
    }

    .hero-image img {
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
    }

    .hero-text {
        flex: 1;
        padding: 20px;
        text-align: left;
    }

    .raised-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .raised-info i {
        font-size: 28px;
        color: #0A3D62;
    }

    .raised-info div {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }

    .raised-amount {
        font-weight: bold;
        font-size: 20px;
        color: #333;
    }

    .title {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .text {
        color: #4A5568;
        margin-bottom: 15px;
    }

    .list {
        list-style-type: disc;
        padding-left: 20px;
        color: #4A5568;
        margin-bottom: 20px;
    }

    .btn {
        background-color: #0A3D62;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .why-choose-us {
        text-align: center;
        margin-top: 60px;
    }

    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .number {
        font-size: 28px;
        font-weight: bold;
        color: #E2E8F0;
    }

    .icon {
        font-size: 24px;
        color: #0A3D62;
    }

    .card-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        color: #4A5568;
    }

    @media (max-width: 768px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
        }

        .hero-text {
            padding: 10px;
        }

        .raised-info {
            flex-direction: column;
            align-items: center;
        }

        .cards {
            flex-direction: column;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 350px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="hero-section">
            <div class="hero-image">
                <img src="images/home.png" alt="A person in a pink hoodie making an OK sign with both hands">
            </div>
            <div class="hero-text">
                <div class="raised-info">
                    <i class="fas fa-chart-line"></i>
                    <div>
                        <span>Total Raised:</span>
                        <span class="raised-amount">$45,390.00</span>
                    </div>
                </div>
                <h2 class="title">We Work for Your Incredible Success</h2>
                <p class="text">Auction sites present consumers with a thrilling, competitive way to buy the goods and
                    services they need most.</p>
                <p class="text">But getting your own auction site up and running has always required learning complex
                    coding languages, or hiring an expensive design firm.</p>
                <ul class="list">
                    <li>Have enough food for life.</li>
                    <li>Poor children can return to school.</li>
                    <li>Fuga magni veritatis ad temporibus atque adipisci nisi rerum...</li>
                </ul>
                <button class="btn">More About</button>
            </div>
        </div>

        <div class="why-choose-us">
            <h2 class="title">Why Choose Us</h2>
            <p class="text">Explore the world's best & largest Bidding marketplace with our beautiful Bidding products.
                We want to be a part of your smile, success, and future growth.</p>
            <div class="cards">
                <div class="card">
                    <div class="card-header">
                        <div class="number">01</div>
                        <i class="fas fa-gem icon"></i>
                    </div>
                    <h3 class="card-title">High Quality Products</h3>
                    <p class="card-text">Get premium quality items at unbeatable prices.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">02</div>
                        <i class="fas fa-crown icon"></i>
                    </div>
                    <h3 class="card-title">Creator's Royalty</h3>
                    <p class="card-text">Support original creators with our transparent royalty system.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">03</div>
                        <i class="fas fa-tags icon"></i>
                    </div>
                    <h3 class="card-title">Best Prices</h3>
                    <p class="card-text">Affordable and fair pricing for every product.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">04</div>
                        <i class="fas fa-dollar-sign icon"></i>
                    </div>
                    <h3 class="card-title">Multi-Currency Support</h3>
                    <p class="card-text">Bid and pay in your preferred currency.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">05</div>
                        <i class="fas fa-shield-alt icon"></i>
                    </div>
                    <h3 class="card-title">Secure Transactions</h3>
                    <p class="card-text">Your transactions are protected with top-notch security measures.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">06</div>
                        <i class="fas fa-headset icon"></i>
                    </div>
                    <h3 class="card-title">24/7 Customer Support</h3>
                    <p class="card-text">Our dedicated support team is here to assist you anytime.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>
</body>

</html>