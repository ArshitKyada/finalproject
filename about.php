<?php include_once 'header.php' ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Hero Section */
        .hero-section {
            background-color: #fff;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            flex-direction: row;
        }

        .hero-image img {
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }

        .hero-text {
            margin-left: 30px;
            text-align: left;
        }

        .raised-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 24px;
            color: #0A3D62;
        }

        .raised-amount {
            font-size: 24px;
            font-weight: bold;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .text {
            color: #4A5568;
            margin-bottom: 20px;
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

        /* Why Choose Us Section */
        .why-choose-us {
            text-align: center;
            margin-top: 60px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .number {
            font-size: 32px;
            font-weight: bold;
            color: #E2E8F0;
        }

        .icon {
            font-size: 24px;
            color: #0A3D62;
            margin-left: 10px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #4A5568;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-image">
                <img src="images/home.png" alt="A person in a pink hoodie making an OK sign with both hands">
            </div>
            <div class="hero-text">
                <div class="raised-info">
                    <i class="fas fa-chart-line icon"></i>
                    <div>
                        <p>Total Raised</p>
                        <p class="raised-amount">$45,390.00</p>
                    </div>
                </div>
                <h2 class="title">We Work for Your Incredible Success</h2>
                <p class="text">Auction sites present consumers with a thrilling, competitive way to buy the goods and services they need most.</p>
                <p class="text">But getting your own auction site up and running has always required learning complex coding languages, or hiring an expensive design firm for thousands of dollars and months of work.</p>
                <ul class="list">
                    <li>Have enough food for life.</li>
                    <li>Poor children can return to school.</li>
                    <li>Fuga magni veritatis ad temporibus atque adipisci nisi rerum...</li>
                </ul>
                <button class="btn">More About</button>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="why-choose-us">
            <h2 class="title">Why Choose Us</h2>
            <p class="text">Explore on the world's best & largest Bidding marketplace with our beautiful Bidding products. We want to be a part of your smile, success and future growth.</p>
            <div class="cards">
                <div class="card">
                    <div class="card-header">
                        <div class="number">01</div>
                        <i class="fas fa-gem icon"></i>
                    </div>
                    <h3 class="card-title">High Quality Products</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">02</div>
                        <i class="fas fa-crown icon"></i>
                    </div>
                    <h3 class="card-title">Creator's Royalty</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">03</div>
                        <i class="fas fa-tags icon"></i>
                    </div>
                    <h3 class="card-title">Top Class Product Price</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">04</div>
                        <i class="fas fa-dollar-sign icon"></i>
                    </div>
                    <h3 class="card-title">Support Multiple Currency</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">05</div>
                        <i class="fas fa-history icon"></i>
                    </div>
                    <h3 class="card-title">Show All Bidders History</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="number">06</div>
                        <i class="fas fa-smile icon"></i>
                    </div>
                    <h3 class="card-title">100% Happy Customer</h3>
                    <p class="card-text">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
