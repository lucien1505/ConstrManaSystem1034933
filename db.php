<?php
// Define database connection parameters
$servername = "127.0.0.1";  // Server address (localhost for local development)
$username = "root";         // Database username
$password = "lokaidb05";    // Database password
$dbname = "construction_management"; // Name of the database to connect to

// Create a new MySQLi instance and attempt to connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there was an error connecting, output the error message and stop script execution
    die("Connection failed: " . $conn->connect_error);
}
?>
