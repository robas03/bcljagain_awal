<?php
// Sertakan berkas koneksi ke database Anda
include 'koneksi.php';

// Periksa apakah NIP telah diterima dari permintaan GET
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Lindungi dari SQL Injection (gunakan parameter yang aman)
    $query = $conn->prepare("SELECT nama FROM data_pegawai WHERE nip = ?");
    $query->bind_param("s", $nip);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        // Ambil nama dari hasil query
        $query->bind_result($nama);
        $query->fetch();

        $response = array('success' => true, 'nama' => $nama);
    } else {
        $response = array('success' => false);
    }

    // Keluarkan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Jika NIP tidak diterima, keluarkan respons kesalahan
    $response = array('success' => false);
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Tutup koneksi database
$conn->close();
?>
