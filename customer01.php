<?php
session_start();
if ($_SESSION['role'] !== 'customer') {
    header("Location: index.php");
    exit();
}
// ... Konten halaman atasan
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Customer - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="image/bcl.ico">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- SweetAlert2 -->
<script src="portal/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Link to Bootstrap Icons -->
    
    <!-- Additional script sources -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css">  

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
                    <!-- <form action="action_customer.php" method="post"> -->
                    <!-- <form action="action_customer.php" method="post" onsubmit="return validateForm()"> -->
                    <!-- <form id="customer-form" action="action_customer.php" method="post" onsubmit="return validateForm()"> -->
                    <form id="customer-form" action="action_customer.php" method="post">
                        <div class="form-group">
                            <label for="user">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="user" name="nama">
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Nama Perusahaan:</label>
                            <select class="form-control" id="lokasi" name="lokasi">
                                <option value="" disabled selected>Pilih Perusahaan</option>
                                <?php
                                include 'koneksi.php';
                                $sql = "SELECT id, lokasi FROM data_perusahaan";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>Tidak ada perusahaan tersedia</option>";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="telepon">No. Telepon:</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>

                        <div class="form-group">
                            <label for="pegawai">Pegawai yang dinilai:</label>
                            <select class="form-control" id="pegawai" name="pegawai">
                                <option value="" disabled selected>Pilih Pegawai</option>
                                <?php
                                // Include your database connection code from 'koneksi.php'
                                include 'koneksi.php';

                                // Ambil waktu saat ini dikurangi 24 jam
                                $twentyFourHoursAgo = date('Y-m-d H:i:s', strtotime('-12 hours'));

                                // Query untuk mengambil data pegawai dari tabel jagain.pegawai dengan waktu rekam maksimal 24 jam
                                $sql = "SELECT id, nip, nama FROM pegawai WHERE waktu_rekam >= '$twentyFourHoursAgo'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . " (" . $row['nip'] . ")" . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>Tidak ada pegawai tersedia dalam 24 jam terakhir</option>";
                                }

                                // Close the database connection
                                $conn->close();
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
                            <label class="form-check-label" for "check2">
                                <input type="checkbox" class="form-check-input" id="check2" name="ketentuan[]" value="imbalan"> 
                                <small>Tidak memberi imbalan dalam bentuk apapun kepada Pegawai yang Bertugas.</small>
                            </label>
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" id="login-btn">REKAM</button>
                        <!-- ... Bagian form lainnya ... -->
                    </form><br>
                </div>                
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="../bcljagain/image/jagain.jpeg" alt="">
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    
    <link src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></link>
    <script src="js/scripts.js"></script>




    <script>
  $(document).ready(function() {
    $('#login-form').submit(function(event) {
      event.preventDefault(); // Hindari form melakukan aksi default (submit)
      $.ajax({
        type: 'POST',
        url: 'action_customer.php',
        data: $('#customer-form').serialize(),
        success: function(response) {
          if (response.includes('error')) {
            toastr.error('Gagal melakukan input. Silakan coba lagi.');
          } else {
            toastr.success('Terima Kasih sudah memberikan Respon');
            setTimeout(function(){
              window.location.href = response;
            }, 2000); // Pengalihan halaman setelah 2 detik
          }
        },
        error: function() {
          toastr.error('Terjadi kesalahan saat memproses input.');
        }
      });
    });
  });
</script>
    <!-- Script lainnya... -->
</body>

</html>


<!-- Jangan lupa tambahkan sumber toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>
    $(document).ready(function() {
        $('#customer-form').submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'action_customer.php',
                data: formData,
                success: function(response) {
                    if (response.includes('error')) {
                        toastr.error('Gagal input. Data tidak diisi lengkap');
                    } else {
                        toastr.success('Input Berhasil');
                        setTimeout(function() {
                            window.location.href = 'customer.php'; // Ganti dengan halaman yang sesuai
                        }, 1000);
                    }
                },
                error: function() {
                    toastr.error('Terjadi kesalahan saat memproses input.');
                }
            });
        });
    });
    </script>


</body>
</html>
