<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome !!!</h1>
                                    </div>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" aria-describedby="username" placeholder="Masukkan Username..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="button" id="loginButton">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.getElementById('loginButton').addEventListener('click', function () {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Gantilah 'your_username' dan 'your_password' dengan logika validasi sesuai dengan database.
            // Anda dapat menggunakan AJAX untuk mengirim permintaan ke sisi server dan memeriksa kredensial pengguna.

            // Contoh sederhana: periksa apakah username adalah 'admin' dan password adalah 'admin123'
            if (username === 'admin' && password === 'admin123') {
                // Login success, redirect to the appropriate page
                Swal.fire({
                    icon: 'success',
                    title: 'Login Success',
                    showConfirmButton: false,
                    timer: 1500 // Redirect after 1.5 seconds
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php";
                }, 1500);
            } else {
                // Login failure, show an error message
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Please make sure your username and password are correct.',
                    confirmButtonColor: '#3085d6',
                    iconColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>
</html>
