<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Hapus Pegawai - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="display-4">Hapus Pegawai</h1>
        <?php
        include 'koneksi.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM data_pegawai WHERE id = ?";
            $stmt = $connection->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
            }

            if (isset($_POST['delete'])) {
                $sql = "DELETE FROM data_pegawai WHERE id = ?";
                $stmt = $connection->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: index_pegawai.php");
                }
            }
        }
        ?>

        <p>Apakah Anda yakin ingin menghapus pegawai ini?</p>
        <p>NIP: <?php echo $row['nip']; ?></p>
        <p>Nama Lengkap: <?php echo $row['nama']; ?></p>

        <form action="" method="post">
            <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
