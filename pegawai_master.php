<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="image/bcl.ico">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Link to Bootstrap Icons -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />  
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
            <input type="text" class="form-control" id="id_user" name="nip" onkeyup="getEmployeeName(this.value)">
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
                        <br>
                        <button type="submit" class="btn btn-primary">REKAM</button>
                        <!-- ... Bagian form lainnya ... -->

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

    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script> -->

    <script src="vendor/jquery/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        function getEmployeeName(nip) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_employee_name.php?nip=' + nip, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (xhr.getResponseHeader("content-type").includes("application/json")) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                document.getElementById('user').value = response.nama;
                            } else {
                                document.getElementById('user').value = '';
                            }
                        } catch (e) {
                            console.error("Error parsing JSON: " + e);
                        }
                    } else {
                        console.error("Response is not in JSON format");
                    }
                }
            };

            xhr.send();
        }
    </script>
</body>
</html>
