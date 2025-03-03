<?php include_once 'header.php' ?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid Cards</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: #f3f4f6;
        overflow-y: scroll;

    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card .content {
        padding: 16px;
    }

    .card .content .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }

    .card .content .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .card .content .user-info .time {
        color: #6b7280;
        font-size: 14px;
    }

    .card .content h2 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .card .content p {
        color: #374151;
        margin-bottom: 16px;
    }

    .card .content p span {
        font-weight: bold;
    }

    .card .content .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card .content .actions button {
        background-color: #10b981;
        color: #ffffff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .card .content .actions i {
        color: #6b7280;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="grid">
            <!-- Card 1 -->
            <div class="card">
                <img src="images/a1.jpg" alt="Vintage alarm clocks">
                <div class="content">
                    <div class="user-info">
                        <div class="time">352 Days 13 Hours 16 Minutes 34 Seconds</div>
                    </div>
                    <h2>Alarm Clock 1990's</h2>
                    <p>Current bid: <span>367.0$</span></p>
                    <div class="actions">
                        <button>Bid now</button>
                        <i class="fas fa-share-alt"></i>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card">
                <img src="images/a2.jpg" alt="Black analogue watch">
                <div class="content">
                    <div class="user-info">
                        <div class="time">352 Days 13 Hours 16 Minutes 34 Seconds</div>
                    </div>
                    <h2>Black Analogue Watch</h2>
                    <p>Current bid: <span>1,000.0$</span></p>
                    <div class="actions">
                        <button>Bid now</button>
                        <i class="fas fa-share-alt"></i>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card">
                <img src="images/a3.jpg" alt="Ford Shelby white car">
                <div class="content">
                    <div class="user-info">
                        <div class="time">352 Days 13 Hours 16 Minutes 34 Seconds</div>
                    </div>
                    <h2>Ford Shelby White Car</h2>
                    <p>Starting bid: <span>10,000.0$</span></p>
                    <div class="actions">
                        <button>Bid now</button>
                        <i class="fas fa-share-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>