<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tambah Pegawai - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="display-4">Tambah Pegawai</h1>
        <form action="create.php" method="post">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP :</label>
                <input type="text" class="form-control" id="nip" name="nip">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap :</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];

    $sql = "INSERT INTO data_pegawai (nip, nama) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $nip, $nama);
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Kesalahan persiapan pernyataan SQL.');</script>";
    }

    $connection->close();
}
?>
