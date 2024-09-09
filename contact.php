<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $message = $conn->real_escape_string($_POST['message']);
    $how_heard = $conn->real_escape_string($_POST['how_heard']);
    $newsletter = isset($_POST['newsletter']) ? 1 : 0; // Checkbox value

    $sql = "INSERT INTO contacts (name, email, address, phone, reason, message, how_heard, newsletter) VALUES ('$name', '$email', '$address', '$phone', '$reason', '$message', '$how_heard', '$newsletter')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
