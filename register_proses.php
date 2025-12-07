<?php
session_start();
include("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql_check = "SELECT * FROM user WHERE username='$username'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    header("Location: register.php?error=used");
    exit();
}

$sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php?success=1");
} else {
    header("Location: register.php?error=failed");
}

$conn->close();
?>
