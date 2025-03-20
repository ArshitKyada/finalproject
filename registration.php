<?php
session_start();
include_once('connect.php'); 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = $_POST['account_type'];

    if ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            $error = 'Username or email already exists. Please choose another.';
        } else {
            $query = "INSERT INTO users (username, email, password, account_type) VALUES ('$username', '$email', '$password', '$account_type')";
            
            if (mysqli_query($conn, $query)) {
                header("Location: login.php"); 
                exit();
            } else {
                $error = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Auctioneers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e9ecef;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        height:620px;
        max-width: 400px;
        box-sizing: border-box;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
        color: #333;
    }

    p {
        margin: 0;
        margin-bottom: 20px;
        color: #666;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group select {
        width: 320px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f0f4ff;
    }

    .form-group input{
        width: 300px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f0f4ff;
    }

    .form-group input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
        width: 320px;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }

    .signin-link {
        text-align: center;
        margin-top: 20px;
    }

    .signin-link a {
        color: #007bff;
        text-decoration: none;
    }

    .signin-link a:hover {
        text-decoration: underline;
    }

    .terms {
        font-size: 12px;
        color: #666;
        text-align: center;
        margin-top: 20px;
    }

    .terms a {
        color: #007bff;
        text-decoration: none;
    }

    .terms a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create An Account</h1>
        <p>Sign up for free</p>

        <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username*" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail*" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password*" required>
            </div>
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password*"
                    required>
            </div>
            <div class="form-group">
                <select name="account_type" required>
                    <option value="" disabled selected>Choose Account type</option>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign up">
            </div>
        </form>
        <p class="signin-link">Already have an account? <a href="login.php">Sign In</a></p>
        <p class="terms">By clicking Sign up, you agree to our <a href="terms.php">Terms and Conditions</a>.</p>
    </div>
</body>

</html>