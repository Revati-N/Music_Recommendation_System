<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: index.html");
} else {
    echo "Error: " . $conn->error;
}
?>
