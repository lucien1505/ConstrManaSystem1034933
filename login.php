<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Keep plain password for verification

    // Prepare SQL query to fetch user by username
    $sql = "SELECT * FROM user WHERE username=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
                // Verify hashed password
                if (password_verify($password, $user['password'])) {
                    // Store user data in session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['username'] = $user['username'];
                    
                    // Check if the user is admin
                    if ($user['username'] === 'admin') {
                        header('Location: admin_dashboard.php'); // Redirect to admin dashboard
                        exit();
                    } else {
                        header('Location: dashboard.php'); // Redirect to user dashboard
                        exit();
                    }
                } else {
                    $error = "Invalid password";
                }
            } else {
                $error = "No user found with that username";
            }
        } else {
            die("SQL query failed: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("SQL statement preparation failed: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lokai Construction</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/log.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff71;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #293629;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #c49618;
        }
        .loginlogo {
            text-align: center;
            margin-bottom: 20px;
        }
        .loginlogo img {
            width: 150px;
        }
        .loginheader {
            text-align: center;
            margin-bottom: 80px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div>
        <div class="loginlogo">
            <img src="images/logo.png" alt="Logo"> 
        </div>
        <div class="loginheader">
            <h1>Lokai Construction</h1>
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <input type="submit" value="Login">
            </form>
            <!-- <p>Don't have an account? <a href="register.php">Register here</a></p> -->
            <a href="home.html" class="back_button">Go back</a>
        </div>
    </div>
</body>
</html>
