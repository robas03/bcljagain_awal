<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama perusahaan sebelum menghapus
    $stmt_select = $conn->prepare("SELECT nama FROM data_perusahaan WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $stmt_select->bind_result($nama);
    $stmt_select->fetch();
    $stmt_select->close();

    if ($nama) { // Jika data ditemukan
        // Hapus perusahaan
        $stmt_delete = $conn->prepare("DELETE FROM data_perusahaan WHERE id = ?");
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Perusahaan <b>$nama</b> berhasil dihapus!";
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Gagal menghapus perusahaan <b>$nama</b>.";
        }

        $stmt_delete->close();
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Perusahaan tidak ditemukan!";
    }

    $conn->close();
}

header("Location: perusahaan.php");
exit;
?>
