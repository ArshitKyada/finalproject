<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once 'connect.php'; // Database connection
include_once 'header.php'; // Header

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!"); // Prevent access if user is not logged in
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $startingBid = $_POST['startingBid'];
    $productDescription = $_POST['productDescription'];
    $productCondition = $_POST['productCondition'];
    
    // Image upload handling
    $imageUrl = 'uploads/' . $_FILES['imageUrl']['name'];
    move_uploaded_file($_FILES['imageUrl']['tmp_name'], $imageUrl);

    // Get seller ID from session
    $seller_id = $_SESSION['user_id'];

    // Insert data into the database
    $sql = "INSERT INTO products (product_name, category, start_time, end_time, starting_bid, description, product_condition, image_url, seller_id) 
            VALUES ('$productName', '$category', '$startTime', '$endTime', '$startingBid', '$productDescription', '$productCondition', '$imageUrl', '$seller_id')";

    if (mysqli_query($conn, $sql)) {
    }

    mysqli_close($conn);
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
    html,
    body {
        width: 100%;
        overflow-y: hidden;
    }

    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        background-color: #f7fafc;
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

    .seller-header-right {
        display: flex;
        align-items: center;
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


    .form-container {
        background-color: #ffffff;
        padding: 20px;
        padding-right: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-container h1 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .label {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .input {
        width: 600px;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    .select {
        width: 621px;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    .button {
        width: 621px;
        background-color: #2563eb;
        color: white;
        padding: 12px;
        border-radius: 6px;
        border: none;
        font-size: 1rem;
        cursor: pointer;
    }

    .button:hover {
        background-color: #1d4ed8;
    }


    @media (max-width: 768px) {
        .main-content {
            flex-direction: column;
        }

        /* Ensure form container fills the available width on mobile */
        .form-container {
            width: 90%;
            /* Allow the form to take more space on smaller screens */
            padding: 20px;
            margin-bottom: 65px;
        }

        .form-container h1 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .input {
            width: 400px;
            padding: 8px;
            font-size: 0.9rem;
        }

        .select {
            width: 417px;
            padding: 8px;
            font-size: 0.9rem;
        }

        .button {
            font-size: 0.9rem;
            width: 417px;
            /* Ensure the button takes the 100% width for all screen */
        }

        /* Stack the fields in a single column for mobile */
        .form-group {
            flex-direction: column;
        }

        .form-group>div {
            width: 100%;
        }
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
                <div class="form-container">
                    <h1>Add a product to Auction</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div>
                                <label for="productName" class="label">Product Name <span
                                        style="color: red;">*</span></label>
                                <input type="text" id="productName" name="productName" class="input" required>
                            </div><br>
                            <div>
                                <label for="category" class="label">Category <span style="color: red;">*</span></label>
                                <select id="category" name="category" class="select" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="fashion">Fashion</option>
                                    <option value="home">Home & Garden</option>
                                    <option value="automotive">Automotive</option>
                                    <option value="sports">Sports</option>
                                    <option value="toys">Toys & Games</option>
                                </select>
                            </div>
                        </div><br>
                        <div>
                            <label for="startTime" class="label">Start time (MM/DD/YY) <span
                                    style="color: red;">*</span></label>
                            <input type="date" id="startTime" name="startTime" class="input" required>
                        </div><br>
                        <div>
                            <label for="endTime" class="label">End time (MM/DD/YY) <span
                                    style="color: red;">*</span></label>
                            <input type="date" id="endTime" name="endTime" class="input" required>
                        </div><br>
                        <div>
                            <label for="startingBid" class="label">Starting Bid (USD) <span
                                    style="color: red;">*</span></label>
                            <input type="text" id="startingBid" name="startingBid" class="input" required>
                        </div><br>
                        <div>
                            <label for="productDescription" class="label">Product Description <span
                                    style="color: red;">*</span></label>
                            <input type="text" id="productDescription" name="productDescription" class="input" required>
                        </div><br>
                        <label class="label">Condition *</label>
                        <select name="productCondition" class="select" required>
                            <option value="" disabled selected>Select condition</option>
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                            <option value="Refurbished">Refurbished</option>
                        </select><br><br>
                        <div>
                            <label for="imageUrl" class="label">Image <span style="color: red;">*</span></label>
                            <input type="file" id="imageUrl" name="imageUrl" class="input" required>
                        </div><br>
                        <div>
                            <button type="submit" class="button">Submit</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>