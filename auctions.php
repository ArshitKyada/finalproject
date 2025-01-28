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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .header1 {
        background-color: #4a6b82;
        color: white;
        text-align: center;
        padding: 50px 20px;
    }

    .header1 h1 {
        font-size: 36px;
        margin: 0;
    }

    .header1 p {
        font-size: 18px;
        margin: 10px 0 0;
    }

    .filter {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .filter label {
        font-size: 18px;
        margin-right: 10px;
    }

    .filter select {
        padding: 5px;
        font-size: 16px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 300px;
        padding: 15px;
        box-sizing: border-box;
    }

    .card img {
        width: 100%;
        border-radius: 8px;
    }

    .card h3 {
        font-size: 18px;
        font-weight: 500;
        margin: 15px 0 10px;
    }

    .card p {
        margin: 5px 0;
        color: #555;
    }

    .card .price {
        font-weight: 500;
    }

    .card .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .card .actions .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .card .actions .btn i {
        margin-right: 5px;
    }

    .card .actions .btn:hover {
        background-color: #0056b3;
    }

    .card .actions .icon {
        color: #007bff;
        cursor: pointer;
        font-size: 18px;
    }

    .card .actions .icon:hover {
        color: #0056b3;
    }
    </style>
</head>

<body>
    <?php include_header(); ?>


    <div class="header1">
        <h1>We verify all auctioned items at our warehouse</h1>
        <p>Protection safely assured. All items are inspected for authenticity and quality assurance.</p>
    </div>

    <div class="filter">
        <label for="auction-filter">Filter by:</label>
        <select id="auction-filter">
            <option value="all">All auctions</option>
        </select>
    </div>

    <div class="container">
        <div class="card">
            <img alt="Apple iPhone 13 Pro Max"
                src="https://storage.googleapis.com/a1aa/image/ZPDKziiF0LozHR0nuOtfDm0rFRxxiJDe0n1oQMIi8eFe0xegC.jpg" />
            <h3>Apple iPhone 13 Pro Max</h3>
            <p class="price">Starting Price: $1000</p>
            <p class="price">Top Bid: $2000</p>
            <p>1 bids placed</p>
            <p>Condition: No visible defects</p>
            <p class="countdown" data-end-time="2025-01-29T15:30:00Z">Auction ending in: --</p>
            <div class="actions">
                <i class="fas fa-share-alt icon"></i>
                <i class="fas fa-heart icon"></i>
                <button class="btn"><i class="fas fa-gavel"></i> + Bid</button>
            </div>
        </div>

        <div class="card">
            <img alt="Apple iPhone 13 Pro Max"
                src="https://storage.googleapis.com/a1aa/image/cUw8bkDTugpkMdneeJE6O0GePuEWf7N3bBXFPDlJwzeypj9gC.jpg" />
            <h3>Apple air pro</h3>
            <p class="price">Starting Price: $1200</p>
            <p class="price">Top Bid: $2500</p>
            <p>1 bids placed</p>
            <p>Condition: No visible defects</p>
            <p class="countdown" data-end-time="2025-01-29T15:30:00Z">Auction ending in: --</p>
            <div class="actions">
                <i class="fas fa-share-alt icon"></i>
                <i class="fas fa-heart icon"></i>
                <button class="btn"><i class="fas fa-gavel"></i> + Bid</button>
            </div>
        </div>

        <div class="card">
            <img alt="Apple iPhone 13 Pro Max"
                src="https://storage.googleapis.com/a1aa/image/Im40cm6COxLZLZxj9Dew0gjqIec9Zey3JYwXf4Gz93kx0xegC.jpg" />
            <h3>Coffee Table</h3>
            <p class="price">Starting Price: $300</p>
            <p class="price">Top Bid: $500</p>
            <p>1 bids placed</p>
            <p>Condition: No visible defects</p>
            <p class="countdown" data-end-time="2025-01-29T15:30:00Z">Auction ending in: --</p>
            <div class="actions">
                <i class="fas fa-share-alt icon"></i>
                <i class="fas fa-heart icon"></i>
                <button class="btn"><i class="fas fa-gavel"></i> + Bid</button>
            </div>
        </div>

    </div>

    <script>
    function updateCountdown() {
        const countdownElements = document.querySelectorAll('.countdown');

        countdownElements.forEach(el => {
            const endTime = new Date(el.dataset.endTime).getTime();
            const now = new Date().getTime();
            const timeLeft = endTime - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                el.textContent =
                    `Auction ending in: ${days} day(s) ${hours} hour(s) ${minutes} minute(s) ${seconds} second(s)`;
            } else {
                el.textContent = 'Auction ended';
            }
        });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
    </script>

</body>

</html>