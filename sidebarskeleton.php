

<?php include_once 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Seller Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f7fafc;
        }

        .seller-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .seller-header {
            background-color: rgb(0, 0, 0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .seller-header h1 {
            font-size: 20px;
            color:rgb(255, 255, 255);
        }

        .seller-header-right {
            display: flex;
            align-items: center;
        }

        .notification-button {
            background: none;
            border: none;
            cursor: pointer;
            color:rgb(255, 255, 255);
            margin-right: 16px;
        }

        .main-content {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
        }

        .dashboard-content {
            flex: 1;
            padding: 16px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .dashboard-content {
                padding-bottom: 60px;
            }

            .icon {
                margin-bottom: 8px;
            }

            .seller-header h1 {
                font-size: 18px;
            }

            .notification-button {
                margin-right: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="seller-container">
        <!-- Header -->
        <header class="seller-header">
            <h1>Seller Dashboard</h1>
            <div class="header-right">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Sidebar -->
             <?php include_once 'sidebar.php'; ?>
            <!-- Dashboard Content -->
            <main class="dashboard-content">
                
            </main>
        </div>
    </div>
</body>

</html>
