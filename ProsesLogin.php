<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error: " . $conn->error); // Cek kesalahan saat menyiapkan statement
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            switch ($_SESSION['role']) {
                case 'admin':
                    echo "admin.php"; // Ubah ini sesuai dengan URL ke halaman admin
                    break;
                case 'customer':
                    echo "customer.php"; // Ubah ini sesuai dengan URL ke halaman customer
                    break;
                case 'pegawai':
                    echo "pegawai.php"; // Ubah ini sesuai dengan URL ke halaman pegawai
                    break;
                case 'atasan':
                    echo "atasan.php"; // Ubah ini sesuai dengan URL ke halaman atasan
                    break;
                default:
                    echo "home.php"; // Kembali ke halaman login jika rolenya tidak dikenali
            }
        } else {
            echo "error"; // Mengembalikan pesan error
        }
    } else {
        echo "error"; // Mengembalikan pesan error
    }
}
?>
