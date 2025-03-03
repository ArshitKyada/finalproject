<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a product to Auction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Box sizing to include padding and borders in total width/height */
        *, *:before, *:after {
            box-sizing: border-box;
        }

        body {
            background-color: #f3f4f6;
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
            padding-top: 70px; 
            width: 100%;
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

        .input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
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
            .content{
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

            .input {
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

    <!-- Content Section Below Navbar -->
    <div class="content">
        <div class="container">
            <h1 class="title">Add a product to Auction</h1>
            <form>
                <div class="grid">
                    <div>
                        <label for="productName" class="label">Product Name <span style="color: red;">*</span></label>
                        <input type="text" id="productName" class="input" required>
                    </div>
                    <div>
                        <label for="category" class="label">Category <span style="color: red;">*</span></label>
                        <input type="text" id="category" class="input" placeholder="Select a category" required>
                    </div>
                    <div>
                        <label for="startTime" class="label">Start time (MM/DD/YY) <span style="color: red;">*</span></label>
                        <div class="input-with-icon">
                            <input type="date" id="startTime" class="input" placeholder="dd-mm-yyyy" required>
                        </div>
                    </div>
                    <div>
                        <label for="endTime" class="label">End time (MM/DD/YY) <span style="color: red;">*</span></label>
                        <div class="input-with-icon">
                            <input type="date" id="endTime" class="input" placeholder="dd-mm-yyyy" required>
                        </div>
                    </div>
                </div><br>
                <div>
                    <label for="startingBid" class="label">Starting Bid (USD) <span style="color: red;">*</span></label>
                    <input type="text" id="startingBid" class="input" required>
                </div><br>
                <div>
                    <label for="productDescription" class="label">Product Description <span style="color: red;">*</span></label>
                    <input type="text" id="productDescription" class="input" required>
                </div>
                <br>
                <div>
                    <label for="imageUrl" class="label">Image URL <span style="color: red;">*</span></label>
                    <input type="text" id="imageUrl" class="input" required>
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
