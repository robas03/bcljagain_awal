<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'atasan') {
    header('Location: atasan_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Atasan Dashboard</title>
    <!-- Tambahkan tautan gaya, perpustakaan JavaScript, dan elemen-elemen yang diperlukan di sini -->
</head>

<body>
    <h1>Selamat datang, Atasan!</h1>
    <ul>
        <li><a href="atasan.php">Menu Atasan</a></li>
        <!-- Tambahkan menu atau tautan lain yang sesuai dengan peran atasan -->
    </ul>
    <!-- Tambahkan konten khusus atasan di sini -->
</body>

</html>
