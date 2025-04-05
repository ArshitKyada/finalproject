<?php
session_start();
include_once 'connect.php';
include_once 'header.php';

$userId = $_SESSION['user_id'];

$sqlRevenue = "
    SELECT SUM(p.amount_due) as total_revenue 
    FROM payments p
    JOIN products pr ON p.product_id = pr.id 
    WHERE pr.seller_id = $userId
";
$resultRevenue = mysqli_query($conn, $sqlRevenue);
$totalRevenue = mysqli_fetch_assoc($resultRevenue)['total_revenue'] ?? 0;

$totalRevenue *= 0.95;

$sqlWithdrawals = "SELECT SUM(amount) as total_withdrawn FROM withdrawals WHERE seller_id = $userId";
$resultWithdrawals = mysqli_query($conn, $sqlWithdrawals);
$totalWithdrawn = mysqli_fetch_assoc($resultWithdrawals)['total_withdrawn'] ?? 0;

$availableBalance = $totalRevenue - $totalWithdrawn;
$availableBalance = max(0, $availableBalance);

$minWithdraw = 500;
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $withdrawAmount = $_POST['withdraw_amount'];
    $accountNumber = $_POST['account_number'];
    $ifscCode = $_POST['ifsc_code'];

    if ($withdrawAmount >= $minWithdraw && $withdrawAmount <= $availableBalance) {
        $query = "INSERT INTO withdrawals (seller_id, amount, account_number, ifsc_code) VALUES ($userId, $withdrawAmount, '$accountNumber', '$ifscCode')";
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
    <link rel="stylesheet" href="css/sellerstyle.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .withdraw-container {
        max-width: 500px;
        margin: auto;
        margin-top: 50px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="number"],
    input[type="text"] {
        width: 475px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .withdraw-button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .withdraw-button:hover {
        background-color: #218838;
    }

    .alert {
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .balance-info {
        font-size: 18px;
        margin-top: 20px;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .back-button:hover {
        background-color: #0056b3;
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
                <input type="number" id="withdraw_amount" name="withdraw_amount" min="<?php echo $minWithdraw; ?>"
                    max="<?php echo number_format($availableBalance, 2); ?>" required />
            </div>
            <div class="form-group">
                <label for="account_number">Account Number:</label>
                <input type="number" id="account_number" name="account_number" required minlength="8" maxlength="18" />
            </div>
            <div class="form-group">
                <label for="ifsc_code">IFSC Code:</label>
                <input type="text" id="ifsc_code" name="ifsc_code" required />
            </div>
            <button type="submit" class="withdraw-button">Submit Withdrawal</button>
        </form>
        <p class="balance-info">Available Balance: $<?php echo number_format($availableBalance, 2); ?></p>
        <a href="sellerindex.php" class="back-button">Back to Dashboard</a>
    </div>
</body>

</html>
