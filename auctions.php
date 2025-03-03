<?php
require_once 'connect.php';  // Include your database connection
include_once 'header.php';  // Include any necessary headers (like navigation)

// Execute the query using procedural style
$sql = "SELECT image_url, product_name, starting_bid FROM products";
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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card {
        background-color: #ffffff;
        border-radius: 8px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card .content {
        padding: 16px;
    }

    .card .content h2 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .card .content p {
        color: #374151;
        margin-bottom: 16px;
    }

    .card .content p span {
        font-weight: bold;
    }

    .card .content .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card .content .actions button {
        background-color: #10b981;
        color: #ffffff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .card .content .actions i {
        color: #6b7280;
    }
    </style>
</head>

<body>

<div class="container">
    <div class="grid">
        <?php
        // Check if there are products in the database
        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through each product and display it
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<img src="' . $row["image_url"] . '" alt="' . $row["product_name"] . '">';
                echo '<div class="content">';
                echo '<h2>' . $row["product_name"] . '</h2>';
                echo '<p>Starting bid: <span>$' . number_format($row["starting_bid"], 2) . '</span></p>';
                echo '<div class="actions">';
                echo '<button>Bid now</button>';
                echo '<i class="fas fa-share-alt"></i>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        // Close the connection
        mysqli_close($conn);
        ?>
    </div>
</div>

</body>

</html>
