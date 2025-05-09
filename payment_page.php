<?php

session_start();

include_once 'connect.php'; 
include_once 'header.php'; 

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

// Check if product_id is set in GET request
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); 
} else {
    die("Error: Product ID is missing."); 
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

// Check if a payment has already been made for this product
$payment_check_sql = "SELECT COUNT(*) as payment_exists FROM payments WHERE product_id = $product_id";
$payment_check_result = $conn->query($payment_check_sql);
$payment_exists = $payment_check_result->fetch_assoc()['payment_exists'] > 0;

if ($payment_exists) {
    die("<script>alert('Payment has already been made for this product.'); window.location.href = 'index.php';</script>");
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $zip_code = $conn->real_escape_string($_POST['zip_code']);
    $card_name = $conn->real_escape_string($_POST['card_name']);
    $card_number = $conn->real_escape_string($_POST['card_number']);
    $exp_month = $conn->real_escape_string($_POST['exp_month']);
    $exp_year = $conn->real_escape_string($_POST['exp_year']);
    $cvv = $conn->real_escape_string($_POST['cvv']);

    $sql = "INSERT INTO payments (user_id, full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv, amount_due, product_id) 
        VALUES ($userId, '$full_name', '$email', '$address', '$city', '$state', '$zip_code', '$card_name', '$card_number', '$exp_month', '$exp_year', '$cvv', $highest_bid, $product_id)";

    
    if ($conn->query($sql) === TRUE) {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'arshitkyada75@gmail.com'; // Your email
            $mail->Password   = 'abmh fape dyjn jizg'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('arshitkyada75@gmail.com', 'Auctioneers'); // Sender's email and name
            $mail->addAddress($email, $full_name); // Add recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Payment Successful';
            $mail->Body    = 'Dear ' . htmlspecialchars($full_name) . ',<br><br>Your payment of $' . number_format($highest_bid, 2) . ' for the product "' . htmlspecialchars($product['product_name']) . '" has been successfully processed.<br><br>Thank you for your purchase!<br><br>Best Regards,<br>Auctioneers';

            $mail->send();
            echo "<script>alert('Payment successfully! Thank you for your purchase.'); window.location.href = 'index.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Payment successful, but email could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Error storing payment details: " . $conn->error . "');</script>";
    }
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paymentstyle.css">
    <style>
    body::-webkit-scrollbar {
        display: none;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #1f242d;
        padding: 25px;
    }

    .container form {
        width: 100%;
        max-width: 700px;
        padding: 40px;
        background: #fff;
        border-radius: 10px;
        box-sizing: border-box;
    }

    form .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .column {
        flex: 1 1 48%;
        min-width: 250px;
    }

    .column .title {
        font-size: 20px;
        color: #333;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .input-box {
        margin-bottom: 15px;
    }

    .input-box span {
        display: block;
        margin-bottom: 8px;
    }

    .input-box input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .flex {
        display: flex;
        gap: 15px;
    }

    .flex .input-box {
        margin-top: 5px;
        flex: 1 1 45%;
    }

    .input-box img {
        height: 34px;
        margin-top: 5px;
        filter: drop-shadow(0 0 1px #000);
    }

    form .btn {
        width: 100%;
        padding: 14px;
        background: #8175d3;
        border: none;
        outline: none;
        border-radius: 6px;
        font-size: 17px;
        color: #fff;
        margin-top: 20px;
        cursor: pointer;
        transition: .5s;
    }

    form .btn:hover {
        background: #6a5acd;
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
                        <input type="text" name="full_name" placeholder="Arshit kyada" required>
                    </div>
                    <div class="input-box">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="arshitkyada@gmail.com" required>
                    </div>
                    <div class="input-box">
                        <span>Address :</span>
                        <input type="text" name="address" placeholder="Street - Locality" required>
                    </div>
                    <div class="input-box">
                        <span>City :</span>
                        <input type="text" name="city" placeholder="Surat" required>
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>State :</span>
                            <input type="text" name="state" placeholder="Gujarat" required>
                        </div>
                        <div class="input-box">
                            <span>Zip Code :</span>
                            <input type="number" name="zip_code" placeholder="395 006" required>
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
                        <input type="text" name="card_name" placeholder="Mr.Arshit kyada" required>
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