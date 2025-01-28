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
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #555;
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

        input[type="date"] {
            font-family: inherit;
        }

        textarea {
            resize: none;
        }

        .full-width {
            grid-column: 1 / span 2;
        }

        button {
            grid-column: 1 / span 2;
            padding: 10px 0;
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

        .required::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add a product to Auction</h1>
        <form action="#" method="POST">
            <div>
                <label for="product-name" class="required">Product Name</label>
                <input type="text" id="product-name" name="product-name" required>
            </div>
            <div>
                <label for="category" class="required">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <option value="art">Art</option>
                    <option value="antiques">Antiques</option>
                    <option value="electronics">Electronics</option>
                    <option value="collectibles">Collectibles</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div>
                <label for="start-time" class="required">Desired start time (MM/DD/YY)</label>
                <input type="date" id="start-time" name="start-time" required>
            </div>
            <div>
                <label for="end-time" class="required">Desired end time (MM/DD/YY)</label>
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
</body>

</html>
