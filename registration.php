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
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f9f9f9;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        margin: 0;
        margin-bottom: 20px;
        color: #666;
    }

    .form-group {
        margin-bottom: 15px;
        position: relative;
    }

    .form-group input {
        width: 87%;
    }

    .form-group select {
        width: 100%;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        padding-right: 40px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        appearance: none;
    }

    .form-group i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        cursor: pointer;
    }

    .form-group input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
        width: 400px;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .terms {
        font-size: 12px;
        color: #666;
        margin-top: 20px;
    }

    .terms a {
        color: #007bff;
        text-decoration: none;
    }

    .terms a:hover {
        text-decoration: underline;
    }

    .signin-link {
        color: #007bff;
        text-decoration: none;
    }

    .signin-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h1>Create An Account</h1>
            <p>Sign up for free</p>
        </center>
        <?php if ($error): ?>
        <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username*" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail*" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password*" required>
                <i class="fas fa-eye-slash toggle-password" data-target="password"></i>
            </div>
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password*"
                    required>
                <i class="fas fa-eye-slash toggle-password" data-target="confirm-password"></i>
            </div>
            <div class="form-group">
                <select name="account_type" required>
                    <option value="" disabled selected>Choose Account type</option>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign up">
            </div>
        </form>
        <p>Already have an account? <a href="login.php" class="signin-link">Sign In</a></p>

        <p class="terms">By clicking Sign up, you agree to our <a href="#">Terms and Conditions</a>.</p>
    </div>

    <script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', () => {
            const targetId = icon.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
    </script>
</body>

</html>