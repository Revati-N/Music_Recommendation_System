<?php
include 'db_connect.php';

$identifier = $_POST['username']; // Renamed variable for clarity
$password = $_POST['password'];

// Check if the input is an email
if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT * FROM users WHERE email = '$identifier'";
} else {
    $sql = "SELECT * FROM users WHERE username = '$identifier'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        setcookie("user", $row['username'], time() + (86400 * 30), "/");
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Incorrect password";
    }
} else {
    echo "No user found";
}
?>
