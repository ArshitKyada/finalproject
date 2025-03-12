<?php 
include_once 'header.php';
include_once 'connect.php'; // Make sure you have a connection file to your DB

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id']; // Assuming you're storing the logged-in user's ID in session

// Fetch products added by the logged-in seller along with their main images
$sql = "
    SELECT p.*, 
           (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id LIMIT 1) AS image_url 
    FROM products p 
    WHERE p.seller_id = '$user_id'
";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    // If the query failed, output the error
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Seller Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f7fafc;
            overflow-y: hidden;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .seller-container,
        .main-content {
            width: 100%;
        }

        .seller-header {
            background-color: rgb(0, 0, 0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .seller-header h1 {
            font-size: 20px;
            color: rgb(255, 255, 255);
        }

        .notification-button {
            background: none;
            border: none;
            cursor: pointer;
            color: rgb(255, 255, 255);
            margin-right: 16px;
        }

        .main-content {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
            overflow: hidden;
        }

        .dashboard-content {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            max-height: calc(100vh - 190px);
        }

        .seller-content {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Responsive grid */
            gap: 20px; /* Space between cards */
            padding: 20px;
            margin-bottom: 30px;
        }

        .product-card {
            background-color: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }

        .product-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
        }

        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-card h3 {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .product-card p {
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .product-card .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #2563eb;
        }

        .product-card .button {
            margin-top: 10px;
            background-color: #2563eb;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition for button hover */
        }

        .product-card .button:hover {
            background-color: #1d4ed8;
        }

 </style>
</head>

<body>
    <div class="seller-container">
        <!-- Header -->
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
            <div class="header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Sidebar -->
            <?php include_once 'sidebar.php'; ?>
            <!-- Dashboard Content -->
            <main class="dashboard-content">
                <div class="seller-content">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="product-card">
                                <img src="<?php echo htmlspecialchars($row['image_url'] ?: 'default_image_url.jpg'); ?>" alt="Product Image">
                                <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                                <p>Category: <?php echo htmlspecialchars($row['category']); ?></p>
                                <p>Start Time: <?php echo date('m/d/Y', strtotime($row['start_time'])); ?></p>
                                <p>End Time: <?php echo date('m/d/Y', strtotime($row['end_time'])); ?></p>
                                <p class="price">Starting Bid: $<?php echo number_format($row['starting_bid'], 2); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No auctions found.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

<?php
// Close the connection
$conn->close();
?>