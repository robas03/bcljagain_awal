<?php
// Include database connection
include 'koneksi.php';

// Include PhpSpreadsheet library
require '../bcljagain/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new PhpSpreadsheet object
$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

// Set the column names
$worksheet->setCellValue('A1', 'No');
$worksheet->setCellValue('B1', 'Nama Perusahaan');
$worksheet->setCellValue('C1', 'Lokasi Perusahaan');

// Fetch data from the database
$sql = "SELECT id, nama, lokasi FROM data_perusahaan"; // ✅ Perbaikan: Tambahkan 'nama' dalam SELECT
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Start from the second row
    $no = 1; // Nomor urut

    while ($data = $result->fetch_assoc()) {
        $worksheet->setCellValue('A' . $rowNumber, $no);
        $worksheet->setCellValue('B' . $rowNumber, $data['nama']);
        $worksheet->setCellValue('C' . $rowNumber, $data['lokasi']);
        $rowNumber++;
        $no++;
    }
}

// Create a writer for Excel (Xlsx)
$writer = new Xlsx($spreadsheet);

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_perusahaan.xlsx"');
header('Cache-Control: max-age=0');

// Save the PhpSpreadsheet to a file or output to the browser
$writer->save('php://output');

// Close the database connection
$conn->close();
?>
