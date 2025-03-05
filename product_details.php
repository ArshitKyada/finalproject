<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px;
        }
        .product {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .product img {
            width: 100%;
            height: auto;
        }
        .product .left, .product .right {
            padding: 16px;
        }
        .product .left {
            flex: 1;
        }
        .product .right {
            flex: 1;
        }
        .product .right h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .product .right p {
            color: #4a5568;
            margin-top: 8px;
        }
        .product .right .condition {
            font-weight: bold;
            color: #2d3748;
            margin-top: 16px;
        }
        .product .right .time-left {
            margin-top: 16px;
        }
        .product .right .time-left p {
            font-weight: bold;
            color: #2d3748;
        }
        .product .right .time-left .time {
            display: flex;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        .product .right .time-left .time div {
            background-color: #edf2f7;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            margin-right: 8px;
            margin-bottom: 8px;
            flex: 1 1 100px;
        }
        .product .right .time-left .time div p {
            margin: 0;
        }
        .product .right .time-left .time div p:first-child {
            font-size: 24px;
            font-weight: bold;
        }
        .product .right .time-left .time div p:last-child {
            color: #4a5568;
        }
        .product .right .bid {
            margin-top: 16px;
        }
        .product .right .bid p {
            font-weight: bold;
            color: #2d3748;
        }
        .product .right .bid p span {
            font-size: 24px;
            font-weight: bold;
        }
        .product .right .bid .reserve {
            color: #4a5568;
        }
        .product .right .bid-controls {
            display: flex;
            align-items: center;
            margin-top: 16px;
        }
        .product .right .bid-controls button {
            background-color: #edf2f7;
            color: #2d3748;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .product .right .bid-controls input {
            width: 80px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin: 0 8px;
        }
        .product .right .bid-controls .bid-button {
            background-color: #48bb78;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .product .right .wishlist {
            display: flex;
            align-items: center;
            margin-top: 16px;
        }
        .product .right .wishlist i {
            color: #4a5568;
            margin-right: 8px;
        }
        .thumbnails {
            display: flex;
            flex-wrap: wrap;
            margin-top: 16px;
        }
        .thumbnails img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 8px;
            margin-bottom: 8px;
            border-radius: 8px;
        }
        .tabs {
            display: flex;
            flex-wrap: wrap;
            margin-top: 16px;
        }
        .tabs button {
            background-color: #48bb78;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin-right: 8px;
            margin-bottom: 8px;
        }
        .tabs button.inactive {
            background-color: #fff;
            color: #2d3748;
            border: 1px solid #e2e8f0;
        }
        @media (max-width: 768px) {
            .product {
                flex-direction: column;
            }
            .product .right .time-left .time div {
                flex: 1 1 45%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product">
            <!-- Left Section -->
            <div class="left">
                <div class="image-container">
                    <img src="https://storage.googleapis.com/a1aa/image/mFJsLCnWGQAqWGRZ0fNsz0kP3XM1Wa0wGX-dBeiBhCw.jpg" alt="A black vintage typewriter with a sheet of paper inserted">
                    <div class="zoom-icon">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="thumbnails">
                    <img src="https://storage.googleapis.com/a1aa/image/C0yGo2s5eEgylv6vhTbtcoH6sSieXlNPmfpY1Ttm-gY.jpg" alt="Thumbnail of a black vintage typewriter">
                    <img src="https://storage.googleapis.com/a1aa/image/xxrAZW-rM9EHgt5Hk_0QXJWPXYqrS8Y7Gj4w0Ai-ecM.jpg" alt="Thumbnail of sunglasses">
                    <img src="https://storage.googleapis.com/a1aa/image/dIA0fsbvoRjIhcIPJc8zjq7GvBc5UMS4sc-XSEC5SWc.jpg" alt="Thumbnail of a wristwatch">
                    <img src="https://storage.googleapis.com/a1aa/image/jzQOtNTM2bOmoqD15DWKcbph2GaksDYVzD9sVip46yk.jpg" alt="Thumbnail of vintage electronics">
                </div>
            </div>
            <!-- Right Section -->
            <div class="right">
                <h1>Premium 1998 Typewriter</h1>
                <p>Korem ipsum dolor amet, consectetur adipiscing elit. Maece nas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                <p class="condition">ITEM CONDITION: NEW</p>
                <div class="time-left">
                    <p>Time Left:</p>
                    <div class="time">
                        <div>
                            <p>350</p>
                            <p>Days</p>
                        </div>
                        <div>
                            <p>13</p>
                            <p>Hours</p>
                        </div>
                        <div>
                            <p>37</p>
                            <p>Minutes</p>
                        </div>
                        <div>
                            <p>6</p>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <p>Auction ends: February 19, 2026 12:00 am</p>
                    <p>Timezone: UTC 0</p>
                </div>
                <div class="bid">
                    <p>Starting bid: <span>560.0$</span></p>
                    <p class="reserve">Reserve price has not been met</p>
                </div>
                <div class="bid-controls">
                    <button>-</button>
                    <input type="text" value="560.0$">
                    <button>+</button>
                    <button class="bid-button">Bid</button>
                </div>
                <div class="wishlist">
                    <i class="far fa-heart"></i>
                    <p>Add to wishlist</p>
                </div>
            </div>
        </div>
        <div class="tabs">
            <button>Description</button>
            <button class="inactive">Auction history</button>
            <button class="inactive">Reviews (0)</button>
            <button class="inactive">More Products</button>
        </div>
    </div>
</body>
</html>