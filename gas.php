<?php
include 'koneksi.php';

$file_path = "C:/xampp/htdocs/bcljagain/customer.csv";

$file = fopen($file_path, 'r');
if (!$file) {
    die('Gagal membuka file CSV.');
}

// Lewati baris pertama (header)
fgetcsv($file);

while (($data = fgetcsv($file, 1000, ",")) !== false) {
    $nama = $conn->real_escape_string($data[0]);
    $lokasi_id = intval($data[1]);
    $telepon = $conn->real_escape_string($data[2]);
    $pegawai_id = intval($data[3]);
    $nilai = intval($data[4]);
    $respon = !empty($data[5]) ? "'".$conn->real_escape_string($data[5])."'" : "NULL";
    $layanan = intval($data[6]);
    $imbalan = intval($data[7]);

    // Cek apakah lokasi_id valid
    $cek_lokasi = $conn->query("SELECT id FROM data_perusahaan WHERE id = $lokasi_id");
    if ($cek_lokasi->num_rows == 0) {
        echo "Gagal: lokasi_id $lokasi_id tidak ditemukan di data_perusahaan!<br>";
        continue;
    }

    // Cek apakah pegawai_id valid
    $cek_pegawai = $conn->query("SELECT id FROM pegawai WHERE id = $pegawai_id");
    if ($cek_pegawai->num_rows == 0) {
        echo "Gagal: pegawai_id $pegawai_id tidak ditemukan di pegawai!<br>";
        continue;
    }

    $sql = "INSERT INTO customer (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan) 
            VALUES ('$nama', $lokasi_id, '$telepon', $pegawai_id, $nilai, $respon, $layanan, $imbalan)";

    if ($conn->query($sql)) {
        echo "Data berhasil ditambahkan: $nama <br>";
    } else {
        echo "Gagal menambahkan: " . $conn->error . "<br>";
    }
}

fclose($file);
$conn->close();
?>
