<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "bear7685_jagain"; // Ganti nama_database dengan nama database yang benar

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
