<?php
include_once 'connect.php';
include_once 'preloader.php';

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

        // Check if the user is the seller of the product
        $product_sql = "SELECT seller_id FROM products WHERE id = $product_id";
        $product_result = $conn->query($product_sql);
        $product_row = $product_result->fetch_assoc();

        if ($product_row['seller_id'] == $user_id) {
            echo "<script>alert('Error: You cannot bid on your own product!');</script>";
        } else {
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

// Fetch the main image from product_images table
$image_sql = "SELECT image_url FROM product_images WHERE product_id = $product_id LIMIT 1"; // Fetch only the main image
$image_result = $conn->query($image_sql);
$image_url = '';

if ($image_result->num_rows > 0) {
    $image_row = $image_result->fetch_assoc();
    $image_url = $image_row['image_url'];
}

// Fetch additional images from product_images table
$additional_images_sql = "SELECT image_url FROM product_images WHERE product_id = $product_id LIMIT 4 OFFSET 1"; // Fetch the next 4 images
$additional_images_result = $conn->query($additional_images_sql);
$additional_images = [];

// Add the main image to the additional images array
if ($image_url) {
    array_unshift($additional_images, $image_url); // Add main image at the start
}

if ($additional_images_result->num_rows > 0) {
    while ($img_row = $additional_images_result->fetch_assoc()) {
        $additional_images[] = $img_row['image_url'];
    }
}

// Ensure reserve_price is fetched
$reserve_price = $row['reserve_price'] ?? 0;

// Update reserve price status
$reserve_status = ($highest_bid >= $reserve_price) ? "Reserve price has been met" : "Reserve price has not been met";

// Fetch all products from the same seller for the "More Products" tab
$seller_id = $row['seller_id'];
$more_products_sql = "
    SELECT p.id, p.product_name, p.description, p.starting_bid, p.end_time,
           (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id LIMIT 1) AS image_url
    FROM products p
    WHERE p.seller_id = $seller_id AND p.id != $product_id
";
$more_products_result = $conn->query($more_products_sql);

// Fetch reviews for the product
$reviews_sql = "SELECT r.id, r.rating, r.comment, r.created_at, u.username, r.user_id FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = $product_id ORDER BY r.created_at DESC";
$reviews_result = $conn->query($reviews_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="js/script.js"></script>
    <style>
    body {
        background-color: #f7fafc;
        font-family: Arial, sans-serif;
        overflow-y: scroll;
    }

    body::-webkit-scrollbar {
        display: none;
    }

    .product-container {
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
        margin-bottom: 16px;
    }

    .card img {
        width: 600px;
        height: 500px;
        object-fit: cover;
        border-radius: 8px;
    }

    .additional-images {
        display: flex;
        margin-top: 10px;
        flex-wrap: wrap;
        gap: 7px;
        border-radius: 8px;
        padding: 5px;
    }

    .additional-images img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
        margin: 5px;
        cursor: pointer;
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
        padding: 20px;
    }

    .card .right-section h1 {
        font-size: 26px;
        font-weight: 600;
        color: #2d3748;
    }

    .card .right-section .bid-section button {
        background-color: #0A3D62;
        color: white;
        width: 100px;
        height: 50px;
        transition: background-color 0.3s;
    }

    .card .right-section .bid-section button:hover {
        background-color: rgb(8, 44, 69);
        color: white;
    }

    .card .right-section .bid-section input {
        border: 2px solid #e2e8f0;
        border-radius: 4px;
        padding: 10px;
        font-size: 16px;
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
        text-align: center;
    }

    .card .right-section .time-left .time-box {
        display: flex;
        justify-content: center;
        margin-top: 8px;
    }

    .card .right-section .time-left .time-box div {
        background-color: #edf2f7;
        padding: 16px;
        border-radius: 4px;
        text-align: center;
        margin-right: 8px;
        flex: 1;
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
        color: rgb(72, 75, 80);
    }

    .card .right-section .starting-bid p span.price {
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
        padding: 10px 20px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .card .right-section .bid-section input {
        width: 80px;
        padding: 10px 20px;
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        margin: 0 8px;
    }

    .card .right-section .bid-section .bid-button {
        background-color: #0A3D62;
        color: white;
        width: 200px;
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
        background-color: #0A3D62;
        color: white;
    }

    .tabs .inactive {
        background-color: white;
        color: #2d3748;
        border: 1px solid #e2e8f0;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .more-products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 20px;
    }

    .more-products-container .card {
        flex: 1 1 calc(50% - 16px);
        max-width: calc(50% - 16px);
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .more-products-container .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .more-products-container .card img {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    @media (min-width: 768px) {
        .more-products-container .card {
            flex: 1 1 calc(25% - 16px);
            width: 400px;
        }
    }

    .more-products-container .right-section {
        padding: 16px;
    }

    .more-products-container .right-section h1 {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
        color: #2d3748;
    }

    .more-products-container .right-section p {
        color: #4a5568;
        margin: 4px 0;
    }

    .more-products-container .starting-bid {
        font-weight: bold;
        color: #0A3D62;
        font-size: 16px;
    }

    .more-products-container .card a {
        text-decoration: none;
        color: inherit;
    }

    @media (min-width: 1024px) {
        .card {
            flex-direction: row;
        }
    }

    @media (max-width: 768px) {
        .card img {
            width: 100%;
            height: auto;
        }

        .additional-images {
            flex-direction: row;
            overflow-x: auto;
        }

        .additional-images img {
            width: 68px;
            height: 80px;
        }
    }

    /* Reviews Section */
    .reviews-list {
        margin-top: 20px;
    }

    .review {
        background-color: #f9f9f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .review-rating {
        color: #f39c12;
        /* Gold color for stars */
    }

    .review-date {
        font-size: 0.9em;
        color: #718096;
        /* Gray color */
    }

    .review-form {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding-right: 30px;
    }

    .review-form label {
        display: block;
        margin-top: 10px;
    }

    .review-form textarea {
        width: 100%;
        height: 80px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 5px;
        background-color: #f7fafc;
    }

    .review-form button {
        margin-top: 10px;
        background-color: #0A3D62;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .review-form button:hover {
        background-color: rgb(7, 41, 65);
        /* Darker shade on hover */
    }

    .rating-container {
        display: flex;
        align-items: center;
        /* Align items vertically */
    }

    .rating-container label {
        margin-right: 10px;
        margin-top: 10px;
        /* Space between label and stars */
    }

    .star-rating {
        direction: rtl;
        /* Right to left for star selection */
        display: flex;
        justify-content: flex-start;
        /* Align stars to the left */
    }

    .star-rating input {
        display: none;
        /* Hide the radio buttons */
    }

    .star-rating label {
        font-size: 30px;
        color: #ddd;
        /* Default star color */
        cursor: pointer;
    }

    .star-rating input:checked~label {
        color: #f39c12;
        /* Color for selected stars */
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f39c12;
        /* Color for hovered stars */
    }

    .delete-button {
        background-color: #e53e3e;
        /* Red color */
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: #c53030;
        /* Darker red on hover */
    }

    /* Auction History Styles */
    .bid-entry {
        background-color: #f9f9f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .bid-entry p {
        margin: 5px 0;
        color: #4a5568;
    }

    .bid-entry strong {
        color: #2d3748;
    }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="product-container">
        <div class="card">
            <!-- Left Section -->
            <div class="left-section">
                <div class="relative">
                    <img id="mainImage" src="<?php echo htmlspecialchars($image_url); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
                <div class="additional-images">
                    <?php foreach ($additional_images as $additional_image): ?>
                    <img src="<?php echo htmlspecialchars($additional_image); ?>" alt="Additional Image"
                        onclick="changeMainImage('<?php echo htmlspecialchars($additional_image); ?>')">
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Right Section -->
            <div class="right-section">
                <h1><?php echo htmlspecialchars($row['product_name']); ?></h1>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p class="item-condition">ITEM CONDITION:
                    <span><?php echo htmlspecialchars($row['product_condition']); ?></span>
                </p>
                <div class="time-left">
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
                    <p><span
                            class="price"><?php echo ($highest_bid > $row['starting_bid']) ? "Current bid: $" . number_format($highest_bid, 2) : "Starting bid: $" . number_format($row['starting_bid'], 2); ?></span>
                    </p>
                    <p><span class="text"><?php echo htmlspecialchars($reserve_status); ?></span></p>
                </div>

                <div class="bid-section">
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <button type="button" onclick="decreaseBid()">-</button>
                        <input type="text" id="bidamount" name="bid_amount"
                            value="<?php echo htmlspecialchars($highest_bid + 10); ?>">
                        <button type="button" onclick="increaseBid()">+</button>
                        <br><br>
                        <button type="submit" name="place_bid" class="bid-button">Bid</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tabs">
            <button class="active" onclick="showTab('description')">Description</button>
            <button class="inactive" onclick="showTab('auction-history')">Auction History</button>
            <button class="inactive" onclick="showTab('reviews')">Reviews
                (<?php echo $reviews_result->num_rows; ?>)</button>
            <button class="inactive" onclick="showTab('more-products')">More Products</button>
        </div>

        <div id="description" class="tab-content active">
            <h2>Description</h2>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
        </div>

        <div id="auction-history" class="tab-content">
            <h2>Auction History</h2>
            <?php
    $history_sql = "
        SELECT b.bid_amount, b.bid_time, u.username 
        FROM bid b 
        JOIN users u ON b.user_id = u.id 
        WHERE b.product_id = $product_id 
        ORDER BY b.bid_time DESC";
    $history_result = $conn->query($history_sql);
    if ($history_result->num_rows > 0) {
        while ($history_row = $history_result->fetch_assoc()) {
            echo '<div class="bid-entry">';
            echo '<p><strong>Username:</strong> ' . htmlspecialchars($history_row['username']) . '</p>';
            echo '<p><strong>Bid:</strong> $' . number_format($history_row['bid_amount'], 2) . '</p>';
            echo '<p><strong>Time:</strong> ' . htmlspecialchars($history_row['bid_time']) . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>No bids placed yet.</p>";
    }
    ?>
        </div>
        <div id="reviews" class="tab-content">
            <h2>Reviews</h2>
            <div class="review-form">
                <h3>Submit Your Review</h3>
                <hr>
                <form action="submit_review.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <div class="rating-container">
                        <label for="rating">Rating:</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" class="star">★</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" class="star">★</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" class="star">★</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" class="star">★</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" class="star">★</label>
                        </div>
                    </div>
                    <label for="comment">Comment:</label><br>
                    <textarea name="comment" id="comment" required></textarea>
                    <button type="submit">Submit Review</button>
                </form>
            </div>
            <?php if ($reviews_result->num_rows > 0): ?>
            <div class="reviews-list">
                <?php while ($review_row = $reviews_result->fetch_assoc()): ?>
                <div class="review">
                    <div class="review-header">
                        <strong><?php echo htmlspecialchars($review_row['username']); ?></strong>
                        <span class="review-rating"><?php echo str_repeat('★', $review_row['rating']); ?></span>
                        <span class="review-date"><?php echo htmlspecialchars($review_row['created_at']); ?></span>
                        <?php if ($review_row['user_id'] == $user_id): ?>
                        <form action="delete_review.php" method="post" style="display:inline;">
                            <input type="hidden" name="review_id" value="<?php echo $review_row['id']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <p><?php echo htmlspecialchars($review_row['comment']); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <p>No reviews yet.</p>
            <?php endif; ?>
        </div>
        <div id="more-products" class="tab-content">
            <h2>More Products</h2>
            <div class="more-products-container">
                <?php
                if ($more_products_result->num_rows > 0) {
                    while ($more_product_row = $more_products_result->fetch_assoc()) {
                        $image_url = isset($more_product_row['image_url']) ? htmlspecialchars($more_product_row['image_url']) : 'default_image.jpg';

                        echo '<div class="card">';
                        echo '<a href="product_details.php?id=' . $more_product_row['id'] . '">';
                        echo '<img src="' . $image_url . '" alt="' . htmlspecialchars($more_product_row['product_name']) . '">';
                        echo '<div class="right-section">';
                        echo '<h1>' . htmlspecialchars($more_product_row['product_name']) . '</h1>';
                        echo '<br>';
                        // Display End Date
                        $end_time = new DateTime($more_product_row['end_time']);
                        echo '<p>End Date: ' . htmlspecialchars($end_time->format('Y-m-d')) . '</p>'; // Format as needed
                        echo '<p class="starting-bid">Starting bid: $' . number_format($more_product_row['starting_bid'], 2) . '</p>';
                        echo '</div>'; // Close right-section div
                        echo '</a>';
                        echo '</div>'; // Close card div
                    }
                } else {
                    echo "<p>No more products from this seller.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
    function increaseBid() {
        let bidInput = document.getElementById("bidamount");
        bidInput.value = parseInt(bidInput.value) + 10;
    }

    function decreaseBid() {
        let bidInput = document.getElementById("bidamount");
        if (parseInt(bidInput.value) > <?php echo htmlspecialchars($highest_bid); ?>) {
            bidInput.value = parseInt(bidInput.value) - 10;
        }
    }

    function changeMainImage(imageUrl) {
        document.getElementById("mainImage").src = imageUrl; // Change the main image source
    }

    function showTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.remove('active');
        });

        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.tabs button');
        tabs.forEach(tab => {
            tab.classList.remove('active');
            tab.classList.add('inactive');
        });

        // Show the selected tab content
        document.getElementById(tabName).classList.add('active');

        // Set the clicked tab as active
        const activeTab = Array.from(tabs).find(tab => tab.textContent.toLowerCase().includes(tabName.replace('-',
            ' ')));
        if (activeTab) {
            activeTab.classList.add('active');
            activeTab.classList.remove('inactive');
        }
    }

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