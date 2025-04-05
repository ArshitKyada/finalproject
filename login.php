<?php 
session_start();
include_once('connect.php');

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        header("Location: admin/index.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if ($user['password'] == $password) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 
            $_SESSION['account_type'] = $user['account_type']; 
            $_SESSION['user_email'] = $user['email']; 

            if ($user['account_type'] == 'buyer') {
                header("Location: index.php");
            } else {
                header("Location: sellerindex.php"); 
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }

        .login-container h2 {
            margin: 0 0 15px;
            font-size: 28px;
            font-weight: 600;
            color: #343a40;
            text-align: center;
        }

        .login-container p {
            margin: 0 0 25px;
            color: #6c757d;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #495057;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            transition: border-color 0.3s;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .login-container .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
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
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Account Login</h2>
        <p>Please enter your login details!</p>
        <?php if ($error): ?>
            <p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required>

            <a href="forgot.php">Forgot password?</a><br><br>
            <button type="submit" class="login-button">Log in</button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>