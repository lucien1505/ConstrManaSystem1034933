<?php include 'header.php'; ?>
<head>
    <style>
        .management-sections {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.management-sections .section {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 200px;
    padding: 20px;
    transition: background-color 0.3s, transform 0.3s;
}

.management-sections .section:hover {
    background-color: #007BFF;
    color: #fff;
    transform: scale(1.05);
}

.management-sections .section img {
    width: 50px;
    height: 50px;
}

.management-sections .section h3 {
    margin-top: 10px;
}

.management-sections .section a {
    text-decoration: none;
    color: inherit;
    display: block;
}
</style>
</head>

<div class="management-sections">
    <div class="section">
        <a href="view_users.php">
            <img src="icons/view-users.png" alt="View Users">
            <h3>View Users</h3>
        </a>
    </div>
  <div class="section">
        <a href="create_user.php">
            <img src="icons/create-user.png" alt="Create User">
            <h3>Create User</h3>
        </a>
    </div>
    <!-- <div class="section">
        <a href="edit_user.php">
            <img src="icons/edit-user.png" alt="Edit User">
            <h3>Edit User</h3>
        </a>
    </div> -->
    <div class="section">
        <a href="create_user_and_project.php">
            <img src="icons/delete-user.png" alt="Account creation">
            <h3>Account Creation</h3>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>
