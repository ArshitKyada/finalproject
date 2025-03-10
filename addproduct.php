<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'connect.php'; // Database connection
include_once 'header.php'; // Header

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $startTime = mysqli_real_escape_string($conn, $_POST['startTime']);
    $endTime = mysqli_real_escape_string($conn, $_POST['endTime']);
    $startingBid = mysqli_real_escape_string($conn, $_POST['startingBid']);
    $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
    $productCondition = mysqli_real_escape_string($conn, $_POST['productCondition']);
    $seller_id = $_SESSION['user_id'];

    // Validate start and end time
    if (strtotime($startTime) >= strtotime($endTime)) {
        die("Error: Start time must be before end time.");
    }

    // Insert product into database
    $sql = "INSERT INTO products (product_name, category, start_time, end_time, starting_bid, description, product_condition, seller_id) 
            VALUES ('$productName', '$category', '$startTime', '$endTime', '$startingBid', '$productDescription', '$productCondition', '$seller_id')";

    if (mysqli_query($conn, $sql)) {
        $productId = mysqli_insert_id($conn); // Get last inserted product ID

        if (!empty($_FILES['coverImageMain']['name'])) { // Check if the main image is uploaded
            if ($_FILES['coverImageMain']['error'] == UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['coverImageMain']['name']);
                $imagePath = 'uploads/' . $fileName;
                move_uploaded_file($_FILES['coverImageMain']['tmp_name'], $imagePath);
        
                // Insert main image path into database if needed
                $sqlImageMain = "INSERT INTO product_images (product_id, image_url) VALUES ('$productId', '$imagePath')";
                mysqli_query($conn, $sqlImageMain);
            }
        }

        // Handle multiple image uploads
        if (!empty($_FILES['coverImage']['name'][0])) { // Check if files are uploaded
            foreach ($_FILES['coverImage']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['coverImage']['error'][$key] == UPLOAD_ERR_OK) {
                    $fileName = basename($_FILES['coverImage']['name'][$key]);
                    $imagePath = 'uploads/' . $fileName;
                    move_uploaded_file($tmpName, $imagePath);

                    // Insert image path into database
                    $sqlImage = "INSERT INTO product_images (product_id, image_url) VALUES ('$productId', '$imagePath')";
                    mysqli_query($conn, $sqlImage);
                }
            }
        }
    } else {
        echo "Error: " . mysqli_error($conn);
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
    <link rel="stylesheet" href="css/addproductstyle.css">
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
                        </div><br>
                        <div>
                            <label for="startTime" class="label">Start time (MM/DD/YY) <span
                                    style="color: red;">*</span></label>
                            <input type="datetime-local" id="startTime" name="startTime" class="input" required>
                        </div><br>
                        <div>
                            <label for="endTime" class="label">End time (MM/DD/YY) <span
                                    style="color: red;">*</span></label>
                            <input type="datetime-local" id="endTime" name="endTime" class="input" required>
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

                        <label class="label">Upload Images <span style="color: red;">*</span></label><br><br>
                        <div>
                            <label for="coverImageMain" class="label">Main Image <span style="color: red;">*</span></label><br>
                            <div class="upload-area" id="uploadAreaMain" onclick="document.getElementById('coverImageMain').click()">
                                <span class="upload-icon" id="iconMain">+</span>
                                <input type="file" id="coverImageMain" name="coverImageMain" accept="image/*"
                                    class="hidden" required onchange="updateIcon('iconMain')">
                            </div>
                        </div><br>

                        <div class="upload-container">
                            <div>
                                <div class="upload-area" onclick="document.getElementById('coverImage1').click()">
                                    <span class="upload-icon" id="icon1">+</span>
                                    <input type="file" id="coverImage1" name="coverImage[]" accept="image/*"
                                        class="hidden" required onchange="updateIcon('icon1')">
                                </div>
                            </div><br>
                            <div>
                                <div class="upload-area" onclick="document.getElementById('coverImage2').click()">
                                    <span class="upload-icon" id="icon2">+</span>
                                    <input type="file" id="coverImage2" name="coverImage[]" accept="image/*"
                                        class="hidden" required onchange="updateIcon('icon2')">
                                </div>
                            </div><br>
                            <div>
                                <div class="upload-area" onclick="document.getElementById('coverImage3').click()">
                                    <span class="upload-icon" id="icon3">+</span>
                                    <input type="file" id="coverImage3" name="coverImage[]" accept="image/*"
                                        class="hidden" required onchange="updateIcon('icon3')">
                                </div>
                            </div><br>
                            <div>
                                <div class="upload-area" onclick="document.getElementById('coverImage4').click()">
                                    <span class="upload-icon" id="icon4">+</span>
                                    <input type="file" id="coverImage4" name="coverImage[]" accept="image/*"
                                        class="hidden" required onchange="updateIcon('icon4')">
                                </div>
                            </div><br>
                        </div><br>

                        <div>
                            <button type="submit" class="button">Submit</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
    function updateIcon(iconId) {
        const iconElement = document.getElementById(iconId);
        iconElement.innerHTML = '<i class="fas fa-check"></i>'; // Change to checkmark icon
        iconElement.classList.add('uploaded'); // Optional: Add a class for styling
    }
    </script>
</body>

</html>