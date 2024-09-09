<?php
include 'database.php'; 

// Start the session to get the logged-in user's ID
session_start();
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

// Fetch the client's projects
$sql = "SELECT name, description, status, budget, expenses, start_date, end_date 
        FROM projects 
        WHERE client_id = :client_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':client_id', $user_id);
$stmt->execute();
$projects = $stmt->fetchAll();
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
        .logout-button {
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    background: #ff4b5c;
                    color: #ffffff;
                    border: none;
                    padding: 10px;
                    border-radius: 4px;
                    cursor: pointer;
                }
        main {
            padding: 20px;
            max-width: 1000px;
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

        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 5px;
        }

        .progress-bar {
            height: 20px;
            width: 0;
            background-color: #007bff;
            text-align: center;
            line-height: 20px;
            color: #fff;
            border-radius: 5px;
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
<header>
    <h1>My Projects</h1>
    <a href="logout.php" class="logout-button">Logout</a>
</header>
<main>
    <h2>My Projects</h2>

    <?php if (count($projects) > 0): ?>
    <table>
        <tr>
            <th>Project Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Budget</th>
            <th>Expenses</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Progress</th>
        </tr>
        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?php echo htmlspecialchars($project['name']); ?></td>
            <td><?php echo htmlspecialchars($project['description']); ?></td>
            <td><?php echo htmlspecialchars($project['status']); ?></td>
            <td><?php echo htmlspecialchars($project['budget']); ?></td>
            <td><?php echo htmlspecialchars($project['expenses']); ?></td>
            <td><?php echo htmlspecialchars($project['start_date']); ?></td>
            <td><?php echo htmlspecialchars($project['end_date']); ?></td>
            <td>
                <?php
                $progress = 0;
                switch (htmlspecialchars($project['status'])) {
                    case 'Pending':
                        $progress = 0;
                        break;
                    case 'Ongoing':
                        $progress = rand(10, 70); // Random progress between 10% and 70%
                        break;
                    case 'Completed':
                        $progress = 100;
                        break;
                }
                ?>
                <div class="progress-container">
                    <div class="progress-bar" style="width: <?php echo $progress; ?>%;">
                        <?php echo $progress; ?>%
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>No projects found.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
