<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? null;
    $lokasi_id = $_POST['lokasi'] ?? null;
    $telepon = $_POST['telepon'] ?? null;
    $pegawai_id = $_POST['pegawai'] ?? null;
    $nilai = $_POST['nilai'] ?? null;
    $respon = $_POST['respon'] ?? null;
    $ketentuan = $_POST['ketentuan'] ?? [];

    // Validasi input
    if (!$nama || !$lokasi_id || !$telepon || !$pegawai_id || !$nilai || empty($ketentuan)) {
        echo 'error: Pastikan semua data terisi dan setidaknya satu pernyataan dicentang.';
        exit();
    }

    // Periksa apakah kedua checkbox telah dicentang
    if (!in_array("layanan", $ketentuan) || !in_array("imbalan", $ketentuan)) {
        echo 'error: Kedua pilihan pada pernyataan harus dicentang.';
        exit();
    }

    // Konversi checkbox ke angka
    $layanan = in_array("layanan", $ketentuan) ? 1 : 0;
    $imbalan = in_array("imbalan", $ketentuan) ? 1 : 0;

    // Persiapkan query SQL
    $sql = "INSERT INTO customer (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameter ke statement SQL
        $stmt->bind_param("sisissii", $nama, $lokasi_id, $telepon, $pegawai_id, $nilai, $respon, $layanan, $imbalan);
        
        if ($stmt->execute()) {
            echo 'success: Data berhasil direkam.';
        } else {
            echo 'error: Terjadi kesalahan saat menambahkan data.';
        }
        
        $stmt->close();
    } else {
        echo 'error: Terjadi kesalahan saat mempersiapkan query SQL.';
    }

    $conn->close();
} else {
    echo 'error: Metode permintaan tidak valid.';
}
?>
