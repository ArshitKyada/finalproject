<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Auction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .auction-container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            text-align: center;
        }

        /* Auction Grid */
        .auction-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        /* Auction Items */
        .auction-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .auction-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .auction-item h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .bid {
            color: #555;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .bid span {
            font-weight: bold;
            color: #000;
        }

        /* Timer */
        .timer {
            display: flex;
            justify-content: space-around;
            margin-bottom: 15px;
        }

        .timer .time {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .timer .label {
            font-size: 0.9rem;
            color: #666;
        }

        /* Button */
        .bid-btn {
            background-color: #0A3D62;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .bid-btn:hover {
            background-color:rgb(19, 102, 161);
        }
    </style>
</head>
<body>
    <?php require_once 'header.php' ?>
    <div class="auction-container">

        <div class="auction-grid">
            <!-- Auction Item 1 -->
            <div class="auction-item">
                <div class="timer">
                    <div><p class="time">355</p><p class="label">Days</p></div>
                    <div><p class="time">10</p><p class="label">Hours</p></div>
                    <div><p class="time">38</p><p class="label">Minutes</p></div>
                    <div><p class="time">56</p><p class="label">Seconds</p></div>
                </div>
                <img src="https://storage.googleapis.com/a1aa/image/P8smgEEg_lE-goZyqy-Np2J96Oee-p5F3eJQMB2W0vg.jpg" alt="Vintage alarm clock">
                <h2>Alarm Clock 1990’s</h2>
                <p class="bid">Current bid: <span>$330.0</span></p>
                <button class="bid-btn">Place A Bid</button>
            </div>

            <!-- Auction Item 2 -->
            <div class="auction-item">
                <div class="timer">
                    <div><p class="time">355</p><p class="label">Days</p></div>
                    <div><p class="time">10</p><p class="label">Hours</p></div>
                    <div><p class="time">38</p><p class="label">Minutes</p></div>
                    <div><p class="time">56</p><p class="label">Seconds</p></div>
                </div>
                <img src="https://storage.googleapis.com/a1aa/image/raHtk8Yp5Wmd5eFVCMvleSkQAf21lC4Kfkewir5uNC0.jpg" alt="Premium 1998 typewriter">
                <h2>Premium 1998 Typewriter</h2>
                <p class="bid">Starting bid: <span>$560.0</span></p>
                <button class="bid-btn">Place A Bid</button>
            </div>

            <!-- Auction Item 3 -->
            <div class="auction-item">
                <div class="timer">
                    <div><p class="time">355</p><p class="label">Days</p></div>
                    <div><p class="time">10</p><p class="label">Hours</p></div>
                    <div><p class="time">38</p><p class="label">Minutes</p></div>
                    <div><p class="time">56</p><p class="label">Seconds</p></div>
                </div>
                <img src="https://storage.googleapis.com/a1aa/image/DpjgYnbv3J2aBsBpE3kVafODSAhxjRZiVmQu1MEh_3k.jpg" alt="Macbook Pro 2018">
                <h2>Macbook Pro 2018</h2>
                <p class="bid">Starting bid: <span>$1,199.0</span></p>
                <button class="bid-btn">Place A Bid</button>
            </div>
        </div>
    </div>

</body>
</html>
