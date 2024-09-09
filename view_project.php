<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Fetch project details
$project_sql = "SELECT p.*, u.username as client_name FROM projects p LEFT JOIN users u ON p.client_id = u.id WHERE p.id = ?";
$project_stmt = $conn->prepare($project_sql);
$project_stmt->bind_param("i", $project_id);
$project_stmt->execute();
$project_result = $project_stmt->get_result();
$project = $project_result->fetch_assoc();

// Check if the user has permission to view this project
if ($role !== 'admin' && $project['client_id'] !== $user_id) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - Lokai Construction</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>View Project</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2><?php echo htmlspecialchars($project['name']); ?></h2>
        <p><strong>Client:</strong> <?php echo htmlspecialchars($project['client_name']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($project['status']); ?></p>

        <?php if ($role === 'admin'): ?>
            <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="button">Edit Project</a>
            <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</a>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Lokai Construction. All rights reserved.</p>
    </footer>
</body>
</html>