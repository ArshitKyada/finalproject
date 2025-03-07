<?php
include_once 'connect.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $endTime = strtotime($row['end_time']); // Convert to UNIX timestamp
} else {
    echo "No product found";
    exit();
}

$conn->close();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Page</title>
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

    .card {
        display: flex;
        flex-direction: column;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .card img {
        width: 100%;
        height: auto;
    }

    .card .left-section,
    .card .right-section {
        padding: 16px;
    }

    .card .left-section {
        flex: 1;
    }

    .card .right-section {
        flex: 1;
    }

    .card .right-section h1 {
        font-size: 24px;
        font-weight: bold;
    }

    .card .right-section p {
        color: #4a5568;
        margin-top: 8px;
    }

    .card .right-section .item-condition {
        margin-top: 16px;
        font-weight: bold;
    }

    .card .right-section .item-condition span {
        color: #48bb78;
    }

    .card .right-section .time-left {
        margin-top: 16px;
    }

    .card .right-section .time-left h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .card .right-section .time-left .time-box {
        display: flex;
        margin-top: 8px;
    }

    .card .right-section .time-left .time-box div {
        background-color: #edf2f7;
        padding: 8px;
        border-radius: 4px;
        text-align: center;
        margin-right: 8px;
    }

    .card .right-section .time-left .time-box div p {
        margin: 0;
    }

    .card .right-section .time-left .time-box div p:first-child {
        font-size: 24px;
        font-weight: bold;
    }

    .card .right-section .time-left .time-box div p:last-child {
        font-size: 12px;
        color: #718096;
    }

    .card .right-section .starting-bid {
        margin-top: 16px;
    }

    .card .right-section .starting-bid p {
        font-size: 18px;
        font-weight: bold;
    }

    .card .right-section .starting-bid p span {
        font-size: 24px;
        color: #2d3748;
    }

    .card .right-section .bid-section {
        margin-top: 16px;
        display: flex;
        align-items: center;
    }

    .card .right-section .bid-section button {
        background-color: #edf2f7;
        color: #2d3748;
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .card .right-section .bid-section input {
        width: 80px;
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        margin: 0 8px;
    }

    .card .right-section .bid-section .bid-button {
        background-color: #48bb78;
        color: white;
    }

    .card .right-section .wishlist {
        margin-top: 16px;
        display: flex;
        align-items: center;
        color: #718096;
        cursor: pointer;
    }

    .card .right-section .wishlist i {
        margin-right: 8px;
    }

    .tabs {
        margin-top: 16px;
        display: flex;
    }

    .tabs button {
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        margin-right: 8px;
    }

    .tabs .active {
        background-color: #48bb78;
        color: white;
    }

    .tabs .inactive {
        background-color: white;
        color: #2d3748;
        border: 1px solid #e2e8f0;
    }

    @media (min-width: 1024px) {
        .card {
            flex-direction: row;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <!-- Left Section -->
            <div class="left-section">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <div class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md">
                    </div>
                </div>
                <div class="flex mt-4 space-x-2">
                </div>
            </div>
            <!-- Right Section -->
            <div class="right-section">
                <h1><?php echo htmlspecialchars($row['product_name']); ?></h1>
                <p>Korem ipsum dolor amet, consectetur adipiscing elit. Maece nas in pulvinar neque. Nulla finibus
                    lobortis pulvinar. Donec a consectetur nulla.</p>
                <p class="item-condition">ITEM CONDITION: <span>
                        <h1><?php echo htmlspecialchars($row['product_condition']); ?></h1>
                    </span></p>
                <div class="time-left">
                    <h2>Time Left:</h2>
                    <div class="time-box">
                        <div>
                            <p id="days">0</p>
                            <p>Days</p>
                        </div>
                        <div>
                            <p id="hours">0</p>
                            <p>Hours</p>
                        </div>
                        <div>
                            <p id="minutes">0</p>
                            <p>Minutes</p>
                        </div>
                        <div>
                            <p id="seconds">0</p>
                            <p>Seconds</p>
                        </div>
                    </div>
                </div>
                <div class="starting-bid">
                    <p>Starting bid: <span><?php echo htmlspecialchars($row['starting_bid']); ?>$</span></p>
                    <p>Reserve price has not been met</p>
                </div>
                <div class="bid-section">
                    <button>-</button>
                    <input type="text" value="<?php echo htmlspecialchars($row['starting_bid']); ?>$">
                    <button>+</button>
                    <button class="bid-button">Bid</button>
                </div>
                <div class="wishlist">
                    <i class="far fa-heart"></i>
                    <span>Add to wishlist</span>
                </div>
            </div>
        </div>
        <div class="tabs">
            <button class="active">Description</button>
            <button class="inactive">Auction history</button>
            <button class="inactive">Reviews (0)</button>
            <button class="inactive">More Products</button>
        </div>
    </div>


    <script>
document.addEventListener("DOMContentLoaded", function () {
    let productId = <?php echo json_encode($product_id); ?>; // Dynamically fetch product ID

    fetch(`get_timer.php?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.end_time) {
                let endTimeUTC = new Date(data.end_time).getTime(); // Parse ISO date correctly

                function updateCountdown() {
                    let now = new Date().getTime();
                    let timeLeft = endTimeUTC - now;

                    if (timeLeft <= 0) {
                        document.querySelector(".time-left").innerHTML = "<p>Auction ended</p>";
                        return;
                    }

                    let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    document.getElementById("days").innerText = days;
                    document.getElementById("hours").innerText = hours;
                    document.getElementById("minutes").innerText = minutes;
                    document.getElementById("seconds").innerText = seconds;
                }

                setInterval(updateCountdown, 1000);
                updateCountdown();
            } else {
                document.querySelector(".time-left").innerHTML = "<p>Invalid product</p>";
            }
        })
        .catch(error => console.error("Error fetching timer:", error));
});
</script>
</body>

</html>