<?php
include 'koneksi.php';

// Pastikan koneksi database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// --- BAGIAN PENGAMBILAN DATA UNTUK STATISTIK (LEBIH EFISIEN) ---
// Total Pegawai
$stmt_pegawai = mysqli_prepare($conn, "SELECT COUNT(DISTINCT id) AS total_pegawai FROM pegawai");
mysqli_stmt_execute($stmt_pegawai);
$result_pegawai = mysqli_stmt_get_result($stmt_pegawai);
$row_pegawai = mysqli_fetch_assoc($result_pegawai);
$total_pegawai = $row_pegawai['total_pegawai'];
mysqli_stmt_close($stmt_pegawai);

// Total Customer
$stmt_customer = mysqli_prepare($conn, "SELECT COUNT(id) AS total_customer FROM customer");
mysqli_stmt_execute($stmt_customer);
$result_customer = mysqli_stmt_get_result($stmt_customer);
$row_customer = mysqli_fetch_assoc($result_customer);
$total_customer = $row_customer['total_customer'];
mysqli_stmt_close($stmt_customer);

// Rata-rata Nilai
$stmt_nilai = mysqli_prepare($conn, "SELECT AVG(nilai) AS avg_nilai FROM customer WHERE nilai IS NOT NULL AND nilai != ''");
mysqli_stmt_execute($stmt_nilai);
$result_nilai = mysqli_stmt_get_result($stmt_nilai);
$row_nilai = mysqli_fetch_assoc($result_nilai);
$avg_nilai = number_format($row_nilai['avg_nilai'] ?? 0, 1);
mysqli_stmt_close($stmt_nilai);

// --- BAGIAN PENGAMBILAN DATA UNTUK TABEL (MENGGUNAKAN PREPARED STATEMENT) ---
$sql_table = "SELECT 
            p.id AS pegawai_id,
            p.nip AS nip_pegawai, 
            p.nama AS nama_pegawai, 
            p.telepon AS telepon_pegawai, 
            p.lokasi AS lokasi_pegawai, 
            p.catatan AS catatan_pegawai, 
            p.layanan AS layanan_pegawai,
            p.imbalan AS imbalan_pegawai,
            c.nama AS nama_customer,
            c.telepon AS telepon_customer,
            c.lokasi_id AS lokasi_id_customer,
            c.nilai AS nilai_customer, 
            c.respon AS respon_customer,
            c.layanan AS layanan_customer,
            c.imbalan AS imbalan_customer,
            p.waktu_rekam AS waktu_rekam_pegawai
        FROM pegawai p
        LEFT JOIN customer c ON p.id = c.pegawai_id
        ORDER BY p.waktu_rekam DESC";

$result_table = mysqli_query($conn, $sql_table);
if (!$result_table) {
    die("Error dalam query tabel: " . mysqli_error($conn));
}

$data_rows = [];
if (mysqli_num_rows($result_table) > 0) {
    while ($row = mysqli_fetch_assoc($result_table)) {
        $data_rows[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monitoring Pegawai - BCL JAGAIN</title>

    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
        }

        .main-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .main-header h1 {
            font-weight: 300;
            margin: 0;
        }

        .main-header .subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 0.5rem;
        }

        .table-container {
            padding: 1.5rem;
        }

        /* DataTables Styling */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_length label,
        .dataTables_filter label {
            font-weight: 500;
            color: var(--dark-color);
        }

        .dataTables_length select,
        .dataTables_filter input {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.375rem 0.75rem;
            margin: 0 0.5rem;
        }

        .dataTables_filter input {
            width: 250px;
        }

        .dataTables_length select:focus,
        .dataTables_filter input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem 0.75rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .nilai-badge {
            min-width: 40px;
            display: inline-block;
            text-align: center;
        }

        .nilai-tinggi {
            background-color: var(--success-color);
        }

        .nilai-sedang {
            background-color: var(--warning-color);
            color: var(--dark-color);
        }

        .nilai-rendah {
            background-color: var(--danger-color);
        }

        /* Pagination Styling */
        .dataTables_paginate .paginate_button {
            border: 1px solid #dee2e6;
            margin: 0 2px;
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            color: var(--primary-color) !important;
            background: white !important;
        }

        .dataTables_paginate .paginate_button:hover {
            background: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color);
        }

        .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color);
        }

        .dataTables_info {
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .main-header {
                padding: 1.5rem 0;
            }

            .main-header h1 {
                font-size: 1.75rem;
            }

            .card-header {
                padding: 1rem;
            }

            .table-container {
                padding: 1rem;
            }

            .dataTables_filter input {
                width: 200px;
            }
        }

        @media (max-width: 576px) {
            .dataTables_filter input {
                width: 100%;
                margin-top: 0.5rem;
            }

            .dataTables_length,
            .dataTables_filter {
                text-align: center;
            }
        }

        .stats-cards {
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-weight: 500;
        }

        .export-buttons {
            margin-bottom: 1rem;
        }

        .btn-export {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="35" height="35" class="me-2">
                <span>BCL JAGAIN</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto">
                    <a href="logout.php" class="btn btn-light">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-header">
        <div class="container text-center">
            <h1><i class="bi bi-clipboard-data me-2"></i>Monitoring Pegawai</h1>
            <p class="subtitle mb-0">Pantau kinerja dan aktivitas pegawai secara real-time</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row stats-cards">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-number text-primary"><?= htmlspecialchars($total_pegawai) ?></div>
                    <div class="stat-label">Total Pegawai</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon text-success">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="stat-number text-success"><?= htmlspecialchars($total_customer) ?></div>
                    <div class="stat-label">Total Customer</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon text-warning">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="stat-number text-warning"><?= htmlspecialchars($avg_nilai) ?></div>
                    <div class="stat-label">Rata-rata Nilai</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon text-info">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="stat-number text-info">
                    <?php
                        date_default_timezone_set('Asia/Makassar');
                        echo date('H:i');
                        ?>
                    </div>
                    <div class="stat-label">Waktu Sekarang</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-table"></i>
                    Data Monitoring Pegawai
                </h5>
            </div>
            <div class="table-container">
                <div class="export-buttons">
                <button type="button" class="btn btn-success btn-export" id="exportExcel">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Export Excel
                </button>
                <button type="button" class="btn btn-danger btn-export" id="exportPDF">
                    <i class="bi bi-file-earmark-pdf me-1"></i>
                    Export PDF
                </button>
                <button type="button" class="btn btn-info btn-export" id="printTable">
                    <i class="bi bi-printer me-1"></i>
                    Print
                </button>
                <button type="button" class="btn btn-primary btn-export" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-file-earmark-arrow-up me-1"></i>
                    Import Data
                </button>
                <a href="atasan2024.php" class="btn btn-warning btn-export">
                    <i class="bi bi-calendar me-1"></i>
                    Data 2024
                </a>
            </div>

                <div class="table-responsive">
                    <table id="monitoringTable" class="table table-hover" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>No. Telepon</th>
                                <th>Lokasi</th>
                                <th>Catatan</th>
                                <th>Customer</th>
                                <th>Nilai</th>
                                <th>Respon</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($data_rows)) {
                                $no = count($data_rows);
                                foreach ($data_rows as $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no--; ?></td>
                                <td><strong><?= htmlspecialchars($row['nip_pegawai'] ?? 'N/A'); ?></strong></td>
                                <td><?= htmlspecialchars($row['nama_pegawai'] ?? 'N/A'); ?></td>
                                <td>
                                    <?php if (!empty($row['telepon_pegawai'])): ?>
                                    <a href="tel:<?= htmlspecialchars($row['telepon_pegawai']); ?>"
                                        class="text-decoration-none">
                                        <i class="bi bi-telephone me-1"></i>
                                        <?= htmlspecialchars($row['telepon_pegawai']); ?>
                                    </a>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['lokasi_pegawai'])): ?>
                                    <i class="bi bi-geo-alt me-1 text-primary"></i>
                                    <?= htmlspecialchars($row['lokasi_pegawai']); ?>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['catatan_pegawai'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($row['nama_customer'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['nilai_customer']) && is_numeric($row['nilai_customer'])): ?>
                                    <?php
                                    $nilai = (int)$row['nilai_customer'];
                                    $badge_class = 'nilai-rendah';
                                    if ($nilai >= 8) $badge_class = 'nilai-tinggi';
                                    elseif ($nilai >= 6) $badge_class = 'nilai-sedang';
                                    ?>
                                    <span class="badge <?= $badge_class ?> nilai-badge">
                                        <?= $nilai ?>
                                    </span>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['respon_customer'] ?? '-'); ?></td>
                                <td data-order="<?= !empty($row['waktu_rekam_pegawai']) ? strtotime($row['waktu_rekam_pegawai']) : 0 ?>">
                                    <?php if (!empty($row['waktu_rekam_pegawai'])): ?>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= date('d/m/Y', strtotime($row['waktu_rekam_pegawai'])); ?><br>
                                        <i class="bi bi-clock me-1"></i>
                                        <?= date('H:i:s', strtotime($row['waktu_rekam_pegawai'])); ?>
                                    </small>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                    <h5>Tidak Ada Data</h5>
                                    <p class="mb-0">Belum ada data pegawai yang tersedia dalam sistem.</p>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0">
                <i class="bi bi-c-circle me-1"></i>
                <?= date('Y') ?> Beacukai Luwuk. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $("#monitoringTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [
                    [9, "desc"]
                ],
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    },
                    {
                        "className": "text-center",
                        "targets": [0, 7]
                    },
                    {
                        "width": "5%",
                        "targets": 0
                    },
                    {
                        "width": "8%",
                        "targets": 1
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    },
                    {
                        "width": "12%",
                        "targets": 3
                    },
                    {
                        "width": "15%",
                        "targets": 4
                    },
                    {
                        "width": "8%",
                        "targets": 7
                    },
                    {
                        "width": "12%",
                        "targets": 9
                    }
                ],
                "language": {
                    "lengthMenu": "_MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "emptyTable": "Tidak ada data tersedia dalam tabel"
                },
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [{
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                        className: 'btn btn-success',
                        title: 'Data Monitoring Pegawai - ' + new Date().toLocaleDateString('id-ID')
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Data Monitoring Pegawai',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i> Print',
                        className: 'btn btn-info',
                        title: 'Data Monitoring Pegawai'
                    }
                ]
            });

            $('#exportExcel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            $('#exportPDF').on('click', function() {
                table.button('.buttons-pdf').trigger();
            });

            $('#printTable').on('click', function() {
                table.button('.buttons-print').trigger();
            });

            $('.stat-card').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'transform': 'translateY(20px)'
                }).delay(index * 100).animate({
                    'opacity': '1'
                }, 500).css('transform', 'translateY(0)');
            });

            $(document).ajaxStart(function() {
                $('body').append('<div class="loading-overlay"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            }).ajaxStop(function() {
                $('.loading-overlay').remove();
            });

            $('#refreshData').on('click', function() {
                location.reload();
            });

            $('#submitImport').on('click', function() {
                const fileInput = $('#importFile')[0];
                if (fileInput.files.length === 0) {
                    alert('Silakan pilih file untuk diimport!');
                    return;
                }
                $('#importForm').submit();
            });

            // Perbaikan untuk tombol download template
            $('#downloadTemplate').on('click', function(e) {
                e.preventDefault();

                // Menggunakan Data URI yang lebih andal
                const csvContent = "data:text/csv;charset=utf-8," + encodeURIComponent("nip,nama_pegawai,telepon_pegawai,lokasi_pegawai,catatan_pegawai,layanan_pegawai,imbalan_pegawai,waktu_rekam_pegawai,nama_customer,lokasi_id,telepon_customer,nilai,respon,layanan_customer,imbalan_customer,waktu_rekam_customer\n12345,Ahmad,08123456789,Kantor A,Catatan A,1,1,2023-01-01 08:00:00,Customer A,1,08111111111,8,Baik,1,0,2023-01-01 10:00:00\n67890,Budi,08987654321,Kantor B,Catatan B,0,1,2023-01-02 09:00:00,Customer B,2,08222222222,7,Cukup,0,1,2023-01-02 11:00:00");

                const link = document.createElement('a');
                link.setAttribute('href', csvContent);
                link.setAttribute('download', 'template_import_data.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });

            $(document).ready(function() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('import') === 'success') {
                    const newUrl = window.location.pathname;
                    window.history.replaceState({}, document.title, newUrl);
                    const alertHtml = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>Data berhasil diimport ke database!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    $('.stats-cards').after(alertHtml);
                }
            });
        });
    </script>
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">
                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Import Data Pegawai
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="importForm" action="import_data.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="importFile" class="form-label">Pilih File Excel/CSV</label>
                            <input type="file" class="form-control" id="importFile" name="importFile"
                                accept=".xlsx,.xls,.csv" required>
                            <div class="form-text">Format yang didukung: .xlsx, .xls, .csv</div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="truncateTable"
                                    name="truncateTable">
                                <label class="form-check-label" for="truncateTable">
                                    Hapus data yang ada sebelum import
                                </label>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Pastikan file Anda memiliki format yang sesuai dengan struktur database.
                            <a href="#" class="alert-link" id="downloadTemplate">Download template</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submitImport">
                        <i class="bi bi-upload me-1"></i>Import
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>