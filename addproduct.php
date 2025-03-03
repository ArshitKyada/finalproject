<?php

require_once 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST["product-name"];
    $category = $_POST["category"];
    $start_time = $_POST["start-time"];
    $end_time = $_POST["end-time"];
    $starting_bid = $_POST["starting-bid"];
    $description = $_POST["product-description"];

    // Optional fields (set to NULL if not provided)
    $used_condition = isset($_POST["used-condition"]) ? $_POST["used-condition"] : NULL;
    $year_made = isset($_POST["year-made"]) ? $_POST["year-made"] : NULL;
    $vehicle_model = isset($_POST["vehicle-model"]) ? $_POST["vehicle-model"] : NULL;
    $vehicle_year = isset($_POST["vehicle-year"]) ? $_POST["vehicle-year"] : NULL;
    $mileage = isset($_POST["mileage"]) ? $_POST["mileage"] : NULL;
    $material = isset($_POST["material"]) ? $_POST["material"] : NULL;
    $gemstone = isset($_POST["gemstone"]) ? $_POST["gemstone"] : NULL;
    $furniture_type = isset($_POST["furniture-type"]) ? $_POST["furniture-type"] : NULL;
    $furniture_material = isset($_POST["furniture-material"]) ? $_POST["furniture-material"] : NULL;

    // Insert data into the database
    $sql = "INSERT INTO auction_products (product_name, category, start_time, end_time, starting_bid, description, 
            used_condition, year_made, vehicle_model, vehicle_year, mileage, material, gemstone, 
            furniture_type, furniture_material) 
            VALUES ('$product_name', '$category', '$start_time', '$end_time', '$starting_bid', '$description', 
            '$used_condition', '$year_made', '$vehicle_model', '$vehicle_year', '$mileage', '$material', 
            '$gemstone', '$furniture_type', '$furniture_material')";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product to Auction</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 600px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    h1 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: grid;
        gap: 15px;
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
        display: block;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .hidden {
        display: none;
    }

    button {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container">
        <h1>Add a Product to Auction</h1>
        <form id="auction-form" method="POST">
            <label for="product-name" class="required">Product Name</label>
            <input type="text" id="product-name" name="product-name" required>

            <label for="category" class="required">Category</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="art">Art</option>
                <option value="antiques">Antiques</option>
                <option value="electronics">Electronics</option>
                <option value="collectibles">Collectibles</option>
                <option value="furniture">Furniture</option>
                <option value="jewelry">Jewelry</option>
                <option value="vehicles">Vehicles</option>
                <option value="books">Books</option>
                <option value="clothing">Clothing</option>
                <option value="others">Others</option>
            </select>

            <div id="electronics-fields" class="hidden">
                <label for="used-condition">Used Condition</label>
                <select id="used-condition" name="used-condition">
                    <option value="new">New</option>
                    <option value="used-good">Used - Good</option>
                    <option value="used-fair">Used - Fair</option>
                    <option value="damaged">Damaged</option>
                </select>
            </div>

            <div id="antiques-fields" class="hidden">
                <label for="year-made">Year Made</label>
                <input type="number" id="year-made" name="year-made">
            </div>

            <div id="vehicles-fields" class="hidden">
                <label for="vehicle-model">Model</label>
                <input type="text" id="vehicle-model" name="vehicle-model">
                <label for="vehicle-year">Year</label>
                <input type="number" id="vehicle-year" name="vehicle-year">
                <label for="mileage">Mileage</label>
                <input type="number" id="mileage" name="mileage">
            </div>

            <div id="jewelry-fields" class="hidden">
                <label for="material">Material</label>
                <input type="text" id="material" name="material">
                <label for="gemstone">Gemstone</label>
                <input type="text" id="gemstone" name="gemstone">
            </div>

            <div id="furniture-fields" class="hidden">
                <label for="furniture-type">Type</label>
                <input type="text" id="furniture-type" name="furniture-type">
                <label for="furniture-material">Material</label>
                <input type="text" id="furniture-material" name="furniture-material">
            </div>

            <label for="start-time" class="required">Start Time</label>
            <input type="date" id="start-time" name="start-time" required>

            <label for="end-time" class="required">End Time</label>
            <input type="date" id="end-time" name="end-time" required>

            <label for="starting-bid" class="required">Starting Bid (USD)</label>
            <input type="number" id="starting-bid" name="starting-bid" step="0.01" required>

            <label for="product-description" class="required">Product Description</label>
            <textarea id="product-description" name="product-description" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
    document.getElementById('category').addEventListener('change', function() {
        document.querySelectorAll('.hidden').forEach(el => el.classList.add('hidden'));
        const category = this.value;
        if (document.getElementById(category + '-fields')) {
            document.getElementById(category + '-fields').classList.remove('hidden');
        }
    });
    </script>
</body>

</html>