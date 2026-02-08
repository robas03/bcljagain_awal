<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="css/toastr/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
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
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">Pernyataan Integritas Pengguna Jasa</h1>
                    <div class="fs-5 mb-5">
                        <span>KPPBC TMP C Luwuk</span><br>
                        <span>Pengguna Jasa Luwuk Jaga Integritas</span>
                    </div>
                    <form action="action.php" method="post">
                        <div class="form-group">
                            <label for="user">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="user" name="nama">
                        </div>
                        <div class="form-group">
    <label for="perusahaan">Nama Perusahaan:</label>
    <select class="form-control" id="perusahaan" name="perusahaan">
        <option value="" disabled selected>Pilih Perusahaan</option>
        <?php
        // Include your database connection code from 'koneksi.php'
        include 'koneksi.php';

        // Query untuk mengambil data perusahaan
        $sql = "SELECT id, lokasi FROM data_perusahaan";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['lokasi'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>Tidak ada perusahaan tersedia</option>";
        }

        // Close the database connection
        $connection->close();
        ?>
    </select>
</div>

                        <div class="form-group">
                            <label for="telepon">No. Telepon:</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>

                        <div class "form-group">
    <label for="pegawai">Pegawai:</label>
    <select class="form-control" id="pegawai" name="pegawai">
        <option value="" disabled selected>Pilih Pegawai</option>
        <?php
        // Include your database connection code from 'koneksi.php'
        include 'koneksi.php';

        // Ambil waktu saat ini dikurangi 24 jam
        $twentyFourHoursAgo = date('Y-m-d H:i:s', strtotime('-24 hours'));

        // Query untuk mengambil data pegawai dari tabel jagain.pegawai dengan waktu rekam maksimal 24 jam
        $sql = "SELECT id, nip, nama FROM pegawai WHERE waktu_rekam >= '$twentyFourHoursAgo'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . " (" . $row['nip'] . ")" . "</option>";
            }
        } else {
            echo "<option value='' disabled>Tidak ada pegawai tersedia dalam 24 jam terakhir</option>";
        }

        // Close the database connection
        $connection->close();
        ?>
    </select>
</div>


                        <div class="form-group">
                            <label for="nilai">Penilaian:</label>
                            <select class="form-control" id="nilai" name="nilai">
                                <option value="" disabled selected>Pilih Penilaian</option>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>
                        <br>

                        <p class="lead">Saya bersedia:</p>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check1">
                                <input type="checkbox" class="form-check-input" id="check1" name="ketentuan[]" value="layanan"> 
                                <small>Mentaati Peraturan dan Ketentuan yang berlaku;</small>
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check2">
                                <input type="checkbox" class="form-check-input" id="check2" name="ketentuan[]" value="imbalan"> 
                                <small>Tidak memberi imbalan dalam bentuk apapun kepada Pegawai yang Bertugas.</small>
                            </label>
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">REKAM</button>
                        <!-- ... Bagian form lainnya ... -->
                    </form>
                </div>
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="../bcljagain/image/jagain.jpeg" alt="">
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Beacukai Luwuk 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

    <script>
        function getEmployeeName(nip) {
            // Buat permintaan AJAX untuk mengambil nama pegawai berdasarkan NIP
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_employee_name.php?nip=' + nip, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Parsing data JSON yang diterima dari server
                    var response = JSON.parse(xhr.responseText);

                    // Periksa apakah permintaan berhasil dan nama ditemukan
                    if (response.success) {
                        document.getElementById('user').value = response.nama;
                    } else {
                        document.getElementById('user').value = '';
                    }
                }
            };

            xhr.send();
        }
    </script>
</body>
</html>
