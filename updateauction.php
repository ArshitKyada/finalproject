<?php
include 'connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid product ID.";
    exit;
}

$product_id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Product not found.";
    exit;
}

$product = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $starting_bid = $_POST['starting_bid'];
    $description = $_POST['description'];

    $update_query = "UPDATE products SET 
        product_name='$product_name', 
        category='$category', 
        start_time='$start_time', 
        end_time='$end_time', 
        starting_bid='$starting_bid', 
        description='$description' 
        WHERE id=$product_id";

    mysqli_query($conn, $update_query);
    header("Location: sellerindex.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #ece9e6, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 135vh;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 400;
            margin-top: 10px;
            text-align: left;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
        }
        input:focus, textarea:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.2);
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 15px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s;
        }
        button:hover {
            background: #218838;
            transform: scale(1.05);
        }
        .back-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: all 0.3s;
        }
        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Product</h2>
        <form method="POST">
            <label>Product Name</label>
            <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

            <label>Category</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

            <label>Start Time</label>
            <input type="date" name="start_time" value="<?php echo htmlspecialchars($product['start_time']); ?>" required>

            <label>End Time</label>
            <input type="date" name="end_time" value="<?php echo htmlspecialchars($product['end_time']); ?>" required>

            <label>Starting Bid</label>
            <input type="number" name="starting_bid" value="<?php echo htmlspecialchars($product['starting_bid']); ?>" required>

            <label>Description</label>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

            <button type="submit">Update Product</button>
        </form>
        <a href="sellerindex.php" class="back-link">Back to Auctions</a>
    </div>
</body>
</html>
