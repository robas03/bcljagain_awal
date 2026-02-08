<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Template - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand">
                <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="25" height="25">
                BCL JAGAIN
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="display-4">Tambah Pegawai</h1>
        <form action="create_pegawai.php" method="post">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP :</label>
                <input type="text" class="form-control" id="nip" name="nip">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap :</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            
            <button type="button" class="btn btn-secondary" onclick="history.back()">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Include your database conn code from 'koneksi.php'
        include 'koneksi.php';

        $nip = $_POST['nip'];
        $nama = $_POST['nama'];

        $sql = "INSERT INTO data_pegawai (nip, nama) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $nip, $nama);
            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index_pegawai.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Kesalahan persiapan pernyataan SQL.');</script>";
        }

        // Close the database conn
        $conn->close();
    }
    ?>
    <!-- Bagian konten spesifik untuk setiap halaman akan dimasukkan di sini -->

    <!-- <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Beacukai Luwuk 2023</p>
        </div>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
