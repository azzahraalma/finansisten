<?php 
$hostmysql = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "finansisten"; 
$conn = mysqli_connect ($hostmysql, $username, $password, $database); 
if ($conn->connect_error) {  
 die("Koneksi gagal: " . $conn->connect_error);  
}  
?>