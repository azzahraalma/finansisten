<?php
session_start();
include("connect.php");

header("Content-Type: application/json");

if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error"]);
    exit;
}

$username = $_SESSION['username'];
$getUser = $conn->query("SELECT user_id FROM user WHERE username='$username'");
$user = $getUser->fetch_assoc();
$user_id = $user['user_id'];

$nama = $_POST['nama'];
$jenis = $_POST['jenis'];

$conn->query("INSERT INTO kategori (nama, jenis, user_id) VALUES ('$nama', '$jenis', $user_id)");
$id = $conn->insert_id;

echo json_encode([
    "status" => "success",
    "id" => $id,
    "nama" => ucfirst($nama)
]);
exit;
?>
