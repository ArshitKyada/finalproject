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
            transition: all 0.3s ease-in-out;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        textarea {
            resize: none;
        }

        .full-width {
            grid-column: span 2;
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
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .required::after {
            content: " *";
            color: red;
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add a Product to Auction</h1>
        <form action="#" method="POST">
            <div>
                <label for="product-name" class="required">Product Name</label>
                <input type="text" id="product-name" name="product-name" required>
            </div>
            <div>
                <label for="category" class="required">Category</label>
                <select id="category" name="category" required onchange="updateFormFields()">
                    <option value="">Select a category</option>
                    <option value="art">Art</option>
                    <option value="antiques">Antiques</option>
                    <option value="electronics">Electronics</option>
                    <option value="collectibles">Collectibles</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <!-- Dynamic Fields for Electronics -->
            <div id="electronics-fields" class="hidden">
                <div>
                    <label for="height">Height (cm)</label>
                    <input type="number" id="height" name="height">
                </div>
                <div>
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight">
                </div>
                <div>
                    <label for="used-condition">Used Condition</label>
                    <select id="used-condition" name="used-condition">
                        <option value="new">New</option>
                        <option value="used-good">Used - Good</option>
                        <option value="used-fair">Used - Fair</option>
                        <option value="damaged">Damaged</option>
                    </select>
                </div>
            </div>

            <!-- Dynamic Fields for Antiques -->
            <div id="antiques-fields" class="hidden">
                <div>
                    <label for="year-made">Year Made</label>
                    <input type="number" id="year-made" name="year-made">
                </div>
                <div>
                    <label for="origin">Origin</label>
                    <input type="text" id="origin" name="origin">
                </div>
            </div>

            <div>
                <label for="start-time" class="required">Start Time</label>
                <input type="date" id="start-time" name="start-time" required>
            </div>
            <div>
                <label for="end-time" class="required">End Time</label>
                <input type="date" id="end-time" name="end-time" required>
            </div>
            <div>
                <label for="starting-bid" class="required">Starting Bid (USD)</label>
                <input type="number" id="starting-bid" name="starting-bid" step="0.01" required>
            </div>
            <div>
                <label for="image-url" class="required">Image URL</label>
                <input type="url" id="image-url" name="image-url" required>
            </div>
            <div class="full-width">
                <label for="product-description" class="required">Product Description</label>
                <textarea id="product-description" name="product-description" rows="5" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function updateFormFields() {
            const category = document.getElementById("category").value;

            // Get elements for dynamic fields
            const electronicsFields = document.getElementById("electronics-fields");
            const antiquesFields = document.getElementById("antiques-fields");

            // Hide all dynamic fields initially
            electronicsFields.classList.add("hidden");
            antiquesFields.classList.add("hidden");

            // Show fields based on selected category
            if (category === "electronics") {
                electronicsFields.classList.remove("hidden");
            } else if (category === "antiques") {
                antiquesFields.classList.remove("hidden");
            }
        }
    </script>
</body>

</html>
