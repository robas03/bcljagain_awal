<?php
session_start();
require_once "koneksi.php"; // file koneksi ke database

$message = "";
$message_type = "";
$redirect_url = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query user dari database
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            $message = "Login berhasil!";
            $message_type = "success";

            // Redirect sesuai role
            switch ($row['role']) {
                case 'admin': $redirect_url = "admin.php"; break;
                case 'pegawai': $redirect_url = "pegawai.php"; break;
                case 'customer': $redirect_url = "customer.php"; break;
                case 'atasan': $redirect_url = "atasan.php"; break;
                default: $redirect_url = "home.php"; break;
            }
        } else {
            $message = "Password salah!";
            $message_type = "error";
        }
    } else {
        $message = "Username tidak ditemukan!";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {min-height:100vh;display:flex;align-items:center;justify-content:center;padding:15px;}
        .login-card {background:rgba(255,255,255,0.95);border-radius:20px;box-shadow:0 15px 35px rgba(0,0,0,0.1);max-width:400px;width:100%;}
        .login-header {background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;text-align:center;padding:30px 20px;}
        .login-header h3 {margin:0;font-weight:300;font-size:1.8rem;}
        .login-body {padding:30px;}
        .form-floating {margin-bottom:20px;}
        .form-control {border-radius:10px;}
        .btn-login {background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border:none;border-radius:10px;padding:12px;font-weight:500;text-transform:uppercase;}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="bi bi-shield-lock fs-1 mb-2"></i>
                <h3>Sistem Login</h3>
                <div class="subtitle">Masuk ke akun Anda</div>
            </div>
            <div class="login-body">
                <form method="POST" id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-login w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </button>
                </form>
                <hr class="my-4">
                <div class="text-center">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i> Hubungi administrator jika mengalami kesulitan
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($message)): ?>
    <script>
        Swal.fire({
            icon: '<?= $message_type ?>',
            title: '<?= ($message_type == "success") ? "Berhasil!" : "Login Gagal!" ?>',
            text: '<?= $message ?>',
            <?php if ($message_type == "success"): ?>
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            <?php else: ?>
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#667eea'
            <?php endif; ?>
        }).then(() => {
            <?php if ($message_type == "success"): ?>
                window.location.href = "<?= $redirect_url ?>";
            <?php endif; ?>
        });
    </script>
    <?php endif; ?>
</body>
</html>
