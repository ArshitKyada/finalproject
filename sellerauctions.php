<?php 

include_once 'preloader.php';
include_once 'header.php';
include_once 'connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT p.*, 
           pi.image_url,
           CASE 
               WHEN NOW() < p.start_time THEN 'Active'
               WHEN NOW() BETWEEN p.start_time AND p.end_time THEN 'Active'
               ELSE 'Ended'
           END AS status
    FROM products p 
    LEFT JOIN product_images pi ON pi.product_id = p.id
    WHERE p.seller_id = '$user_id'
    GROUP BY p.id
";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
    body {
        overflow: hidden;
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
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .product-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: white;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-card .product-details {
        flex-grow: 1;
    }

    .product-card .button-container {
        display: flex;
        gap: 10px;
        margin-top: 5px;
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

    .product-card .edit-button {
        margin-top: 10px;
        width: 60px;
        background-color: gold;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .product-card .edit-button:hover {
        background-color: rgb(192, 164, 5);
    }

    .product-card .delete-button {
        margin-top: 10px;
        width: 60px;
        background-color: red;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .product-card .delete-button:hover {
        background-color: #dc143c;
    }

    .status-label {
        background-color: #2563eb;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        position: absolute;
        top: 25px;
        left: 25px;
        font-size: 0.9rem;
    }

    @media (max-width:768px) {
        .main-content{
            margin-bottom:50px;
        }
    }
    </style>
    <script>
    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = 'delete_product.php?id=' + productId;
        }
    }
    </script>
</head>

<body>
    <div class="seller-container">
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
            <div class="header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <div class="main-content">
            <?php include_once 'sidebar.php'; ?>
            <main class="dashboard-content">
                <div class="seller-content">
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <div class="status-label"><?php echo htmlspecialchars($row['status']); ?></div>
                        <img src="<?php echo htmlspecialchars($row['image_url'] ?: 'default_image_url.jpg'); ?>"
                            alt="Product Image">

                        <div class="product-details">
                            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <p>Category: <?php echo htmlspecialchars($row['category']); ?></p>
                            <p>Start Time: <?php echo date('m/d/Y', strtotime($row['start_time'])); ?></p>
                            <p>End Time: <?php echo date('m/d/Y', strtotime($row['end_time'])); ?></p>
                            <p class="price">Starting Bid: $<?php echo number_format($row['starting_bid'], 2); ?></p>
                        </div>

                        <div class="button-container">
                            <button class="edit-button"
                                onclick="location.href='edit_product.php?id=<?php echo $row['id']; ?>'">Edit</button>
                            <button class="delete-button"
                                onclick="deleteProduct(<?php echo $row['id']; ?>)">Delete</button>
                        </div>
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
$conn->close();
?>