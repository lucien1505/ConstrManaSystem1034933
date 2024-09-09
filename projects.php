<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <style>
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            background-color: #f8f9fa;
        }
        .button-container a {
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            padding: 15px 30px;
            margin: 0 10px;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="view_projects.php">View Projects</a>
        <!-- <a href="create_project.php">Create Project</a> -->
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
