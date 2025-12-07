<?php
session_start();
include("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;

header("Location: dashboard.php?ok=1");
} else {
    header("Location: login.php?error=1");
}

$conn->close();
?>
