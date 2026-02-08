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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
        <a class="navbar-brand">
    <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="25" height="25">
    BCL JAGAIN
        </a>

            <!-- <a class a="navbar-brand" >BCL JAGAIN</a> -->
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                Navbar links can be added here
            </div> -->
        </div>
    </nav>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="../bcljagain/image/jagain.jpeg" alt="">
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">Pernyataan Integritas Pegawai</h1>
                    <div class="fs-5 mb-5">
                        <span>KPPBC TMP C Luwuk</span><br>
                        <span>Beacukai Luwuk Jaga Integritas</span>
                    </div>

                    <form action="action.php" method="post">
                        <div class="form-group">
                            <label for="id_user">NIP :</label>
                            <input type="text" class="form-control" id="id_user" name="nip">
                        </div>

                        <div class="form-group">
                            <label for="user">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="user" name="nama">
                        </div>

                        <div class="form-group">
                            <label for="telepon">No. Telepon :</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Pemeriksaan :</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan :</label>
                            <textarea class="form-control" rows="5" id="catatan" name="catatan"></textarea>
                        </div>
                        <br>

                        <p class="lead">Saya bersedia:</p>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check1">
                                <input type="checkbox" class="form-check-input" id="check1" name="ketentuan[]" value="layanan"> 
                                <small>Memberikan layanan sesuai dengan ketentuan yang berlaku;</small>
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check2">
                                <input type="checkbox" class="form-check-input" id="check2" name="ketentuan[]" value="imbalan"> 
                                <small>Tidak menerima imbalan dalam bentuk apapun.</small>
                            </label>
                        </div>
                        <br>
                        <!-- <p class="small">* Dengan submit ini, saya menyetujui ketentuan pakta integritas transaksional yang berlaku</p> -->
                        <br>
                        <button type="submit" class="btn btn-primary">REKAM</button>
                    </form>
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


</body>




</html>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
        <a class="navbar-brand">
    <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="25" height="25">
    BCL JAGAIN
        </a>

            <!-- <a class a="navbar-brand" >BCL JAGAIN</a> -->
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                Navbar links can be added here
            </div> -->
        </div>
    </nav>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="../bcljagain/image/jagain.jpeg" alt="">
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">Pernyataan Integritas Pegawai</h1>
                    <div class="fs-5 mb-5">
                        <span>KPPBC TMP C Luwuk</span><br>
                        <span>Beacukai Luwuk Jaga Integritas</span>
                    </div>

                    <form action="action.php" method="post">
                        <div class="form-group">
                            <label for="id_user">NIP :</label>
                            <input type="text" class="form-control" id="id_user" name="nip">
                        </div>

                        <div class="form-group">
                            <label for="user">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="user" name="nama">
                        </div>

                        <div class="form-group">
                            <label for="telepon">No. Telepon :</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Pemeriksaan :</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan :</label>
                            <textarea class="form-control" rows="5" id="catatan" name="catatan"></textarea>
                        </div>
                        <br>

                        <p class="lead">Saya bersedia:</p>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check1">
                                <input type="checkbox" class="form-check-input" id="check1" name="ketentuan[]" value="layanan"> 
                                <small>Memberikan layanan sesuai dengan ketentuan yang berlaku;</small>
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check2">
                                <input type="checkbox" class="form-check-input" id="check2" name="ketentuan[]" value="imbalan"> 
                                <small>Tidak menerima imbalan dalam bentuk apapun.</small>
                            </label>
                        </div>
                        <br>
                        <!-- <p class="small">* Dengan submit ini, saya menyetujui ketentuan pakta integritas transaksional yang berlaku</p> -->
                        <br>
                        <button type="submit" class="btn btn-primary">REKAM</button>
                    </form>
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


</body>




</html>
