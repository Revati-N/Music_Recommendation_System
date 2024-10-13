<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        setcookie("user", $username, time() + (86400 * 30), "/");
        header("Location: dashboard.php");
    } else {
        echo "Incorrect password";
    }
} else {
    echo "No user found";
}
?>
