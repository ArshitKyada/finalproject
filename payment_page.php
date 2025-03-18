<?php
// Start the session
session_start();

include_once 'connect.php';
include_once 'header.php';

// Check if product_id is set in GET request
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure it's an integer
} else {
    die("Error: Product ID is missing."); // Stop execution if no product ID
}

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Error: Product not found.");
}

// Fetch the highest bid
$highest_bid_sql = "SELECT MAX(bid_amount) AS highest_bid FROM bid WHERE product_id = $product_id";
$highest_bid_result = $conn->query($highest_bid_sql);
$highest_bid = $highest_bid_result->fetch_assoc()['highest_bid'] ?? 0;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];
    $cvv = $_POST['cvv'];

    // Basic SQL query to insert data
    $sql = "INSERT INTO payments (full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv) 
            VALUES ('$full_name', '$email', '$address', '$city', '$state', '$zip_code', '$card_name', '$card_number', '$exp_month', '$exp_year', '$cvv')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Payment successfully! Thank you for your purchase.'); window.location.href = 'thank_you.php';</script>";
    } else {
        echo "<script>alert('Error storing payment details: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway Form</title>
    <link rel="stylesheet" href="css/paymentstyle.css">
    <style>
    body::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body>
    <div class="container">

        <form action="" method="POST">
            <center>
                <h1>Payment for <?php echo htmlspecialchars($product['product_name']); ?></h1>
                <h3>Amount Due: $<?php echo number_format($highest_bid, 2); ?></h3>
            </center>
            <br>
            <hr><br>
            <div class="row">
                <div class="column">
                    <h3 class="title">Billing Address</h3>
                    <div class="input-box">
                        <span>Full Name :</span>
                        <input type="text" name="full_name" placeholder="Jacob Aiden" required>
                    </div>
                    <div class="input-box">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com" required>
                    </div>
                    <div class="input-box">
                        <span>Address :</span>
                        <input type="text" name="address" placeholder="Room - Street - Locality" required>
                    </div>
                    <div class="input-box">
                        <span>City :</span>
                        <input type="text" name="city" placeholder="Berlin" required>
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>State :</span>
                            <input type="text" name="state" placeholder="Germany" required>
                        </div>
                        <div class="input-box">
                            <span>Zip Code :</span>
                            <input type="number" name="zip_code" placeholder="123 456" required>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <h3 class="title">Payment</h3>
                    <div class="input-box">
                        <span>Cards Accepted :</span>
                        <img src="images/imgcards.png" alt="">
                    </div>
                    <div class="input-box">
                        <span>Name On Card :</span>
                        <input type="text" name="card_name" placeholder="Mr. Jacob Aiden" required>
                    </div>
                    <div class="input-box">
                        <span>Credit Card Number :</span>
                        <input type="text" name="card_number" placeholder="1111 2222 3333 4444" required>
                    </div>
                    <div class="input-box">
                        <span>Exp. Month :</span>
                        <input type="text" name="exp_month" placeholder="MM" required>
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>Exp. Year :</span>
                            <input type="number" name="exp_year" placeholder="YYYY" required>
                        </div>
                        <div class="input-box">
                            <span>CVV :</span>
                            <input type="number" name="cvv" placeholder="123" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn" name="submit_payment">Submit</button>
        </form>
    </div>

</body>

</html>