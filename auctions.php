<?php 
include_once 'header.php';
include_once 'connect.php'; // Database connection file

$sql = "SELECT * FROM products";
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
    <style>
    body {
        background-color: #f3f4f6;
        overflow-y: scroll;
    }

    .grid {
        padding: 24px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 768px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card .relative {
        overflow: hidden;
        border-radius: 0 20px 0 20px;
    }

    .card img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
        border-radius: 0 20px 0 20px;
    }

    .card img:hover {
        transform: scale(1.2);
    }

    .card .content {
        padding-top: 16px;
    }

    .card .content h3 {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 8px;
    }

    .card .content p {
        margin: 0;
        color: #6b7280;
    }

    .card .content p span {
        font-weight: bold;
    }

    .card .actions {
        margin-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card .actions button {
        background-color: #10b981;
        color: #ffffff;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .card .actions i {
        color: #6b7280;
    }
    </style>
</head>

<body>
    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="card-link">
            <div class="card">
                <div class="relative">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
                <div class="content">
                    <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p>Starting bid: <span>$<?php echo number_format($row['starting_bid'], 2); ?></span></p>
                    <div class="actions">
                        <button>Bid now</button>
                        <i class="fas fa-share-alt"></i>
                    </div>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>
</body>

</html>
