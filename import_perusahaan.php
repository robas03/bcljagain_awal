<?php
session_start();
include 'koneksi.php';

// Include PhpSpreadsheet library
require '../bcljagain/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name']; // Sesuai dengan name="file" di form
    $file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (!$file) {
        $_SESSION['status'] = "warning";
        $_SESSION['message'] = "Pilih file Excel terlebih dahulu!";
        header("Location: perusahaan.php");
        exit;
    }

    // Validasi file harus .xlsx atau .xls
    if (!in_array($file_ext, ['xlsx', 'xls'])) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Format file tidak valid! Gunakan file Excel (.xlsx / .xls).";
        header("Location: perusahaan.php");
        exit;
    }

    // Load file Excel
    try {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray(); // Konversi ke array

        // Validasi apakah ada data
        if (count($rows) <= 1) {
            $_SESSION['status'] = "warning";
            $_SESSION['message'] = "File Excel kosong atau format tidak sesuai!";
            header("Location: perusahaan.php");
            exit;
        }

        $imported = 0; // Jumlah data yang berhasil diimport
        $failed = 0; // Jumlah data yang gagal diimport
        $failed_list = []; // List nama perusahaan yang gagal diimport

        // Loop untuk membaca data dari baris kedua (indeks 1)
        for ($i = 1; $i < count($rows); $i++) {
            $nama = trim($rows[$i][1]); // Kolom B (Nama Perusahaan)
            $lokasi = trim($rows[$i][2]); // Kolom C (Lokasi Perusahaan)

            // Cek jika nama dan lokasi tidak kosong
            if (!empty($nama) && !empty($lokasi)) {
                // Cek apakah data sudah ada di database
                $stmt_check = $conn->prepare("SELECT COUNT(*) FROM data_perusahaan WHERE nama = ?");
                $stmt_check->bind_param("s", $nama);
                $stmt_check->execute();
                $stmt_check->bind_result($count);
                $stmt_check->fetch();
                $stmt_check->close();

                if ($count == 0) {
                    // Jika belum ada, maka insert data baru
                    $stmt = $conn->prepare("INSERT INTO data_perusahaan (nama, lokasi) VALUES (?, ?)");
                    $stmt->bind_param("ss", $nama, $lokasi);
                    if ($stmt->execute()) {
                        $imported++;
                    }
                    $stmt->close();
                } else {
                    // Jika sudah ada, data dianggap gagal diimport
                    $failed++;
                    $failed_list[] = $nama;
                }
            }
        }

        // Format pesan hasil import
        $message = "Import selesai!<br>";
        if ($imported > 0) {
            $message .= "✔ $imported perusahaan berhasil diimport.<br>";
        }
        if ($failed > 0) {
            $message .= "❌ $failed perusahaan gagal diimport karena sudah ada di database.<br>";
            $message .= "Daftar yang gagal:<br>• " . implode("<br>• ", $failed_list);
        }

        $_SESSION['status'] = "success";
        $_SESSION['message'] = $message;
        header("Location: perusahaan.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Terjadi kesalahan saat membaca file Excel. Pastikan format benar!";
        header("Location: perusahaan.php");
        exit;
    }
} else {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "Akses tidak diizinkan!";
    header("Location: perusahaan.php");
    exit;
}
?>
