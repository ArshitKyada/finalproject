<?php include_once 'header.php' ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row items-center">
            <div class="md:w-1/2">
                <img src="images/home.png" alt="A person in a pink hoodie making an OK sign with both hands" class="rounded-lg" width="400" height="400">
            </div>
            <div class="md:w-1/2 md:pl-6 mt-6 md:mt-0">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-line text-2xl text-green-500"></i>
                    <div class="ml-2">
                        <p class="text-gray-500">Total Raised</p>
                        <p class="text-2xl font-bold">$45,390.00</p>
                    </div>
                </div>
                <h2 class="text-3xl font-bold mb-4">We Work for Your Incredible Success</h2>
                <p class="text-gray-700 mb-4">Auction sites present consumers with a thrilling, competitive way to buy the goods and services they need most.</p>
                <p class="text-gray-700 mb-4">But getting your own auction site up and running has always required learning complex coding languages, or hiring an expensive design firm for thousands of dollars and months of work.</p>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li>Have enough food for life.</li>
                    <li>Poor children can return to school.</li>
                    <li>Fuga magni veritatis ad temporibus atque adipisci nisi rerum...</li>
                </ul>
                <button class="bg-green-500 text-white px-6 py-2 rounded-lg">More About</button>
            </div>
        </div>
        <!-- Why Choose Us Section -->
        <div class="text-center mt-12">
            <h2 class="text-3xl font-bold mb-4">Why Choose Us</h2>
            <p class="text-gray-700 mb-8">Explore on the world's best & largest Bidding marketplace with our beautiful Bidding products. We want to be a part of your smile, success and future growth.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">01</div>
                        <i class="fas fa-gem text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">High Quality Products</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">02</div>
                        <i class="fas fa-crown text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Creator's Royalty</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">03</div>
                        <i class="fas fa-tags text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Top Class Product Price</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">04</div>
                        <i class="fas fa-dollar-sign text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Support Multiple Currency</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">05</div>
                        <i class="fas fa-history text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Show All Bidders History</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl font-bold text-gray-300">06</div>
                        <i class="fas fa-smile text-2xl text-green-500 ml-4"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">100% Happy Customer</h3>
                    <p class="text-gray-700">Voluptates est blanditiis accusantium officiis expedita dolorem inventore.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>