<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? null;
    $lokasi = $_POST['lokasi'] ?? null;
    $telepon = $_POST['telepon'] ?? null;
    $pegawai = $_POST['pegawai'] ?? null;
    $nilai = $_POST['nilai'] ?? null;
    $ketentuan = $_POST['ketentuan'] ?? null;

    if (!$nama || !$lokasi || !$telepon || !$pegawai || !$nilai || !$ketentuan) {
        header("Location: customer.php?error=Pastikan semua data terisi dan pilihan pada pernyataan dicentang dengan benar.");
        exit();
    } else {
        if (count($ketentuan) !== 2 || !in_array("layanan", $ketentuan) || !in_array("imbalan", $ketentuan)) {
            header("Location: customer.php?error=Kedua pilihan pada pernyataan harus dicentang.");
            exit();
        }

        $layanan = in_array("layanan", $ketentuan) ? 1 : 0;
        $imbalan = in_array("imbalan", $ketentuan) ? 1 : 0;

        // Simpan data ke database
        $sql = "INSERT INTO customer (nama, lokasi, telepon, pegawai, nilai, layanan, imbalan) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssiii", $nama, $lokasi, $telepon, $pegawai, $nilai, $layanan, $imbalan);
            if ($stmt->execute()) {
                header("Location: customer.php?success=Data berhasil direkam.");
                exit();
            } else {
                header("Location: customer.php?error=Error: " . $sql . "<br>" . $conn->error);
                exit();
            }
            $stmt->close();
        } else {
            header("Location: customer.php?error=Kesalahan persiapan pernyataan SQL.");
            exit();
        }
    }
    $conn->close();
} else {
    header("Location: customer.php?error=Metode permintaan tidak valid.");
    exit();
}
?>
