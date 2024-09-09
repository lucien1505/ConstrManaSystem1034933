<?php 
include 'header.php'; 
include 'database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        header {
            background: #28a745;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #35424a;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        a.button {
            display: inline-block;
            padding: 12px 20px; /* Adjust padding for uniform button height */
            background-color: #35424a;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            width: 100%; /* Full width of the container */
            max-width: 300px; /* Maximum width for buttons */
            box-sizing: border-box; /* Include padding in width */
        }

        a.button:hover {
            background-color: #45a049;
        }

        footer {
            background: #35424a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<main>
    <h2>Reports & Analytics</h2>

    <ul>
        <li><a href="project_status_report.php" class="button">Project Status Report</a></li>
        <!-- <li><a href="user_activity_report.php" class="button">User Activity Report</a></li> -->
        <li><a href="financial_report.php" class="button">Financial Report</a></li>
        <li><a href="task_progress_report.php" class="button">Task Progress Report</a></li>
    </ul>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
