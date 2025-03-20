<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'connect.php'; // Database connection
include_once 'header.php'; // Header

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!");
}

// Fetch the product details to pre-fill the form
$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id='$product_id'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

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

    // Update product in the database
    $sql = "UPDATE products SET product_name='$productName', category='$category', start_time='$startTime', end_time='$endTime', starting_bid='$startingBid', description='$productDescription', product_condition='$productCondition' WHERE id='$product_id'";

    if (mysqli_query($conn, $sql)) {
        // Handle image uploads
        if (!empty($_FILES['coverImageMain']['name'])) { // Check if the main image is uploaded
            if ($_FILES['coverImageMain']['error'] == UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['coverImageMain']['name']);
                $imagePath = 'uploads/' . $fileName;
                move_uploaded_file($_FILES['coverImageMain']['tmp_name'], $imagePath);
        
                // Update main image path in database
                $sqlImageMain = "UPDATE product_images SET image_url='$imagePath' WHERE product_id='$product_id' LIMIT 1";
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
                    $sqlImage = "INSERT INTO product_images (product_id, image_url) VALUES ('$product_id', '$imagePath')";
                    mysqli_query($conn, $sqlImage);
                }
            }
        }

        header('location:sellerauctions.php');
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
    <title>Edit Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/addproductstyle.css">
    <style>
    .button {
        background-color: #2563eb;
        /* Blue background */
        color: white;
        /* White text */
        padding: 10px 20px;
        /* Padding */
        border: none;
        /* No border */
        border-radius: 5px;
        /* Rounded corners */
        cursor: pointer;
        /* Pointer cursor on hover */
        font-size: 16px;
        /* Font size */
        transition: background-color 0.3s;
        /* Smooth transition */
    }

    .button:hover {
        background-color: #1d4ed8;
        /* Darker blue on hover */
    }

    .button:active {
        background-color: #1e40af;
        /* Even darker blue on click */
    }

    .product-description {
        width: 600px;
        /* Full width */
        height: 150px;
        /* Set height */
        padding: 10px;
        /* Padding for inner spacing */
        border: 1px solid #ccc;
        /* Light gray border */
        border-radius: 5px;
        /* Rounded corners */
        font-family: 'Roboto', sans-serif;
        /* Font style */
        font-size: 14px;
        /* Font size */
        color: #333;
        /* Dark gray text color */
        resize: vertical;
        /* Allow vertical resizing */
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .product-description {
            width: 400px;
            height: 120px;
            font-size: 16px;
        }
    }
    </style>
</head>

<body>
    <div class="seller-container">
        <!-- Header -->
        <header class="seller-header">
            <h1>Edit Product</h1>
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
                    <h1>Edit Product Details</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <div>
                            <label for="productName" class="label">Product Name <span
                                    style="color: red;">*</span></label>
                            <input type="text" id="productName" name="productName" class="input"
                                value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div><br>
                        <div>
                            <label for="category" class="label">Category <span style="color: red;">*</span></label>
                            <select id="category" name="category" class="select" required>
                                <option value="<?php echo htmlspecialchars($product['category']); ?>" selected>
                                    <?php echo htmlspecialchars($product['category']); ?></option>
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
                            <input type="datetime-local" id="startTime" name="startTime" class="input"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($product['start_time'])); ?>" required>
                        </div><br>
                        <div>
                            <label for="endTime" class="label">End time (MM/DD/YY) <span
                                    style="color: red;">*</span></label>
                            <input type="datetime-local" id="endTime" name="endTime" class="input"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($product['end_time'])); ?>" required>
                        </div><br>
                        <div>
                            <label for="startingBid" class="label">Starting Bid (USD) <span
                                    style="color: red;">*</span></label>
                            <input type="text" id="startingBid" name="startingBid" class="input"
                                value="<?php echo htmlspecialchars($product['starting_bid']); ?>" required>
                        </div><br>
                        <div>
                            <label for="productDescription" class="label">Product Description <span
                                    style="color: red;">*</span></label>
                            <textarea id="productDescription" name="productDescription" class="product-description"
                                required><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div><br>
                        <label class="label">Condition *</label>
                        <select name="productCondition" class="select" required>
                            <option value="<?php echo htmlspecialchars($product['product_condition']); ?>" selected>
                                <?php echo htmlspecialchars($product['product_condition']); ?></option>
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                            <option value="Refurbished">Refurbished</option>
                        </select><br><br>

                        <div>
                            <label for="coverImageMain" class="label">Main Image <span
                                    style="color: red;">*</span></label><br><br>
                            <div class="upload-area" id=" uploadAreaMain"
                                onclick="document.getElementById('coverImageMain').click()">
                                <span class="upload-icon" id="iconMain">+</span>
                                <input type="file" id="coverImageMain" name="coverImageMain" accept="image/*"
                                    class="hidden" onchange="updateIcon('iconMain')">
                            </div>
                        </div>
                        <hr>
                        <label class="label">Add More Images (Max 4)</label><br>
                        <div class="upload-container">
                            <?php
                            // Fetch existing images for the product
                            $sqlImages = "SELECT * FROM product_images WHERE product_id='$product_id'";
                            $resultImages = $conn->query($sqlImages);
                            $imageCount = 0;
                            while ($imageRow = $resultImages->fetch_assoc() && $imageCount < 4) {
                                echo '<div>
                                        <div class="upload-area" onclick="document.getElementById(\'coverImage' . $imageCount . '\').click()">
                                            <span class="upload-icon" id="icon' . $imageCount . '">+</span>
                                            <input type="file" id="coverImage' . $imageCount . '" name="coverImage[]" accept="image/*" class="hidden" onchange="updateIcon(\'icon' . $imageCount . '\')">
                                        </div>
                                      </div><br>';
                                $imageCount++;
                            }
                            // Add additional upload fields if less than 4 images are present
                            for ($i = $imageCount; $i < 4; $i++) {
                                echo '<div>
                                        <div class="upload-area" onclick="document.getElementById(\'coverImage' . $i . '\').click()">
                                            <span class="upload-icon" id="icon' . $i . '">+</span>
                                            <input type="file" id="coverImage' . $i . '" name="coverImage[]" accept="image/*" class="hidden" onchange="updateIcon(\'icon' . $i . '\')">
                                        </div>
                                      </div><br>';
                            }
                            ?>
                        </div><br>

                        <div>
                            <button type="submit" class="button">Update Product</button>
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

<?php
// Close the connection
$conn->close();
?>