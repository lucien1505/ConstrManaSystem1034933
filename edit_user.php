<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection and header
include 'database.php';
include 'header.php';

// Initialize user variable
$user = null;

// Handle GET request to fetch user details
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SQL statement
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    // Check if user was found
    if (!$user) {
        echo "User not found.";
        exit;
    }
}

// Handle POST request to update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Prepare and execute SQL statement to update user
    $sql = "UPDATE user SET username = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $role, $id]);

    // Redirect to view users page
    header('Location: view_users.php');
    exit;
}
?>

<h2>Edit User</h2>

<?php if ($user): ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="project_manager" <?php if ($user['role'] == 'project_manager') echo 'selected'; ?>>Project Manager</option>
            <option value="client" <?php if ($user['role'] == 'client') echo 'selected'; ?>>Client</option>
        </select><br>

        <input type="submit" value="Update User">
    </form>
<?php else: ?>
    <p>No user data available.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
