<?php 
include 'database.php'; 
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $budget = $_POST['budget'];
    $expenses = $_POST['expenses'];

    // Automatically generate next client_id
    $sql = "SELECT MAX(client_id) AS max_client_id FROM projects";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    $client_id = $row['max_client_id'] + 1;

    $sql = "INSERT INTO projects (name, description, start_date, end_date, status, client_id, budget, expenses) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $description, $start_date, $end_date, $status, $client_id, $budget, $expenses]);

    header('Location: view_projects.php');
}
?>

<h2>Create New Project</h2>

<form method="POST">
    <label for="name">Project Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required><br>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required><br>

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="Pending">Pending</option>
        <option value="Ongoing">Ongoing</option>
        <option value="Completed">Completed</option>
    </select><br>

    <label for="budget">Budget:</label>
    <input type="number" id="budget" name="budget" required><br>

    <label for="expenses">Expenses:</label>
    <input type="number" id="expenses" name="expenses" required><br>

    <input type="submit" value="Create Project">
</form>

<?php include 'footer.php'; ?>
