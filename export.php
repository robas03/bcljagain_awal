<?php
// Include database connection
include 'koneksi.php';

// Include PhpSpreadsheet library
require '../bcljagain/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Create a new PhpSpreadsheet object
$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

// Set column headers
$worksheet->setCellValue('A1', 'No');
$worksheet->setCellValue('B1', 'NIP');
$worksheet->setCellValue('C1', 'Nama Lengkap');
$worksheet->setCellValue('D1', 'Telepon');

// Fetch data from the database
$sql = "SELECT nip, nama, telepon FROM data_pegawai";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = 2; // Start from the second row
    $no = 1;  // Nomor urut

    while ($data = $result->fetch_assoc()) {
        $worksheet->setCellValue('A' . $row, $no); // Kolom No
        $worksheet->setCellValueExplicit('B' . $row, $data['nip'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING); // Kolom NIP (format teks)
        $worksheet->setCellValue('C' . $row, $data['nama']); // Kolom Nama
        $worksheet->setCellValue('D' . $row, $data['telepon']); // Kolom Telepon
        $row++;
        $no++;
    }
}

// Set format kolom NIP sebagai teks
$worksheet->getStyle('B')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);

// Create a writer for Excel (Xlsx)
$writer = new Xlsx($spreadsheet);

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_pegawai.xlsx"');
header('Cache-Control: max-age=0');

// Output to the browser
$writer->save('php://output');

// Close database connection
$conn->close();
?>
