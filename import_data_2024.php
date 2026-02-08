<?php
// Pastikan semua error ditampilkan saat pengembangan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Sertakan file koneksi database
include 'koneksi.php';

// PENTING: Pindahkan semua pernyataan 'use' ke bagian atas skrip
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

// Pastikan koneksi database berhasil
if (!isset($conn) || $conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Fungsi untuk log error
function logError($message) {
    $logFile = 'import_errors.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi file upload lebih awal untuk menghindari error
    if (!isset($_FILES["importFile"]) || $_FILES["importFile"]["error"] !== 0) {
        $errorCode = $_FILES["importFile"]["error"] ?? "unknown";
        $errorMessage = match($errorCode) {
            UPLOAD_ERR_INI_SIZE => "Ukuran file melebihi batas maksimum.",
            UPLOAD_ERR_FORM_SIZE => "Ukuran file melebihi batas yang ditentukan form.",
            UPLOAD_ERR_PARTIAL => "File hanya terupload sebagian.",
            UPLOAD_ERR_NO_FILE => "Tidak ada file yang diupload.",
            UPLOAD_ERR_NO_TMP_DIR => "Folder temporary tidak tersedia.",
            UPLOAD_ERR_CANT_WRITE => "Gagal menulis file ke disk.",
            UPLOAD_ERR_EXTENSION => "Upload file dihentikan oleh ekstensi.",
            default => "Terjadi kesalahan saat mengunggah file. Kode error: " . $errorCode,
        };
        die("Error: " . $errorMessage);
    }

    $fileName = $_FILES["importFile"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $tmpName = $_FILES["importFile"]["tmp_name"];
    $fileSize = $_FILES["importFile"]["size"];

    // Validasi ukuran file (maksimal 5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        die("Error: Ukuran file terlalu besar. Maksimal 5MB.");
    }

    // Validasi tipe file
    $allowedTypes = ["xlsx", "xls", "csv"];
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die("Error: Hanya file Excel (.xlsx, .xls) dan CSV (.csv) yang diperbolehkan.");
    }

    // Gunakan transaksi untuk memastikan operasi atomik
    $conn->begin_transaction();

    try {
        // Hapus data jika dicentang
        if (isset($_POST["truncateTable"]) && $_POST["truncateTable"] == "on") {
            $conn->query("SET FOREIGN_KEY_CHECKS=0");
            $conn->query("TRUNCATE TABLE customer2024");
            $conn->query("TRUNCATE TABLE pegawai2024");
            $conn->query("SET FOREIGN_KEY_CHECKS=1");
            logError("Data berhasil dihapus sebelum import");
        }

        $successCount = 0;
        $errorCount = 0;

        // Proses file berdasarkan tipe
        if (strtolower($fileType) == "csv") {
            // Memproses file CSV
            if (($file = fopen($tmpName, "r")) !== FALSE) {
                // Lewati baris header jika ada
                $header = fgetcsv($file);
                
                // Prepared statement untuk INSERT data pegawai2024
                $stmt_pegawai = $conn->prepare("INSERT INTO pegawai2024 (nip, nama, telepon, lokasi, catatan, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt_pegawai) {
                    throw new Exception("Error preparing pegawai statement: " . $conn->error);
                }
                $stmt_pegawai->bind_param("sssssiss", $nip, $nama_pegawai, $telepon_pegawai, $lokasi_pegawai, $catatan_pegawai, $layanan_pegawai, $imbalan_pegawai, $waktu_rekam_pegawai);

                // Prepared statement untuk INSERT data customer2024
                $stmt_customer = $conn->prepare("INSERT INTO customer2024 (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt_customer) {
                    throw new Exception("Error preparing customer statement: " . $conn->error);
                }
                $stmt_customer->bind_param("sssiisiss", $nama_customer, $lokasi_id, $telepon_customer, $pegawai_id, $nilai_customer, $respon_customer, $layanan_customer, $imbalan_customer, $waktu_rekam_customer);

                $rowNum = 1; // Mulai dari baris ke-2 (setelah header)
                while (($row = fgetcsv($file)) !== FALSE) {
                    $rowNum++;
                    
                    // Validasi jumlah kolom minimal
                    if (count($row) < 8) {
                        logError("Baris $rowNum: Jumlah kolom tidak mencukupi (" . count($row) . " kolom)");
                        $errorCount++;
                        continue;
                    }

                    // Isi variabel untuk prepared statement pegawai2024
                    $nip = trim($row[0] ?? '');
                    $nama_pegawai = trim($row[1] ?? '');
                    $telepon_pegawai = trim($row[2] ?? '');
                    $lokasi_pegawai = trim($row[3] ?? '');
                    $catatan_pegawai = trim($row[4] ?? '');
                    $layanan_pegawai = (int)($row[5] ?? 0);
                    $imbalan_pegawai = (int)($row[6] ?? 0);
                    
                    // Validasi data wajib
                    if (empty($nip)) {
                        logError("Baris $rowNum: NIP kosong");
                        $errorCount++;
                        continue;
                    }
                    
                    if (empty($nama_pegawai)) {
                        logError("Baris $rowNum: Nama pegawai kosong");
                        $errorCount++;
                        continue;
                    }
                    
                    // Proses waktu rekam
                    if (!empty($row[7])) {
                        $timestamp = strtotime($row[7]);
                        if ($timestamp === false) {
                            logError("Baris $rowNum: Format waktu tidak valid, menggunakan waktu sekarang");
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                        } else {
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s', $timestamp);
                        }
                    } else {
                        $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                    }

                    if ($stmt_pegawai->execute()) {
                        $pegawai_id = $conn->insert_id;
                        $successCount++;

                        // Jika ada data customer2024, masukkan
                        if (count($row) >= 16 && !empty(trim($row[8] ?? ''))) {
                            $nama_customer = trim($row[8] ?? '');
                            $lokasi_id = (int)($row[9] ?? 0);
                            $telepon_customer = trim($row[10] ?? '');
                            $nilai_customer = trim($row[11] ?? '');
                            $respon_customer = trim($row[12] ?? '');
                            $layanan_customer = (int)($row[13] ?? 0);
                            $imbalan_customer = (int)($row[14] ?? 0);
                            
                            // Validasi data customer wajib
                            if (empty($nama_customer)) {
                                logError("Baris $rowNum: Nama customer kosong");
                                continue;
                            }
                            
                            // Proses waktu rekam customer
                            if (!empty($row[15])) {
                                $timestamp = strtotime($row[15]);
                                if ($timestamp === false) {
                                    logError("Baris $rowNum: Format waktu customer tidak valid, menggunakan waktu sekarang");
                                    $waktu_rekam_customer = date('Y-m-d H:i:s');
                                } else {
                                    $waktu_rekam_customer = date('Y-m-d H:i:s', $timestamp);
                                }
                            } else {
                                $waktu_rekam_customer = date('Y-m-d H:i:s');
                            }

                            // Validasi nilai customer
                            $nilai_customer = (int)$nilai_customer;
                            if ($nilai_customer < 1 || $nilai_customer > 10) {
                                logError("Baris $rowNum: Nilai customer tidak valid (1-10), menggunakan nilai default 5");
                                $nilai_customer = 5;
                            }

                            if (!$stmt_customer->execute()) {
                                logError("Baris $rowNum: Error saat memasukkan data customer: " . $stmt_customer->error);
                            }
                        }
                    } else {
                        logError("Baris $rowNum: Error saat memasukkan data pegawai: " . $stmt_pegawai->error);
                        $errorCount++;
                    }
                }

                $stmt_pegawai->close();
                $stmt_customer->close();
                fclose($file);

            } else {
                throw new Exception("Tidak dapat membuka file CSV.");
            }
        } else {
            // Memproses file Excel
            try {
                $spreadsheet = IOFactory::load($tmpName);
                $worksheet = $spreadsheet->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();

                // Prepared statement untuk pegawai2024
                $stmt_pegawai = $conn->prepare("INSERT INTO pegawai2024 (nip, nama, telepon, lokasi, catatan, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt_pegawai) {
                    throw new Exception("Error preparing pegawai statement: " . $conn->error);
                }
                $stmt_pegawai->bind_param("sssssiss", $nip, $nama_pegawai, $telepon_pegawai, $lokasi_pegawai, $catatan_pegawai, $layanan_pegawai, $imbalan_pegawai, $waktu_rekam_pegawai);

                // Prepared statement untuk customer2024
                $stmt_customer = $conn->prepare("INSERT INTO customer2024 (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt_customer) {
                    throw new Exception("Error preparing customer statement: " . $conn->error);
                }
                $stmt_customer->bind_param("sssiisiss", $nama_customer, $lokasi_id, $telepon_customer, $pegawai_id, $nilai_customer, $respon_customer, $layanan_customer, $imbalan_customer, $waktu_rekam_customer);

                for ($row = 2; $row <= $highestRow; $row++) {
                    // Pastikan baris memiliki data
                    $cellValue = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    if (empty($cellValue)) {
                        continue; // Lewati baris kosong
                    }

                    // Ambil data pegawai2024
                    $nip = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama_pegawai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $telepon_pegawai = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $lokasi_pegawai = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $catatan_pegawai = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $layanan_pegawai = (int)($worksheet->getCellByColumnAndRow(6, $row)->getValue() ?? 0);
                    $imbalan_pegawai = (int)($worksheet->getCellByColumnAndRow(7, $row)->getValue() ?? 0);
                    $waktu_rekam_pegawai_excel = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                    // Validasi data wajib
                    if (empty($nip)) {
                        logError("Baris $row: NIP kosong");
                        $errorCount++;
                        continue;
                    }
                    
                    if (empty($nama_pegawai)) {
                        logError("Baris $row: Nama pegawai kosong");
                        $errorCount++;
                        continue;
                    }

                    // Proses waktu rekam
                    if (is_numeric($waktu_rekam_pegawai_excel) && $waktu_rekam_pegawai_excel > 25569) {
                        // Format tanggal Excel (timestamp dimulai dari 1 Januari 1900)
                        try {
                            $waktu_rekam_pegawai = Date::excelToDateTimeObject($waktu_rekam_pegawai_excel)->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            logError("Baris $row: Error konversi waktu Excel: " . $e->getMessage() . ", menggunakan waktu sekarang");
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                        }
                    } elseif (!empty($waktu_rekam_pegawai_excel)) {
                        // Format string tanggal
                        $timestamp = strtotime($waktu_rekam_pegawai_excel);
                        if ($timestamp === false) {
                            logError("Baris $row: Format waktu tidak valid, menggunakan waktu sekarang");
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                        } else {
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s', $timestamp);
                        }
                    } else {
                        $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                    }

                    if ($stmt_pegawai->execute()) {
                        $pegawai_id = $conn->insert_id;
                        $successCount++;

                        // Ambil data customer2024 jika ada
                        $nama_customer = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        if (!empty($nama_customer)) {
                            $lokasi_id = (int)($worksheet->getCellByColumnAndRow(10, $row)->getValue() ?? 0);
                            $telepon_customer = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                            $nilai_customer = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                            $respon_customer = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                            $layanan_customer = (int)($worksheet->getCellByColumnAndRow(14, $row)->getValue() ?? 0);
                            $imbalan_customer = (int)($worksheet->getCellByColumnAndRow(15, $row)->getValue() ?? 0);
                            $waktu_rekam_customer_excel = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

                            // Proses waktu rekam customer
                            if (is_numeric($waktu_rekam_customer_excel) && $waktu_rekam_customer_excel > 25569) {
                                // Format tanggal Excel (timestamp dimulai dari 1 Januari 1900)
                                try {
                                    $waktu_rekam_customer = Date::excelToDateTimeObject($waktu_rekam_customer_excel)->format('Y-m-d H:i:s');
                                } catch (\Exception $e) {
                                    logError("Baris $row: Error konversi waktu customer Excel: " . $e->getMessage() . ", menggunakan waktu sekarang");
                                    $waktu_rekam_customer = date('Y-m-d H:i:s');
                                }
                            } elseif (!empty($waktu_rekam_customer_excel)) {
                                // Format string tanggal
                                $timestamp = strtotime($waktu_rekam_customer_excel);
                                if ($timestamp === false) {
                                    logError("Baris $row: Format waktu customer tidak valid, menggunakan waktu sekarang");
                                    $waktu_rekam_customer = date('Y-m-d H:i:s');
                                } else {
                                    $waktu_rekam_customer = date('Y-m-d H:i:s', $timestamp);
                                }
                            } else {
                                $waktu_rekam_customer = date('Y-m-d H:i:s');
                            }

                            // Validasi nilai customer
                            $nilai_customer = (int)$nilai_customer;
                            if ($nilai_customer < 1 || $nilai_customer > 10) {
                                logError("Baris $row: Nilai customer tidak valid (1-10), menggunakan nilai default 5");
                                $nilai_customer = 5;
                            }

                            if (!$stmt_customer->execute()) {
                                logError("Baris $row: Error saat memasukkan data customer: " . $stmt_customer->error);
                            }
                        }
                    } else {
                        logError("Baris $row: Error saat memasukkan data pegawai: " . $stmt_pegawai->error);
                        $errorCount++;
                    }
                }

                $stmt_pegawai->close();
                $stmt_customer->close();

            } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                throw new Exception("Error saat membaca file Excel: " . $e->getMessage());
            }
        }

        $conn->commit();
        
        // Redirect ke halaman atasan2024.php setelah sukses dengan pesan detail
        $message = "Berhasil mengimport " . $successCount . " data pegawai2024.";
        if ($errorCount > 0) {
            $message .= " " . $errorCount . " data gagal diimport. Periksa log error untuk detailnya.";
        }
        header("Location: atasan2024.php?import=success&message=" . urlencode($message));
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        logError("Kesalahan umum: " . $e->getMessage());
        die("Error: " . $e->getMessage());
    } finally {
        if (isset($conn)) {
            $conn->close();
        }
    }
}
?>