<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pegawai') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pegawai Dashboard</title>
    <!-- Tambahkan tautan gaya, perpustakaan JavaScript, dan elemen-elemen yang diperlukan di sini -->
</head>

<body>
    <h1>Selamat datang, Pegawai!</h1>
    <!-- Tambahkan konten khusus pegawai di sini -->
</body>

</html>
