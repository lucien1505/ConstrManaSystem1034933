<?php 
// Include the database connection file
include 'database.php'; 

// Include the header file which might contain HTML head elements or navigation menus
include 'header.php'; 

// SQL query to select all records from the 'user' table
$sql = "SELECT * FROM user";

// Prepare the SQL statement using the database connection
$stmt = $conn->prepare($sql);

// Execute the prepared statement
$stmt->execute();

// Fetch all the resulting rows from the executed query
$users = $stmt->fetchAll();

?>

<!-- Display a heading for the user list -->
<h2>All Users</h2>

<!-- Create a table to display user data -->
<table>
    <tr>
        <!-- Table headers for the user data columns -->
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    <!-- Loop through each user in the $users array and display their information in the table -->
    <?php foreach ($users as $user): ?>
    <tr>
        <!-- Display the user ID -->
        <td><?php echo $user['id']; ?></td>

        <!-- Display the username -->
        <td><?php echo $user['username']; ?></td>

        <!-- Display the user's email -->
        <td><?php echo $user['email']; ?></td>

        <!-- Display the user's role -->
        <td><?php echo $user['role']; ?></td>

        <!-- Provide edit and delete actions with links pointing to the respective scripts -->
        <td>
            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> |
            <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Include the footer file which might contain closing HTML tags or scripts -->
<?php include 'footer.php'; ?>