<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the auction details
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Auction not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $startingBid = $_POST['starting_bid'];
    $endTime = $_POST['end_time'];

    // Update the auction details
    $updateSql = "UPDATE products SET product_name = ?, starting_bid = ?, end_time = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sdsi", $productName, $startingBid, $endTime, $id);

    if ($updateStmt->execute()) {
        header("Location: manageauction.php"); // Redirect to manage auctions page
        exit();
    } else {
        echo "Error updating auction.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Auction - Auction Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        main {
            flex-grow: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .button {
            background-color: #4299e1;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #3182ce;
        }
    </style>
</head>
<body>
    <main>
        <h2>Edit Auction</h2>
        <form method="POST">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="starting_bid">Starting Price:</label>
                <input type="number" id="starting_bid" name="starting_bid" value="<?php echo htmlspecialchars($row['starting_bid']); ?>" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="datetime-local" id="end_time" name="end_time" value="<?php echo htmlspecialchars($row['end_time']); ?>" required>
            </div>
            <button type="submit" class="button">Update Auction</button>
        </form>
    </main>
</body>
</html>