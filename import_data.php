<?php
// Pastikan semua error ditampilkan saat pengembangan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

// Gunakan mysqli_real_escape_string dan prepared statements
// untuk mencegah SQL injection.
// Pastikan $conn sudah terdefinisi dan koneksi berhasil.
if (!isset($conn) || !$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Load library untuk Excel jika diperlukan
require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi file upload lebih awal
    if (!isset($_FILES["importFile"]) || $_FILES["importFile"]["error"] != 0) {
        die("Error: Terjadi kesalahan saat mengunggah file. Kode error: " . $_FILES["importFile"]["error"]);
    }

    $fileName = $_FILES["importFile"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $tmpName = $_FILES["importFile"]["tmp_name"];

    // Validasi tipe file
    $allowedTypes = array("xlsx", "xls", "csv");
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die("Error: Hanya file Excel (.xlsx, .xls) dan CSV (.csv) yang diperbolehkan.");
    }
    
    // Nonaktifkan foreign key checks dan truncate tabel dalam satu transaksi jika perlu
    if (isset($_POST["truncateTable"]) && $_POST["truncateTable"] == "on") {
        // Mulai transaksi
        mysqli_begin_transaction($conn);
        try {
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
            mysqli_query($conn, "TRUNCATE TABLE customer");
            mysqli_query($conn, "TRUNCATE TABLE pegawai");
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
            mysqli_commit($conn); // Commit transaksi jika berhasil
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conn); // Rollback jika ada error
            die("Error saat mengosongkan tabel: " . $e->getMessage());
        }
    }

    // Proses file berdasarkan tipe
    if (strtolower($fileType) == "csv") {
        ## Memproses file CSV
        if (($file = fopen($tmpName, "r")) !== FALSE) {
            // Lewati baris header
            fgetcsv($file);
            
            // Siapkan prepared statement untuk pegawai
            $stmt_pegawai = mysqli_prepare($conn, "INSERT INTO pegawai (nip, nama, telepon, lokasi, catatan, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            // Siapkan prepared statement untuk customer
            $stmt_customer = mysqli_prepare($conn, "INSERT INTO customer (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $rowCount = 0;
            $successCount = 0;
            $errorCount = 0;
            
            // Loop melalui setiap baris data
            while (($row = fgetcsv($file)) !== FALSE) {
                $rowCount++;
                
                // Pastikan jumlah kolom sesuai
                if (count($row) < 8) {
                    error_log("Baris $rowCount: Jumlah kolom tidak mencukupi (" . count($row) . " kolom)");
                    $errorCount++;
                    continue; // Lewati baris yang tidak lengkap
                }
                
                // Ambil dan bersihkan data
                $nip = trim($row[0] ?? '');
                $nama_pegawai = trim($row[1] ?? '');
                $telepon_pegawai = trim($row[2] ?? '');
                $lokasi_pegawai = trim($row[3] ?? '');
                $catatan_pegawai = trim($row[4] ?? '');
                $layanan_pegawai = empty($row[5]) ? 0 : (int)trim($row[5]);
                $imbalan_pegawai = empty($row[6]) ? 0 : (int)trim($row[6]);
                $waktu_rekam_pegawai = empty($row[7]) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s', strtotime(trim($row[7])));
                
                // Validasi data wajib
                if (empty($nip)) {
                    error_log("Baris $rowCount: NIP kosong");
                    $errorCount++;
                    continue;
                }
                
                if (empty($nama_pegawai)) {
                    error_log("Baris $rowCount: Nama pegawai kosong");
                    $errorCount++;
                    continue;
                }
                
                // Bind parameter dan eksekusi prepared statement pegawai
                mysqli_stmt_bind_param($stmt_pegawai, "sssssiss", $nip, $nama_pegawai, $telepon_pegawai, $lokasi_pegawai, $catatan_pegawai, $layanan_pegawai, $imbalan_pegawai, $waktu_rekam_pegawai);
                
                if (mysqli_stmt_execute($stmt_pegawai)) {
                    $pegawai_id = mysqli_insert_id($conn);
                    $successCount++;
                    
                    // Jika ada data customer, masukkan
                    if (count($row) > 8 && !empty($row[8])) {
                        $nama_customer = trim($row[8] ?? '');
                        $lokasi_id = empty($row[9]) ? 0 : (int)trim($row[9]);
                        $telepon_customer = trim($row[10] ?? '');
                        $nilai = trim($row[11] ?? '');
                        $respon = trim($row[12] ?? '');
                        $layanan_customer = empty($row[13]) ? 0 : (int)trim($row[13]);
                        $imbalan_customer = empty($row[14]) ? 0 : (int)trim($row[14]);
                        $waktu_rekam_customer = empty($row[15]) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s', strtotime(trim($row[15])));
                        
                        // Validasi data customer wajib
                        if (empty($nama_customer)) {
                            error_log("Baris $rowCount: Nama customer kosong");
                            continue;
                        }
                        
                        // Bind parameter dan eksekusi prepared statement customer
                        mysqli_stmt_bind_param($stmt_customer, "sssiisiss", $nama_customer, $lokasi_id, $telepon_customer, $pegawai_id, $nilai, $respon, $layanan_customer, $imbalan_customer, $waktu_rekam_customer);
                        
                        if (!mysqli_stmt_execute($stmt_customer)) {
                            error_log("Baris $rowCount: Error saat memasukkan data customer: " . mysqli_stmt_error($stmt_customer));
                        }
                    }
                } else {
                    error_log("Baris $rowCount: Error saat memasukkan data pegawai: " . mysqli_stmt_error($stmt_pegawai));
                    $errorCount++;
                }
            }
            
            // Tutup prepared statements
            mysqli_stmt_close($stmt_pegawai);
            mysqli_stmt_close($stmt_customer);
            
            fclose($file);
            
            if ($successCount == 0) {
                die("Error: Tidak ada data yang berhasil diimport. Periksa format file Anda dan pastikan kolom NIP dan Nama tidak kosong.");
            }
            
        } else {
            die("Error: Tidak bisa membuka file CSV.");
        }
    } else {
        ## Memproses file Excel
        try {
            // Cek apakah ekstensi zip tersedia
            if (!class_exists('ZipArchive') && strtolower($fileType) === 'xlsx') {
                die("Error: Format .xlsx memerlukan ekstensi PHP Zip yang diaktifkan. Silakan gunakan format .xls atau .csv.");
            }
            
            // Gunakan reader yang sesuai dengan tipe file
            if (strtolower($fileType) === 'xlsx') {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            } else {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
            }
            
            // Load file
            $spreadsheet = $reader->load($tmpName);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            // Siapkan prepared statement
            $stmt_pegawai = mysqli_prepare($conn, "INSERT INTO pegawai (nip, nama, telepon, lokasi, catatan, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_customer = mysqli_prepare($conn, "INSERT INTO customer (nama, lokasi_id, telepon, pegawai_id, nilai, respon, layanan, imbalan, waktu_rekam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $successCount = 0;
            $errorCount = 0;
            
            // Lewati baris header
            for ($row = 2; $row <= $highestRow; $row++) {
                // Ambil data dari sel
                $nip = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $nama_pegawai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $telepon_pegawai = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $lokasi_pegawai = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $catatan_pegawai = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $layanan_pegawai = (int)($worksheet->getCellByColumnAndRow(6, $row)->getValue() ?? 0);
                $imbalan_pegawai = (int)($worksheet->getCellByColumnAndRow(7, $row)->getValue() ?? 0);
                
                // Ambil nilai waktu rekam
                $waktu_rekam_cell = $worksheet->getCellByColumnAndRow(8, $row);
                $waktu_rekam_value = $waktu_rekam_cell->getValue();
                
                // Cek apakah sel berisi tanggal
                if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($waktu_rekam_cell)) {
                    // Jika ya, konversi ke objek DateTime lalu ke string
                    $waktu_rekam_pegawai = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($waktu_rekam_value)->format('Y-m-d H:i:s');
                } else {
                    // Jika bukan tanggal, coba parse sebagai string
                    if (!empty($waktu_rekam_value)) {
                        $timestamp = strtotime($waktu_rekam_value);
                        if ($timestamp !== false) {
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s', $timestamp);
                        } else {
                            $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                        }
                    } else {
                        $waktu_rekam_pegawai = date('Y-m-d H:i:s');
                    }
                }
                
                // Validasi data wajib
                if (empty($nip)) {
                    error_log("Baris $row: NIP kosong");
                    $errorCount++;
                    continue;
                }
                
                if (empty($nama_pegawai)) {
                    error_log("Baris $row: Nama pegawai kosong");
                    $errorCount++;
                    continue;
                }
                
                // Bind parameter dan eksekusi prepared statement pegawai
                mysqli_stmt_bind_param($stmt_pegawai, "sssssiss", 
                    $nip, 
                    $nama_pegawai, 
                    $telepon_pegawai, 
                    $lokasi_pegawai, 
                    $catatan_pegawai, 
                    $layanan_pegawai, 
                    $imbalan_pegawai,
                    $waktu_rekam_pegawai
                );
                
                if (mysqli_stmt_execute($stmt_pegawai)) {
                    $pegawai_id = mysqli_insert_id($conn);
                    $successCount++;
                    
                    // Cek apakah ada data customer
                    $nama_customer = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    if (!empty($nama_customer)) {
                        $lokasi_id = (int)($worksheet->getCellByColumnAndRow(10, $row)->getValue() ?? 0);
                        $telepon_customer = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $nilai = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $respon = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $layanan_customer = (int)($worksheet->getCellByColumnAndRow(14, $row)->getValue() ?? 0);
                        $imbalan_customer = (int)($worksheet->getCellByColumnAndRow(15, $row)->getValue() ?? 0);
                        
                        // Ambil nilai waktu rekam customer
                        $waktu_rekam_customer_cell = $worksheet->getCellByColumnAndRow(16, $row);
                        $waktu_rekam_customer_value = $waktu_rekam_customer_cell->getValue();
                        
                        // Cek apakah sel berisi tanggal
                        if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($waktu_rekam_customer_cell)) {
                            // Jika ya, konversi ke objek DateTime lalu ke string
                            $waktu_rekam_customer = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($waktu_rekam_customer_value)->format('Y-m-d H:i:s');
                        } else {
                            // Jika bukan tanggal, coba parse sebagai string
                            if (!empty($waktu_rekam_customer_value)) {
                                $timestamp = strtotime($waktu_rekam_customer_value);
                                if ($timestamp !== false) {
                                    $waktu_rekam_customer = date('Y-m-d H:i:s', $timestamp);
                                } else {
                                    $waktu_rekam_customer = date('Y-m-d H:i:s');
                                }
                            } else {
                                $waktu_rekam_customer = date('Y-m-d H:i:s');
                            }
                        }

                        // Bind parameter dan eksekusi prepared statement customer
                        mysqli_stmt_bind_param($stmt_customer, "sssiisiss",
                            $nama_customer, 
                            $lokasi_id, 
                            $telepon_customer, 
                            $pegawai_id, 
                            $nilai, 
                            $respon, 
                            $layanan_customer, 
                            $imbalan_customer,
                            $waktu_rekam_customer
                        );
                        
                        if (!mysqli_stmt_execute($stmt_customer)) {
                            error_log("Baris $row: Error saat memasukkan data customer: " . mysqli_stmt_error($stmt_customer));
                        }
                    }
                } else {
                    error_log("Baris $row: Error saat memasukkan data pegawai: " . mysqli_stmt_error($stmt_pegawai));
                    $errorCount++;
                }
            }
            
            // Tutup prepared statements
            mysqli_stmt_close($stmt_pegawai);
            mysqli_stmt_close($stmt_customer);
            
            if ($successCount == 0) {
                die("Error: Tidak ada data yang berhasil diimport. Periksa format file Anda dan pastikan kolom NIP dan Nama tidak kosong.");
            }

        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            die("Error saat membaca file Excel: " . $e->getMessage());
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    // Redirect setelah semua proses selesai dengan informasi detail
    $message = "Berhasil mengimport " . $successCount . " data pegawai.";
    if ($errorCount > 0) {
        $message .= " " . $errorCount . " data gagal diimport. Periksa log error untuk detailnya.";
    }
    header("Location: atasan.php?import=success&message=" . urlencode($message));
    exit();
}
?>