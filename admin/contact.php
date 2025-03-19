<?php
include_once '../connect.php'; // Include your database connection

// Query to fetch contact messages from the 'contactus' table
$sql = "SELECT * FROM contactus ORDER BY created_at DESC"; // Order by created_at
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Us Messages</title>
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

        .message-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .message-table th,
        .message-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .message-table th {
            background-color: rgb(18, 55, 85);
            color: white;
            font-weight: 500;
        }

        .message-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .message-table tr:hover {
            background-color: #e2e8f0;
        }

        .delete-button {
            background-color: red; /* Red for Delete button */
            color: white; /* Text color */
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #c62828; /* Darker red on hover */
        }
    </style>
</head>

<body>
    <?php include_once 'sidebar.php'; ?>
    <main>
        <h2>Contact Us Messages</h2>
        <div class="divider"></div>

        <table class="message-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['subject']) . "</td>
                                <td>" . htmlspecialchars($row['message']) . "</td>
                                <td>" . htmlspecialchars($row['created_at']) . "</td>
                                <td>
                                    <a href='delete_message.php?id=" . $row['id'] . "' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this message?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No messages found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>
