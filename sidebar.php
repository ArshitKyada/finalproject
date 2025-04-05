<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    .sidebar {
        overflow: hidden;
        background-color: rgb(226, 234, 249);
        padding: 16px;
        width: 250px;
        height: 600px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .sidebar nav a {
        display: flex;
        align-items: center;
        color: #2d3748;
        font-size: 16px;
        font-weight: 500;
        padding: 12px 16px;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .sidebar nav a i {
        margin-right: 10px;
    }

    .sidebar nav a:hover {
        background-color: #3182ce;
        color: white;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            max-height: 60px;
            padding: 12px;
            display: flex;
            justify-content: center;
            box-shadow: none;
            position: fixed;
            bottom: 0;
            background-color: white;
            border-top: 1px solid #e2e8f0;
        }

        .sidebar nav {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .sidebar nav a {
            font-size: 16px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }
    </style>
</head>

<body>

    <aside class="sidebar">
        <nav>
            <a href="sellerindex.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="sellerauctions.php"><i class="fas fa-gavel"></i> My Auctions</a>
            <a href="addproduct.php"><i class="fas fa-plus-circle"></i> Add Auction</a>
            <a href="bidding_details.php"><i class="fas fa-truck"></i> Shipping Details</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

</body>

</html>
