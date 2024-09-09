<?php 
include 'database.php'; 
include 'header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $project = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $budget = $_POST['budget'];
    $expenses = $_POST['expenses'];
    $client_id = !empty($_POST['client_id']) ? $_POST['client_id'] : null; // Use null if empty

    // Validate and sanitize input
    if (!is_numeric($client_id) && !is_null($client_id)) {
        die('Invalid client ID');
    }

    $sql = "UPDATE projects SET name = ?, description = ?, start_date = ?, end_date = ?, status = ?, budget = ?, expenses = ?, client_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$name, $description, $start_date, $end_date, $status, $budget, $expenses, $client_id, $id]);
        header('Location: view_projects.php');
    } catch (PDOException $e) {
        echo "Error updating project: " . $e->getMessage();
    }
}
?>

<h2>Edit Project</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($project['id']); ?>">

    <label for="name">Project Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($project['name']); ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea><br>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($project['start_date']); ?>" required><br>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($project['end_date']); ?>" required><br>

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="Pending" <?php if ($project['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
        <option value="Ongoing" <?php if ($project['status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
        <option value="Completed" <?php if ($project['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
    </select><br>

    <label for="budget">Budget:</label>
    <input type="number" id="budget" name="budget" value="<?php echo htmlspecialchars($project['budget']); ?>" required><br>

    <label for="expenses">Expenses:</label>
    <input type="number" id="expenses" name="expenses" value="<?php echo htmlspecialchars($project['expenses']); ?>" required><br>

    <label for="client_id">Client ID:</label>
    <input type="text" id="client_id" name="client_id" value="<?php echo htmlspecialchars($project['client_id']); ?>" readonly><br>

    <input type="submit" value="Update Project">
</form>

<?php include 'footer.php'; ?>
