<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'connect.php';
include_once 'header.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in!");
}

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

    if (strtotime($startTime) >= strtotime($endTime)) {
        die("Error: Start time must be before end time.");
    }

    $sql = "UPDATE products SET product_name='$productName', category='$category', start_time='$startTime', end_time='$endTime', starting_bid='$startingBid', description='$productDescription', product_condition='$productCondition' WHERE id='$product_id'";

    if (mysqli_query($conn, $sql)) {
        if (!empty($_FILES['coverImageMain']['name'])) {
            if ($_FILES['coverImageMain']['error'] == UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['coverImageMain']['name']);
                $imagePath = 'uploads/' . $fileName;
                move_uploaded_file($_FILES['coverImageMain']['tmp_name'], $imagePath);
        
                $sqlImageMain = "UPDATE product_images SET image_url='$imagePath' WHERE product_id='$product_id' LIMIT 1";
                mysqli_query($conn, $sqlImageMain);
            }
        }

        if (!empty($_FILES['coverImage']['name'][0])) {
            foreach ($_FILES['coverImage']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['coverImage']['error'][$key] == UPLOAD_ERR_OK) {
                    $fileName = basename($_FILES['coverImage']['name'][$key]);
                    $imagePath = 'uploads/' . $fileName;
                    move_uploaded_file($tmpName, $imagePath);

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/addproductstyle.css">
    <style>
    .button {
        background-color: #2563eb;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #1d4ed8;
    }

    .button:active {
        background-color: #1e40af;
    }

    .product-description {
        width: 600px;
        height: 150px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        color: #333;
        resize: vertical;
        margin-top: 5px;
    }

    .input {
        width: 600px;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
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
        <header class="seller-header">
            <h1>Edit Product</h1>
            <div class=" header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <div class="main-content">
            <?php include_once 'sidebar.php'; ?>
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
                                <option value="Accessories">Accessories</option>
                                <option value="Cars">Cars</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Music">Music</option>
                                <option value="Mobile">Mobile</option>
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
                            <div class="upload-area" id="uploadAreaMain"
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
                            $sqlImages = "SELECT * FROM product_images WHERE product_id='$product_id'";
                            $resultImages = $conn->query($sqlImages);
                            $imageCount = 0;
                            while ($imageRow = $resultImages->fetch_assoc() && $imageCount < 4) {
                                echo '<div>
                                        <div class="upload-area" onclick="document.getElementById(\'coverImage' . $imageCount . '\').click()">
                                            <span class="upload-icon" id="icon ' . $imageCount . '">+</span>
                                            <input type="file" id="coverImage' . $imageCount . '" name="coverImage[]" accept="image/*" class="hidden" onchange="updateIcon(\'icon' . $imageCount . '\')">
                                        </div>
                                      </div><br>';
                                $imageCount++;
                            }
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
        iconElement.innerHTML = '<i class="fas fa-check"></i>';
        iconElement.classList.add('uploaded');
    }
    </script>
</body>

</html>

<?php
$conn->close();
?>