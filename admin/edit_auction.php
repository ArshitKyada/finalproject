<?php
include_once '../connect.php'; // Include your database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the auction details
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

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
    $updateSql = "UPDATE products SET product_name = '$productName', starting_bid = $startingBid, end_time = '$endTime' WHERE id = $id";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: manageauction.php"); // Redirect to manage auctions page
        exit();
    } else {
        echo "Error updating auction: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
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
    </div>
</body>
</html>