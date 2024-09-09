<?php
include 'database.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $status = 'Pending'; // Default status
    $budget = $_POST['budget'];
    $expenses = 0; // Default expenses
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    try {
        // Start a transaction
        $conn->beginTransaction();

        // Insert user into the users table
        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        // Get the last inserted user ID
        $user_id = $conn->lastInsertId();

        // Insert project associated with the new user
        $sql = "INSERT INTO projects (name, description, status, budget, expenses, start_date, end_date, client_id) 
                VALUES (:name, :description, :status, :budget, :expenses, :start_date, :end_date, :client_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $project_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':expenses', $expenses);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':client_id', $user_id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();
        echo "User and project created successfully.";

    } catch (Exception $e) {
        // Rollback the transaction if something went wrong
        $conn->rollBack();
        echo "Failed to create user and project: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User and Assign Project</title>
</head>
<body>
    <h2>Create User and Assign Project</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" id="project_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="budget">Budget:</label>
        <input type="number" name="budget" id="budget" required><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required><br>

        <input type="submit" value="Create User and Project">
    </form>
</body>
</html>
