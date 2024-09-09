<?php 
include 'header.php'; 
include 'database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #35424a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #35424a;
            color: #ffffff;
        }

        td {
            background-color: #f9f9f9;
        }

        footer {
            background: #35424a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<main>
    <h2>User Activity Report</h2>

    <?php
    $sql = "SELECT u.username, a.action, a.timestamp
            FROM audit_log a
            JOIN users u ON a.user_id = u.id
            ORDER BY a.timestamp DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $activities = $stmt->fetchAll();
    ?>

    <table>
        <tr>
            <th>Username</th>
            <th>Action</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?php echo htmlspecialchars($activity['username']); ?></td>
            <td><?php echo htmlspecialchars($activity['action']); ?></td>
            <td><?php echo htmlspecialchars($activity['timestamp']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
