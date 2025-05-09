<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'preloader.php';
include_once 'header.php';
include_once 'connect.php';

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT p.*, 
               (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id ORDER BY pi.id LIMIT 1) AS coverImageMain,
               COALESCE(MAX(b.bid_amount), p.starting_bid) AS highest_bid,
               p.end_time,
               (CASE 
                    WHEN NOW() > p.end_time AND MAX(b.bid_amount) IS NOT NULL THEN 'sold' 
                    WHEN NOW() > p.end_time THEN 'ended' 
                    ELSE 'active' 
                END) AS auction_status
        FROM products p
        LEFT JOIN bid b ON p.id = b.product_id
        GROUP BY p.id
        ORDER BY p.start_time DESC
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

$totalResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$totalRow = mysqli_fetch_assoc($totalResult);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $limit);
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
        z-index: 10;
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
                        if ($row['auction_status'] == 'sold') {
                            echo '<span class="status sold">Sold</span>';
                        } elseif ($row['auction_status'] == 'ended') {
                            echo '<span class="status ended">Unsold</span>';
                        } else {
                            echo '<span class="status active">Active</span>';
                        }
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