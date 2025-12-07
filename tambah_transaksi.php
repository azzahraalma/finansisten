<?php
session_start();
include "connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$getUser = $conn->query("SELECT user_id FROM user WHERE username='$username'");
$user = $getUser->fetch_assoc();
$user_id = $user['user_id'];

$jenis = $_POST['jenis'];
$kategori_id = $_POST['kategori_id'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'] ?? '';
$tanggal = $_POST['tanggal'];

$conn->query("
    INSERT INTO transaksi (user_id, jenis, kategori_id, jumlah, keterangan, tanggal)
    VALUES ('$user_id','$jenis','$kategori_id','$jumlah','$keterangan','$tanggal')
");

header("Location: dashboard.php");
exit;
?>
