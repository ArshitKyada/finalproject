<?php
session_start();
include_once('connect.php'); // Make sure you have your database connection file

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple query to check if the username exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Here you should check password hashing, but for this example it's plain text
        if ($user['password'] == $password) {
            // Store session variables after login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_type'] = $user['account_type'];  // You can store the account type too if needed
            
            // Redirect based on account type
            if ($user['account_type'] == 'buyer') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = 'Invalid password.';
        }
    } else {
        $error = 'No user found with that username.';
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
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    .login-container h2 {
        margin: 0 0 10px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .login-container p {
        margin: 0 0 20px;
        color: #666;
    }

    .login-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f0f4ff;
    }

    .login-container a {
        color: #007bff;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    .login-container .login-button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    .login-container .login-button:hover {
        background-color: #0056b3;
    }

    .login-container .signup-link {
        text-align: center;
        margin-top: 20px;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <center>
            <h2>Account Login</h2>
            <p>Please enter your login details and password!</p>
        </center>

        <!-- Display Error Message -->
        <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required>

            <a href="#">Forgot password?</a>
            <button type="submit" class="login-button">Log in</button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>