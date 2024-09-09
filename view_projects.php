<?php 
include 'database.php'; 
include 'header.php'; 

$sql = "SELECT * FROM projects";
$stmt = $conn->prepare($sql);
$stmt->execute();
$projects = $stmt->fetchAll();
?>

<h2>All Projects</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th>Client ID</th>
        <th>Budget</th>
        <th>Expenses</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($projects as $project): ?>
    <tr>
        <td><?php echo $project['id']; ?></td>
        <td><?php echo $project['name']; ?></td>
        <td><?php echo $project['description']; ?></td>
        <td><?php echo $project['start_date']; ?></td>
        <td><?php echo $project['end_date']; ?></td>
        <td><?php echo $project['status']; ?></td>
        <td><?php echo $project['client_id']; ?></td>
        <td><?php echo $project['budget']; ?></td>
        <td><?php echo $project['expenses']; ?></td>
        <td>
            <a href="edit_project.php?id=<?php echo $project['id']; ?>">Edit</a> |
            <a href="delete_project.php?id=<?php echo $project['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
