<?php
session_start();
include_once('connect.php'); 

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $success = 'A password reset link has been sent to your email address.';
    } else {
        $error = 'No account found with that email address.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
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

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
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

        .form-group input {
            width: 100%;
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
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: green;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Forgot Password</h1>
        <p>Please enter your email address to receive a password reset link.</p>
        
        <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail*" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Send Reset Link">
            </div>
        </form>
        <p class="signin-link">Remembered your password? <a href="login.php">Sign In</a></p>
    </div>
</body>

</html>