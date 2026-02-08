<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $lokasi = $_POST['lokasi'];
    $catatan = $_POST['catatan'];

    // Checkbox ketentuan
    $layanan = isset($_POST['ketentuan']) && in_array('layanan', $_POST['ketentuan']);
    $imbalan = isset($_POST['ketentuan']) && in_array('imbalan', $_POST['ketentuan']);

    // Validasi input
    $errors = [];

    if (empty($nip)) $errors[] = "NIP tidak boleh kosong.";
    if (empty($nama)) $errors[] = "Nama tidak boleh kosong.";
    if (empty($telepon)) $errors[] = "Nomor telepon tidak boleh kosong.";
    if (empty($lokasi)) $errors[] = "Lokasi tidak boleh kosong.";
    if (empty($catatan)) $errors[] = "Catatan tidak boleh kosong.";

    // Validasi checkbox (harus dua-duanya dicentang)
    if (($layanan && !$imbalan) || (!$layanan && $imbalan)) {
        $errors[] = "Anda harus mencentang kedua kotak persetujuan.";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: pegawai.php");
        exit();
    }

    // Simpan ke database
    $sql = "INSERT INTO pegawai (nip, nama, telepon, lokasi, catatan, layanan, imbalan) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $layananValue = $layanan ? 1 : 0;
        $imbalanValue = $imbalan ? 1 : 0;
        $stmt->bind_param("ssssssi", $nip, $nama, $telepon, $lokasi, $catatan, $layananValue, $imbalanValue);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Data berhasil disimpan. Tetap Jaga Integritas.";
        } else {
            $_SESSION['error'] = "Terjadi kesalahan: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Kesalahan dalam persiapan query.";
    }
    $conn->close();

    header("Location: pegawai.php");
    exit();
} else {
    $_SESSION['error'] = "Metode request tidak valid.";
    header("Location: pegawai.php");
    exit();
}
?>
