<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <!-- Tambahkan tautan gaya, perpustakaan JavaScript, dan elemen-elemen yang diperlukan di sini -->
</head>

<body>
    <h1>Selamat datang, Admin!</h1>
    <!-- Tambahkan konten khusus admin di sini -->
</body>

</html>
