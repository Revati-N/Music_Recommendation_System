<?php
include 'db_connect.php';

// Get input values
$username = $_POST['username'];
$email = $_POST['email']; // Add email input
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Prepare the SQL statement to include the email
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
