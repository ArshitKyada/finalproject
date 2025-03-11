<?php 
include_once 'header.php';
include_once 'preloader.php';
include_once 'connect.php'; // Database connection file
include_once 'delete_auction.php';


$sql = "SELECT p.*, 
               (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.id ORDER BY pi.id LIMIT 1) AS coverImageMain,
               COALESCE(MAX(b.bid_amount), p.starting_bid) AS highest_bid 
        FROM products p
        LEFT JOIN bid b ON p.id = b.product_id
        GROUP BY p.id";

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
</head>

<body>
    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="card-link">
            <div class="card">
                <div class="relative">
                    <img src="<?php echo $row['coverImageMain']; ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
                <div class="content">
                    <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p>Current bid: <span>$<?php echo number_format($row['highest_bid'], 2); ?></span></p>
                    <p><?php echo htmlspecialchars(substr($row['description'], 0, 50)) . '...'; ?></p>
                    <div class="actions">
                        <button>Bid Now</button>
                    </div>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>
    <script>
        function autoDeleteExpiredAuctions() {
            fetch('delete_expired_auctions.php')
                .then(response => response.text())
                .then(data => console.log("Expired auctions deleted"))
                .catch(error => console.error('Error:', error));
        }

    // Run every second
    setInterval(autoDeleteExpiredAuctions, 100);
    </script>
</body>

</html>