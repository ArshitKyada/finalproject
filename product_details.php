<?php
include_once 'connect.php';

session_start(); // Start session for user tracking

// Check if product_id is set in GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = intval($_GET['id']); // Ensure it's an integer
} else {
    die("Error: Product ID is missing."); // Stop execution if no product ID
}

// Simulated logged-in user (replace with actual session user ID)
$user_id = $_SESSION['user_id'] ?? 1; 

// Handle bid submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_bid'])) {
    if (!isset($_POST['bid_amount']) || empty($_POST['bid_amount'])) {
        echo "<script>alert('Error: Bid amount is required!');</script>";
    } else {
        $bid_amount = floatval($_POST['bid_amount']);

        // Get the highest bid
        $bid_sql = "SELECT MAX(bid_amount) AS highest_bid FROM bid WHERE product_id = $product_id";
        $bid_result = $conn->query($bid_sql);
        $highest_bid = 0;

        if ($bid_result->num_rows > 0) {
            $bid_row = $bid_result->fetch_assoc();
            $highest_bid = $bid_row['highest_bid'] ?? 0;
        }

        if ($bid_amount > $highest_bid) {
            // Insert the new bid into the database
            $insert_sql = "INSERT INTO bid (product_id, user_id, bid_amount, bid_time) VALUES ($product_id, $user_id, $bid_amount, NOW())";

            if ($conn->query($insert_sql) === TRUE) {
                echo "<script>alert('Bid placed successfully!'); window.location.href = 'product_details.php?id=$product_id';</script>";
            } else {
                echo "<script>alert('Error placing bid.');</script>";
            }
        } else {
            echo "<script>alert('Your bid must be higher than the current bid!');</script>";
        }
    }
}

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Error: Product not found.");
}

// Fetch the highest bid
$bid_sql = "SELECT MAX(bid_amount) AS highest_bid FROM bid WHERE product_id = $product_id";
$bid_result = $conn->query($bid_sql);
$highest_bid = $row['starting_bid']; // Default to starting bid if no bids exist

if ($bid_result->num_rows > 0) {
    $bid_row = $bid_result->fetch_assoc();
    if ($bid_row['highest_bid'] !== null) {
        $highest_bid = $bid_row['highest_bid'];
    }
}

// Ensure reserve_price is fetched
$reserve_price = $row['reserve_price'] ?? 0;

// Update reserve price status
$reserve_status = ($highest_bid >= $reserve_price) ? "Reserve price has been met" : "Reserve price has not been met";

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/productstyle.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <!-- Left Section -->
            <div class="left-section">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
            </div>
            <!-- Right Section -->
            <div class="right-section">
                <h1><?php echo htmlspecialchars($row['product_name']); ?></h1>
                <p>Korem ipsum dolor amet, consectetur adipiscing elit...</p>
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
                    <p><?php echo ($highest_bid > $row['starting_bid']) ? "Current bid: $" . number_format($highest_bid, 2) : "Starting bid: $" . number_format($row['starting_bid'], 2); ?>
                    </p>
                    <p><?php echo htmlspecialchars($reserve_status); ?></p>
                </div>

                <div class="bid-section">
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <button type="button" onclick="decreaseBid()">-</button>
                        <input type="text" id="bidamount" name="bid_amount"
                            value="<?php echo htmlspecialchars($highest_bid + 10); ?>">
                        <button type="button" onclick="increaseBid()">+</button>
                        <button type="submit" name="place_bid" class="bid-button">Bid</button>
                    </form>
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
    function increaseBid() {
        let bidInput = document.getElementById("bidAmount");
        bidInput.value = parseInt(bidInput.value) + 1;
    }

    function decreaseBid() {
        let bidInput = document.getElementById("bidAmount");
        if (parseInt(bidInput.value) > <?php echo htmlspecialchars($highest_bid); ?>) {
            bidInput.value = parseInt(bidInput.value) - 1;
        }
    }

    /*========================================================================================== */

    document.addEventListener("DOMContentLoaded", function() {
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