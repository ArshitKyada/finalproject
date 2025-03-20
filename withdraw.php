<?php
session_start();
include_once 'connect.php';
include_once 'header.php';

// Assuming user ID is stored in session
$userId = $_SESSION['user_id'];

// Fetch total revenue for the seller
$sqlRevenue = "
    SELECT SUM(p.amount_due) as total_revenue 
    FROM payments p
    JOIN products pr ON p.product_id = pr.id 
    WHERE pr.seller_id = $userId
";
$resultRevenue = mysqli_query($conn, $sqlRevenue);
$totalRevenue = mysqli_fetch_assoc($resultRevenue)['total_revenue'] ?? 0;

// Deduct 5% fee
$totalRevenue *= 0.95;

// Fetch total withdrawn amount
$sqlWithdrawals = "SELECT SUM(amount) as total_withdrawn FROM withdrawals WHERE seller_id = $userId";
$resultWithdrawals = mysqli_query($conn, $sqlWithdrawals);
$totalWithdrawn = mysqli_fetch_assoc($resultWithdrawals)['total_withdrawn'] ?? 0;

// Calculate available balance
$availableBalance = $totalRevenue - $totalWithdrawn;

// Minimum withdrawal amount
$minWithdraw = 500;
$message = "";

// Handle withdrawal request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $withdrawAmount = $_POST['withdraw_amount'];

    if ($withdrawAmount >= $minWithdraw && $withdrawAmount <= $availableBalance) {
        // Insert withdrawal record into database (WITHOUT prepared statement)
        $query = "INSERT INTO withdrawals (seller_id, amount) VALUES ($userId, $withdrawAmount)";
        if (mysqli_query($conn, $query)) {
            $availableBalance -= $withdrawAmount;
            $message = "<div class='alert alert-success'>Withdrawal of $$withdrawAmount processed successfully!<br> Updated Balance: $" . number_format($availableBalance, 2) . "</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error processing withdrawal.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Invalid withdrawal amount. Minimum withdrawal is $$minWithdraw and maximum is $" . number_format($availableBalance, 2) . ".</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw Funds</title>
    <link rel="stylesheet" href="css/sellerstyle.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef; /* Light gray background */
            margin: 0;
            padding: 0;
        }

        .withdraw-container {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            padding: 35px; /* Increased padding for a more spacious feel */
            background-color: #ffffff; /* White background for the container */
            border-radius: 15px; /* More rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Deeper shadow for a floating effect */
            text-align: center;
        }

        h1 {
            color: #343a40; /* Darker text color */
            margin-bottom: 20px; /* Space below the heading */
        }

        .form-group {
            margin-bottom: 20px; /* Increased space between form elements */
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px; /* More space below labels */
            font-weight: bold;
            color: #495057; /* Darker label color */
        }

        input[type="number"] {
            width: 100%;
            padding: 12px; /* Increased padding for input */
            border: 1px solid #ced4da; /* Light border color */
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s; /* Smooth transition for border color */
        }

        input[type="number"]:focus {
            border-color: #28a745; /* Green border on focus */
            outline: none; /* Remove default outline */
        }

        .withdraw-button {
            width: 100%;
            padding: 14px; /* Increased padding for button */
            background-color: #28a745; /* Green background */
            color: white;
            font-size: 18px; /* Larger font size */
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .withdraw-button:hover {
            background-color: #218838; /* Darker green on hover */
            transform: scale(1.05);
        }

        .withdraw-button:active {
            transform: scale(0.95);
        }

        .alert {
            padding: 12px; /* Increased padding for alerts */
            margin-bottom: 20px; /* More space below alerts */
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda; /* Light green background */
            color: #155724; /* Dark green text */
            border: 1px solid #c3e6cb; /* Green border */
        }

        .alert-danger {
            background-color: #f8d7da; /* Light red background */
            color: #721c24; /* Dark red text */
            border: 1px solid #f5c6cb; /* Red border */
        }

        .balance-info {
            font-size: 20px; /* Larger font size for balance info */
            font-weight: bold;
            color: #343a40; /* Darker text color */
            margin-top: 20px; /* More space above balance info */
        }

        .back-button {
            display: inline-block;
            margin-top: 20px; /* More space above back button */
            padding: 12px 20px; /* Increased padding for back button */
            background-color: #007bff; /* Blue background */
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="withdraw-container">
        <h1>Withdraw Funds</h1>
        <?php echo $message; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="withdraw_amount">Amount to Withdraw (Min: $<?php echo $minWithdraw; ?>):</label>
                <input type="number" id="withdraw_amount" name="withdraw_amount" 
                       min="<?php echo $minWithdraw; ?>" 
                       max="<?php echo number_format($availableBalance, 2); ?>" 
                       required />
            </div>
            <button type="submit" class="withdraw-button">Submit Withdrawal</button>
        </form>
        <p class="balance-info">Available Balance: $<?php echo number_format($availableBalance, 2); ?></p>
        <a href="sellerindex.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>