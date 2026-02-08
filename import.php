<?php
session_start();
include 'koneksi.php';

// Include PhpSpreadsheet library
require __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Matikan display error untuk mencegah output sebelum header
error_reporting(0);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    $file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (!$file) {
        $_SESSION['import_result'] = [
            'success' => false,
            'message' => "Pilih file Excel terlebih dahulu!"
        ];
        // Pastikan session tersimpan sebelum redirect
        session_write_close();
        header("Location: index_pegawai.php");
        exit;
    }

    if (!in_array($file_ext, ['xlsx', 'xls', 'csv'])) {
        $_SESSION['import_result'] = [
            'success' => false,
            'message' => "Format file tidak valid! Gunakan file Excel (.xlsx / .xls) atau CSV."
        ];
        session_write_close();
        header("Location: index_pegawai.php");
        exit;
    }

    try {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        if (count($rows) <= 1) {
            $_SESSION['import_result'] = [
                'success' => false,
                'message' => "File Excel kosong atau format tidak sesuai!"
            ];
            session_write_close();
            header("Location: index_pegawai.php");
            exit;
        }

        $successData = [];
        $failedData = [];
        $duplicateNIPs = [];

        // Mulai transaksi database untuk memastikan data konsisten
        $conn->begin_transaction();

        // Siapkan prepared statement di luar loop untuk efisiensi
        $stmt_check = $conn->prepare("SELECT id FROM data_pegawai WHERE nip = ?");
        $stmt_insert = $conn->prepare("INSERT INTO data_pegawai (nip, nama, telepon) VALUES (?, ?, ?)");

        for ($i = 1; $i < count($rows); $i++) {
            // Kolom di file Excel (contoh: A=No, B=NIP, C=Nama, D=Telepon)
            $nip = trim($rows[$i][1] ?? ''); // Kolom B
            $nama = trim($rows[$i][2] ?? ''); // Kolom C
            $telepon = trim($rows[$i][3] ?? ''); // Kolom D

            if (empty($nip) || empty($nama)) {
                $failedData[] = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'alasan' => 'Data tidak lengkap'
                ];
                continue; // Lewati baris yang kosong
            }

            // Cek apakah NIP sudah ada di database
            $stmt_check->bind_param("s", $nip);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            
            if ($result->num_rows > 0) {
                // NIP sudah ada, tambahkan ke array duplicateNIPs
                $duplicateNIPs[] = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'alasan' => 'NIP sudah terdaftar'
                ];
                $failedData[] = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'alasan' => 'NIP sudah terdaftar'
                ];
            } else {
                // NIP belum ada, insert data ke database
                $stmt_insert->bind_param("sss", $nip, $nama, $telepon);
                
                if ($stmt_insert->execute()) {
                    // Data berhasil diinsert
                    $successData[] = [
                        'nip' => $nip,
                        'nama' => $nama,
                        'telepon' => $telepon
                    ];
                } else {
                    // Gagal insert
                    $failedData[] = [
                        'nip' => $nip,
                        'nama' => $nama,
                        'alasan' => 'Gagal menyimpan data ke database: ' . $conn->error
                    ];
                }
            }
        }
        
        $stmt_check->close();
        $stmt_insert->close();
        
        // Commit transaksi
        $conn->commit();

        // Simpan hasil ke session
        $_SESSION['import_result'] = [
            'success' => true,
            'success_count' => count($successData),
            'failed_count' => count($failedData),
            'success_data' => $successData,
            'failed_data' => $failedData,
            'duplicate_nips' => $duplicateNIPs
        ];
        
        // Pastikan session tersimpan sebelum redirect
        session_write_close();
        header("Location: index_pegawai.php");
        exit;
    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        if (isset($conn) && method_exists($conn, 'rollback')) {
            $conn->rollback();
        }
        
        $_SESSION['import_result'] = [
            'success' => false,
            'message' => "Terjadi kesalahan saat membaca file Excel: " . $e->getMessage()
        ];
        
        // Pastikan session tersimpan sebelum redirect
        session_write_close();
        header("Location: index_pegawai.php");
        exit;
    }
} else {
    $_SESSION['import_result'] = [
        'success' => false,
        'message' => "Akses tidak diizinkan!"
    ];
    session_write_close();
    header("Location: index_pegawai.php");
    exit;
}
?>