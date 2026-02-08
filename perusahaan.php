<?php
session_start();
include 'koneksi.php';

// Konfigurasi pagination
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_condition = '';
if (!empty($search)) {
    $search_condition = "WHERE nama LIKE '%$search%'";
}

// Mengambil total jumlah data
$total_sql = "SELECT COUNT(*) FROM data_perusahaan $search_condition";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $limit);

// Mengambil data perusahaan dengan pagination dan search
$sql = "SELECT * FROM data_perusahaan $search_condition ORDER BY nama ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manajemen Perusahaan - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --company-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --text-dark: #333;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --company-gradient: linear-gradient(135deg, #28a745, #20c997);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
            border-bottom: 3px solid var(--company-color);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--company-color) !important;
            font-size: 1.5rem;
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 2rem 0;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section {
            background: var(--company-gradient);
            color: white;
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="buildings" width="100" height="100" patternUnits="userSpaceOnUse"><rect x="10" y="60" width="15" height="30" fill="white" opacity="0.1"/><rect x="30" y="40" width="15" height="50" fill="white" opacity="0.08"/><rect x="50" y="50" width="15" height="40" fill="white" opacity="0.1"/><rect x="70" y="35" width="15" height="55" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23buildings)"/></svg>');
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .content-section {
            padding: 3rem;
        }

        .action-toolbar {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid #e9ecef;
        }

        .btn-success {
            background: var(--company-gradient);
            border: none;
            border-radius: 25px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(40, 167, 69, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #1e3c72);
            border: none;
            border-radius: 25px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(44, 90, 160, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #e0a800);
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            color: #212529;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--company-gradient);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 0.7rem 1rem 0.7rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: var(--company-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .search-box .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--company-color);
        }

        .import-section {
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px dashed var(--company-color);
            margin-bottom: 1rem;
        }

        .pagination .page-link {
            border-radius: 10px;
            margin: 0 2px;
            border: 2px solid #e9ecef;
            color: var(--company-color);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: var(--company-color);
            border-color: var(--company-color);
            transform: translateY(-1px);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--company-color);
            border-color: var(--company-color);
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        @media (max-width: 768px) {
            .content-section {
                padding: 2rem 1rem;
            }
            
            .action-toolbar {
                padding: 1rem;
            }

            .btn-group-mobile {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-group-mobile .btn {
                width: 100%;
            }

            .table-responsive {
                border-radius: 15px;
            }
        }

        .footer {
            background: linear-gradient(135deg, #212529, #343a40);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .company-icon {
            color: var(--company-color);
        }

        .file-upload-area {
            border: 2px dashed var(--company-color);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            background: #e9ecef;
            border-color: #20c997;
        }

        .file-upload-area.dragover {
            background: rgba(40, 167, 69, 0.1);
            border-color: var(--company-color);
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="30" height="30" class="me-2">
            <span><i class="fas fa-building company-icon me-2"></i>BCL JAGAIN - Admin</span>
        </a>
        <div class="d-flex gap-2">
            <a href="admin.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div style="padding-top: 100px;">
    <div class="container">
        <div class="main-container">
            <!-- Header Section -->
            <div class="header-section">
                <div class="container">
                    <div class="header-content">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-4">
                                    <i class="fas fa-industry me-3"></i>
                                    Manajemen Perusahaan
                                </h1>
                                <p class="fs-5 mb-0">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    Kelola data perusahaan yang terdaftar dalam sistem BCL JAGAIN
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="stats-card">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-building fs-2"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0"><?php echo $total_rows; ?></h3>
                                            <p class="mb-0">Total Perusahaan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <!-- Action Toolbar -->
                <div class="action-toolbar">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="create_perusahaan.php" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Tambah Perusahaan
                                </a>
                                <a href="export_perusahaan.php" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>Ekspor Excel
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form method="GET" class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Cari nama perusahaan..." 
                                       value="<?php echo htmlspecialchars($search); ?>">
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Import Section -->
                <div class="import-section">
                    <form id="importForm" action="import_perusahaan.php" method="post" enctype="multipart/form-data">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h5 class="mb-2 company-icon">
                                    <i class="fas fa-upload me-2"></i>Import Data Perusahaan
                                </h5>
                                <div class="file-upload-area" onclick="document.getElementById('file').click();">
                                    <i class="fas fa-cloud-upload-alt fs-2 company-icon mb-2"></i>
                                    <p class="mb-0">Klik untuk pilih file Excel atau drag & drop</p>
                                    <small class="text-muted">Format yang didukung: .xlsx, .xls</small>
                                </div>
                                <input type="file" class="form-control d-none" id="file" name="file" 
                                       accept=".xlsx,.xls" onchange="showFileName(this)">
                                <div id="fileName" class="mt-2 text-muted"></div>
                            </div>
                            <div class="col-lg-4 text-end">
                                <button type="submit" class="btn btn-success btn-lg" disabled id="importBtn">
                                    <i class="fas fa-file-import me-2"></i>Import Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">
                                        <i class="fas fa-hashtag me-2"></i>No
                                    </th>
                                    <th>
                                        <i class="fas fa-building me-2"></i>Nama Perusahaan
                                    </th>
                                    <th width="200" class="text-center">
                                        <i class="fas fa-cogs me-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $no = $offset + 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><span class='badge bg-secondary'>{$no}</span></td>";
                                        echo "<td>
                                                <div class='d-flex align-items-center'>
                                                    <i class='fas fa-industry company-icon me-2'></i>
                                                    <strong>" . htmlspecialchars($row['nama']) . "</strong>
                                                </div>
                                              </td>";
                                        echo "<td class='text-center'>
                                                <div class='btn-group-mobile'>
                                                    <a href='edit_perusahaan.php?id={$row['id']}' class='btn btn-warning btn-sm' title='Edit Perusahaan'>
                                                        <i class='fas fa-edit me-1'></i>Edit
                                                    </a>
                                                    <button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']}, \"" . htmlspecialchars($row['nama']) . "\")' title='Hapus Perusahaan'>
                                                        <i class='fas fa-trash me-1'></i>Hapus
                                                    </button>
                                                </div>
                                              </td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='no-data'>
                                            <i class='fas fa-building'></i>
                                            <h5>Tidak ada data perusahaan</h5>
                                            <p>Belum ada perusahaan yang terdaftar dalam sistem.</p>
                                          </td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan <?php echo $offset + 1; ?> - <?php echo min($offset + $limit, $total_rows); ?> 
                        dari <?php echo $total_rows; ?> data
                    </div>
                    <nav>
                        <ul class="pagination">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php
                            $start = max(1, $page - 2);
                            $end = min($total_pages, $page + 2);
                            
                            for ($i = $start; $i <= $end; $i++):
                            ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <i class="fas fa-building company-icon me-2"></i>
                <strong>BCL JAGAIN - Manajemen Perusahaan</strong>
                <p class="mt-2 mb-0">Copyright &copy; Beacukai Luwuk <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// File upload functionality
function showFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDiv = document.getElementById('fileName');
    const importBtn = document.getElementById('importBtn');
    
    if (fileName) {
        fileNameDiv.innerHTML = `<i class="fas fa-file-excel text-success me-2"></i>File dipilih: <strong>${fileName}</strong>`;
        importBtn.disabled = false;
    } else {
        fileNameDiv.innerHTML = '';
        importBtn.disabled = true;
    }
}

// Drag and drop functionality
const fileUploadArea = document.querySelector('.file-upload-area');
const fileInput = document.getElementById('file');

fileUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileUploadArea.classList.add('dragover');
});

fileUploadArea.addEventListener('dragleave', () => {
    fileUploadArea.classList.remove('dragover');
});

fileUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    fileUploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        showFileName(fileInput);
    }
});

// Form submission with loading
document.getElementById('importForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('importBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengimport...';
    submitBtn.disabled = true;
});

// Delete confirmation with SweetAlert
function confirmDelete(id, name) {
    Swal.fire({
        title: "Konfirmasi Hapus Perusahaan",
        html: `Anda akan menghapus perusahaan:<br><strong class="text-danger">${name}</strong><br><br>Tindakan ini tidak dapat dibatalkan!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang memproses permintaan Anda',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            window.location.href = "delete_perusahaan.php?id=" + id;
        }
    });
}

// Search form auto-submit
let searchTimeout;
document.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 500);
});
</script>

<?php
// SweetAlert notifications
if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
    $icon = $_SESSION['status'] === 'success' ? 'success' : 'error';
    $title = $_SESSION['status'] === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan!';
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . addslashes($_SESSION['message']) . "',
                confirmButtonColor: '#28a745',
                timer: " . ($_SESSION['status'] === 'success' ? '5000' : '0') . ",
                timerProgressBar: true,
                showCloseButton: true
            });
        });
    </script>";
    
    unset($_SESSION['status']);
    unset($_SESSION['message']);
}
?>

</body>
</html>