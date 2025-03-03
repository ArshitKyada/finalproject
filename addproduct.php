<?php

require_once 'connect.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $startingBid = $_POST['startingBid'];
    $productDescription = $_POST['productDescription'];

    // Process image upload
    $imageUrl = 'uploads/' . basename($_FILES['imageUrl']['name']);
    move_uploaded_file($_FILES['imageUrl']['tmp_name'], $imageUrl);

    // Insert data into the database
    $sql = "INSERT INTO products (product_name, category, start_time, end_time, starting_bid, description, image_url)
            VALUES ('$productName', '$category', '$startTime', '$endTime', '$startingBid', '$productDescription', '$imageUrl')";

    if ($conn->query($sql) === TRUE) {
       
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a product to Auction</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    /* Box sizing to include padding and borders in total width/height */
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    body {
        background-color: rgb(228, 226, 226);
        margin: 0;
        font-family: Arial, sans-serif;
    }

    header {
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    .content {
        padding-top: 7px;
        width: 100%;
        background-color: #f3f3f3;
    }

    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .label {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .input,
    .select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    /* Banner Image Style */
    .banner {
        width: 100%;
        height: 250px;
        background: url('images/banner.png') no-repeat center;
        background-size: cover;
        margin-top: 65px;
        /* Adjust this if the header height changes */
    }

    /* Responsive grid layout */
    .grid {
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr;
    }

    /* For larger screens, use two columns */
    @media (min-width: 768px) {
        .grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .button {
        width: 100%;
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

    .input-with-icon {
        position: relative;
    }

    .icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .content {
            margin-top: 60px;
            padding: 20px;
        }

        .container {
            box-shadow: none;
        }

        .title {
            font-size: 2rem;
            text-align: center;
        }

        .label {
            font-size: 0.9rem;
        }

        .input,
        .select {
            font-size: 0.9rem;
            padding: 8px;
        }

        .button {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar (Header) -->
    <header>
        <?php include 'header.php' ?>
    </header>

    <!-- Banner Image -->
    <div class="banner"></div>

    <div class="content">
        <div class="container">
            <h1 class="title">Add a product to Auction</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="grid">
                    <div>
                        <label for="productName" class="label">Product Name <span style="color: red;">*</span></label>
                        <input type="text" id="productName" name="productName" class="input" required>
                    </div>
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
                    <div>
                        <label for="startTime" class="label">Start time (MM/DD/YY) <span
                                style="color: red;">*</span></label>
                        <input type="date" id="startTime" name="startTime" class="input" required>
                    </div>
                    <div>
                        <label for="endTime" class="label">End time (MM/DD/YY) <span
                                style="color: red;">*</span></label>
                        <input type="date" id="endTime" name="endTime" class="input" required>
                    </div>
                </div><br>
                <div>
                    <label for="startingBid" class="label">Starting Bid (USD) <span style="color: red;">*</span></label>
                    <input type="text" id="startingBid" name="startingBid" class="input" required>
                </div><br>
                <div>
                    <label for="productDescription" class="label">Product Description <span
                            style="color: red;">*</span></label>
                    <input type="text" id="productDescription" name="productDescription" class="input" required>
                </div>
                <br>
                <div>
                    <label for="imageUrl" class="label">Image <span style="color: red;">*</span></label>
                    <input type="file" id="imageUrl" name="imageUrl" class="input" required>
                </div>
                <br>
                <div>
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>