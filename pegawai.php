<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pegawai') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="image/bcl.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#">
            <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="25" height="25">
            BCL JAGAIN
        </a>
        <div class="ms-auto d-flex gap-2">
            <!-- <a href="admin.php" class="btn btn-primary">Kembali</a> -->
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="../bcljagain/image/jagain.jpeg" alt="Jaga Integritas">
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">Pernyataan Integritas Pegawai</h1>
                <div class="fs-5 mb-5">
                    <span>KPPBC TMP C Luwuk</span><br>
                    <span>Beacukai Luwuk Jaga Integritas</span>
                </div>

                <form action="action.php" method="post">
                    <div class="form-group">
                        <label for="nip">NIP :</label>
                        <input type="text" class="form-control" id="nip" name="nip" onkeyup="getEmployeeName(this.value)" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap :</label>
                        <input type="text" class="form-control" id="nama" name="nama" readonly>
                    </div>

<div class="form-group">
    <label for="telepon">No. Telepon :</label>
    <input type="text" class="form-control" id="telepon" name="telepon" required onkeypress="return hanyaAngka(event)">
</div>

<script>
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        return false; // Mencegah input selain angka
    }
    return true;
}
</script>


                    <div class="form-group">
                        <label>Lokasi Pemeriksaan:</label>
                        <select class="form-control select2" id="lokasi" name="lokasi" required>
                            <?php
                            $sql = "SELECT * FROM bear7685_jagain.data_perusahaan";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['nama']) . "'>" . htmlspecialchars($row['nama']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada perusahaan tersedia</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan :</label>
                        <textarea class="form-control" rows="5" id="catatan" name="catatan" required></textarea>
                    </div>

                    <p class="lead">Saya bersedia:</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="layanan" name="ketentuan[]" value="layanan" required>
                        <label class="form-check-label" for="layanan">Memberikan layanan sesuai ketentuan.</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="imbalan" name="ketentuan[]" value="imbalan" required>
                        <label class="form-check-label" for="imbalan">Tidak menerima imbalan dalam bentuk apapun.</label>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary btn-block">REKAM</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function getEmployeeName(nip) {
    $.get("get_employee_name.php", { nip: nip }, function(response) {
        if (response.success) {
            $("#nama").val(response.nama);
        } else {
            $("#nama").val('');
        }
    }, "json");
}
</script>

<?php
if (isset($_SESSION['success'])) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '" . $_SESSION['success'] . "'
            });
          </script>";
    unset($_SESSION['success']); // Hapus session setelah ditampilkan
}

if (isset($_SESSION['error'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '" . $_SESSION['error'] . "'
            });
          </script>";
    unset($_SESSION['error']); // Hapus session setelah ditampilkan
}
?>


</body>
</html>
