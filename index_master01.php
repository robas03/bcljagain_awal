<?php
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Lakukan otentikasi
    if (otentikasi_sukses($username, $password)) {
        $role = tentukan_peran($username); // Tentukan peran berdasarkan user
        $_SESSION['role'] = $role;
        $_SESSION['username'] = $username;

        // Redirect ke halaman yang sesuai dengan peran
        switch ($role) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'pegawai':
                header("Location: pegawai.php");
                break;
            case 'customer':
                header("Location: customer.php");
                break;
            case 'atasan':
                header("Location: atasan.php");
                break;
            default:
                header("Location: home.php"); // Halaman default setelah login
        }
        exit();
    } else {
        echo "Gagal login. Silakan coba lagi.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Beacukai Luwuk</b><br>Jaga Integritas</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login dulu yaa</p>

      <form id="login-form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!-- <button id="login-btn" type="button" class="btn btn-primary btn-block">Sign In</button> -->
            <!-- Ganti bagian tombol Sign In -->
              <input type="submit" class="btn btn-primary btn-block" value="Login" id="login-btn"></input> 

          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="adminlte/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
  $('#login-btn').click(function() {
    $.ajax({
      type: 'POST',
      url: 'ProsesLogin.php',
      data: $('#login-form').serialize(),
      success: function(response) {
        if (response === 'error') {
          toastr.error('Login Gagal');
        } else {
          toastr.success('Login Berhasil');
          window.location.href = response;
        }
      },
      error: function() {
        toastr.error('Terjadi kesalahan');
      }
    });
  });
});
</script>
</body>
</html>
