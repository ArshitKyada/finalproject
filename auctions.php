<?php 
include_once 'header.php'; // Include your header file
include_once 'preloader.php'; // Include your preloader file
include_once 'connect.php'; // Database connection file

// Pagination variables
$limit = 8; // Number of items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Calculate offset

// Base SQL query to select all products with LIMIT and OFFSET
$sql = "SELECT p.id, p.product_name, p.starting_bid, p.end_time, 
               (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id ORDER BY pi.id LIMIT 1) AS coverImageMain,
               COALESCE(MAX(b.bid_amount), p.starting_bid) AS highest_bid
        FROM products p
        LEFT JOIN bid b ON p.id = b.product_id
        GROUP BY p.id
        ORDER BY p.start_time DESC
        LIMIT $limit OFFSET $offset"; // Add LIMIT and OFFSET

$result = mysqli_query($conn, $sql);

// Query to count total products
$totalResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$totalRow = mysqli_fetch_assoc($totalResult);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $limit); // Calculate total pages
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/auctionstyle.css">
    <style>
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .relative {
            position: relative;
        }

        .auction-status {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            z-index: 10; /* Ensure it stays on top */
        }

        .status.ended {
            color: red;
        }

        .status.sold {
            color: green;
        }

        .status.active {
            color: blue;
        }

        .content {
            padding: 15px;
        }

        img {
            width: 100%;
            height: auto;
            display: block;
        }

        .actions {
            margin-top: 10px;
        }

        .actions button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #218838;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
            text-decoration: none;
            color: rgb(11, 42, 76);
            background-color: white;
        }

        .pagination a.active {
            background-color: rgb(12, 40, 70);
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="card-link">
            <div class="card">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($row['coverImageMain']); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>" loading="lazy">
                    <div class="auction-status">
                        <?php 
                        $auction_status = 'active';
                        if (strtotime($row['end_time']) < time()) {
                            $auction_status = isset($row['highest_bid']) ? 'sold' : 'ended';
                        }
                        echo '<span class="status ' . $auction_status . '">' . ucfirst($auction_status) . '</span>';
                        ?>
                    </div>
                </div>
                <div class="content">
                    <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p>Current bid: <span>$<?php echo number_format($row['highest_bid'], 2); ?></span></p>
                    <p>Ends on: <span><?php echo date('Y-m-d', strtotime($row['end_time'])); ?></span></p>
                    <div class="actions">
                        <button>Bid Now</button>
                    </div>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>

    <?php include_once 'footer.php'; ?>
</body>
</html>