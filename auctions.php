<?php 
include_once 'header.php'; // Include your header file
include_once 'preloader.php'; // Include your preloader file
include_once 'connect.php'; // Database connection file

// Base SQL query to select all products
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
        ORDER BY p.start_time DESC"; // Default to recent

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid Cards</title>
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
    </style>
</head>

<body>
    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="card-link">
            <div class="card">
                <div class="relative">
                    <img src="<?php echo $row['coverImageMain']; ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <div class="auction-status">
                        <?php 
                        if ($row['auction_status'] == 'sold') {
                            echo '<span class="status sold">Sold</span>';
                        } elseif ($row['auction_status'] == 'ended') {
                            echo '<span class="status ended">Auction Ended</span>';
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
</body>
</html>