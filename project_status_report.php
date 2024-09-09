<?php 
include 'header.php'; 
include 'database.php';

$sql = "SELECT name, description, status FROM projects";
$stmt = $conn->prepare($sql);
$stmt->execute();
$projects = $stmt->fetchAll();

?>

<h2>Project Status Report</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
    </tr>
    <?php foreach ($projects as $project): ?>
    <tr>
        <td><?php echo htmlspecialchars($project['name']); ?></td>
        <td><?php echo htmlspecialchars($project['description']); ?></td>
        <td><?php echo htmlspecialchars($project['status']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
