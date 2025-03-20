<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/adminstyle.css">
    <style>
    aside {
        position: fixed;
        /* Fix the sidebar */
        top: 0;
        left: 0;
        width: 250px;
        /* Set a width for the sidebar */
        height: 100%;
        /* Full height */
        background-color: #2d3748;
        color: white;
        /* Text color */
        padding: 20px;
        /* Padding */
        box-shadow: 2px 0 5px rgba(10, 47, 86, 0.5);
        /* Optional shadow */
        overflow-y: auto;
        /* Allow scrolling if content overflows */
    }


    .divider-sidebar {
        width: 100%;
        height: 4px;
        background-color: rgb(255, 255, 255);
        margin-bottom: 24px;
    }

    main {
        margin-left: 300px;
    }
    </style>
</head>

<body>
    <aside>
        <h1>Admin Panel</h1>
        <div class="divider-sidebar"></div>
        <nav>
            <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="manageauction.php"><i class="fas fa-gavel"></i> Manage Auctions</a>
            <a href="manageusers.php"><i class="fas fa-users"></i> Manage Users</a>
            <a href="earnings.php"><i class="fas fa-money-bill-wave"></i> Manage Earnings</a>
            <a href="contact.php"><i class="fas fa-cogs"></i> Feedback</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>
</body>

</html>