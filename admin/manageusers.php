<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        main {
            flex-grow: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top:20px;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #333;
        }

        .divider {
            width: 100%;
            height: 4px;
            background-color: rgb(0, 0, 0);
            margin-bottom: 24px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .user-table th,
        .user-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .user-table th {
            background-color:rgb(13, 50, 81);
            color: white;
            font-weight: 500;
        }

        .user-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .user-table tr:hover {
            background-color: #e2e8f0;
        }

        .button {
            background-color: red;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #c62828; /* Darker red on hover */
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between buttons */
        }
    </style>
</head>

<body>
    <?php include_once 'sidebar.php'; ?>
    <main>
        <h2>Manage Users</h2>
        <div class="divider"></div>
        
        <table class="user-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../connect.php';

                // Query to get all users
                $sql = "SELECT * FROM users"; // Assuming your users table is named 'users'
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['account_type']}</td>
                                <td>{$row['password']}</td> <!-- Displaying password (not recommended for security) -->
                                <td class='action-buttons'>
                                    <a href='delete_user.php?id={$row['id']}' class='button' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>