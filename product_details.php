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
    <link rel="stylesheet" href="css/productdetailsstyle.css">
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