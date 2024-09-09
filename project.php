<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $conn->real_escape_string($_POST['client_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO projects (client_id, name, description, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $client_id, $name, $description, $status);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error creating project: " . $stmt->error;
    }
    $stmt->close();
}

$client_sql = "SELECT id, username FROM users WHERE role = 'client'";
$client_result = $conn->query($client_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project - Lokai Construction</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Create New Project</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" action="">
            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" required>
                <?php
                while ($client = $client_result->fetch_assoc()) {
                    echo "<option value='" . $client['id'] . "'>" . htmlspecialchars($client['username']) . "</option>";
                }
                ?>
            </select>

            <label for="name">Project Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>

            <button type="submit">Create Project</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Lokai Construction. All rights reserved.</p>
    </footer>
</body>
</html>
