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

// Opsi jumlah data per halaman
$limit_options = [10, 20, 50, 'all'];
$limit = isset($_GET['limit']) && in_array($_GET['limit'], $limit_options) ? $_GET['limit'] : 10;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query untuk menghitung total data
$sql_count = "SELECT COUNT(*) AS total FROM data_pegawai WHERE nip LIKE ? OR nama LIKE ?";
$stmt_count = $conn->prepare($sql_count);
$search_param = "%$search%";
$stmt_count->bind_param("ss", $search_param, $search_param);
$stmt_count->execute();
$total_data = $stmt_count->get_result()->fetch_assoc()['total'];
$stmt_count->close();

// Hitung halaman
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$start = ($page - 1) * ($limit !== 'all' ? $limit : $total_data);

// Query untuk mengambil data sesuai filter, termasuk kolom 'telepon'
$sql = "SELECT id, nip, nama, telepon FROM data_pegawai WHERE nip LIKE ? OR nama LIKE ? ORDER BY nama ASC ";
if ($limit !== 'all') {
    $sql .= "LIMIT ?, ?";
}

$stmt = $conn->prepare($sql);
if ($limit !== 'all') {
    $stmt->bind_param("ssii", $search_param, $search_param, $offset, $limit);
} else {
    $stmt->bind_param("ss", $search_param, $search_param);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pegawai - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--card-shadow);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            margin: 2rem auto;
            padding: 2rem;
            max-width: 95%;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .action-card {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .table {
            margin-bottom: 0;
            border-radius: 15px;
        }

        .table thead th {
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e2e8f0;
        }

        .table tbody tr:hover {
            background-color: var(--light-bg);
        }

        .pagination {
            justify-content: center;
            gap: 0.5rem;
        }

        .page-link {
            border-radius: 10px;
            border: none;
            padding: 0.75rem 1rem;
            color: var(--primary-color);
            font-weight: 500;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .search-form {
            background: white;
            padding: 1rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }

        .import-section {
            background: linear-gradient(135deg, var(--success-color) 0%, #10b981 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        .stats-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            text-align: center;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stats-label {
            color: var(--secondary-color);
            font-weight: 500;
        }

        footer {
            background: rgba(30, 41, 59, 0.95) !important;
            backdrop-filter: blur(10px);
            margin-top: 3rem;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                padding: 1rem;
                border-radius: 15px;
            }

            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .action-card {
                padding: 1rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .table-responsive {
                border-radius: 15px;
            }

            .search-form {
                flex-direction: column;
                gap: 1rem;
            }

            .import-section {
                text-align: center;
            }

            .import-section form {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="30" height="30">
            <span>BCL JAGAIN - Admin</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex gap-2">
                <a href="admin.php" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="logout.php" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div style="margin-top: 100px;"></div>

<div class="container">
    <div class="main-container fade-in">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-users"></i>
                    Manajemen Data Pegawai
                </h1>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number"><?= $total_data ?></div>
                    <div class="stats-label">Total Pegawai</div>
                </div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="action-card">
            <div class="row">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <div class="import-section">
                        <h5 class="mb-3">
                            <i class="fas fa-file-excel"></i> Import/Export Data
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <a href="export.php" class="btn btn-light w-100">
                                    <i class="fas fa-download"></i> Ekspor Template Excel
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="import.php" method="post" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                                    <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls" required>
                                    <button type="submit" class="btn btn-light">
                                        <i class="fas fa-upload"></i> Import
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a href="create_pegawai.php" class="btn btn-primary w-100 mb-2" style="padding: 1rem;">
                        <i class="fas fa-user-plus"></i> Tambah Pegawai Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <form action="" method="GET" class="search-form d-flex">
                    <input type="text" name="search" id="search" class="form-control me-2" 
                           placeholder="🔍 Cari berdasarkan NIP atau Nama Pegawai..." 
                           value="<?= htmlspecialchars($search) ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="?" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <form action="" method="GET" class="d-flex align-items-center">
                    <label for="limit" class="me-2 text-nowrap">Tampilkan:</label>
                    <select name="limit" id="limit" class="form-control me-2" onchange="this.form.submit()">
                        <?php foreach ($limit_options as $option): ?>
                            <option value="<?= $option ?>" <?= ($limit == $option) ? 'selected' : '' ?>>
                                <?= $option === 'all' ? 'Semua' : $option . ' data' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Telepon</th>
                            <th width="200" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = $start + 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr data-id="<?= $row['id'] ?>">
                                    <td class="fw-bold"><?= $no++ ?></td>
                                    <td>
                                        <span class="badge bg-primary"><?= htmlspecialchars($row['nip']) ?></span>
                                    </td>
                                    <td class="fw-medium"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['telepon']) ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="edit_pegawai.php?id=<?= urlencode($row['id']) ?>" 
                                               class="btn btn-warning btn-sm" 
                                               data-bs-toggle="tooltip" 
                                               title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete(<?= intval($row['id']) ?>, '<?= addslashes(htmlspecialchars($row['nama'])) ?>')"
                                                    data-bs-toggle="tooltip" 
                                                    title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-users fa-3x mb-3"></i>
                                        <h5>Tidak ada data pegawai</h5>
                                        <p>
                                            <?php if (!empty($search)): ?>
                                                Pencarian "<?= htmlspecialchars($search) ?>" tidak ditemukan
                                            <?php else: ?>
                                                Belum ada data pegawai yang tersedia
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php
        $total_pages = ($limit !== 'all') ? ceil($total_data / $limit) : 1;
        if ($total_pages > 1):
        ?>
        <nav aria-label="Navigasi halaman">
            <ul class="pagination justify-content-center">
                <!-- Previous -->
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&limit=<?= $limit ?>">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php 
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $page + 2);
                
                if ($start_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1&search=<?= urlencode($search) ?>&limit=<?= $limit ?>">1</a>
                    </li>
                    <?php if ($start_page > 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif;
                endif;

                for ($i = $start_page; $i <= $end_page; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&limit=<?= $limit ?>"><?= $i ?></a>
                    </li>
                <?php endfor;

                if ($end_page < $total_pages): 
                    if ($end_page < $total_pages - 1): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $total_pages ?>&search=<?= urlencode($search) ?>&limit=<?= $limit ?>"><?= $total_pages ?></a>
                    </li>
                <?php endif; ?>

                <!-- Next -->
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&limit=<?= $limit ?>">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>

        <!-- Info Section -->
        <?php if ($total_data > 0): ?>
        <div class="d-flex justify-content-between align-items-center mt-4 text-muted">
            <small>
                Menampilkan <?= $start + 1 ?> - <?= min($start + ($limit !== 'all' ? $limit : $total_data), $total_data) ?> 
                dari <?= $total_data ?> data pegawai
            </small>
            <small>
                <?php if (!empty($search)): ?>
                    Hasil pencarian untuk: "<?= htmlspecialchars($search) ?>"
                <?php endif; ?>
            </small>
        </div>
        <?php endif; ?>
    </div>
</div>

<footer class="py-4 bg-dark text-white text-center">
    <div class="container">
        <p class="mb-0">
            <i class="fas fa-copyright"></i> 
            Copyright Beacukai Luwuk <?= date('Y') ?> - Sistem Manajemen Pegawai
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

// Confirm delete function
function confirmDelete(id, name) {
    Swal.fire({
        title: "⚠️ Konfirmasi Penghapusan",
        html: `Apakah Anda yakin ingin menghapus data pegawai:<br><strong>${name}</strong>?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal',
        reverseButtons: true,
        customClass: {
            popup: 'fade-in',
            confirmButton: 'btn-danger',
            cancelButton: 'btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan SweetAlert "Menghapus..." dan panggil proses hapus
            Swal.fire({
                title: 'Menghapus Data...',
                text: 'Mohon tunggu sebentar',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Panggil proses hapus lewat AJAX
            fetch("delete_pegawai.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(id)
            })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Tutup SweetAlert loading
                if (data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Hapus baris dari tabel tanpa reload
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) row.remove();
                        
                        // Perbarui total data (jika elemen ini ada)
                        const statsNumber = document.getElementById('total-pegawai'); // Gunakan ID untuk selektor yang lebih spesifik
                        if (statsNumber) {
                            const currentTotal = parseInt(statsNumber.textContent);
                            if (!isNaN(currentTotal) && currentTotal > 0) {
                                statsNumber.textContent = currentTotal - 1;
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        html: data.message || "Terjadi kesalahan saat menghapus data."
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Tutup SweetAlert loading
                console.error('Error:', error);
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Terjadi kesalahan sistem. Silakan coba lagi nanti."
                });
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                icon: 'info',
                title: 'Dibatalkan',
                text: 'Penghapusan data dibatalkan.',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}
    // Auto-hide search placeholder on mobile
    function updatePlaceholder() {
        const searchInput = document.getElementById('search');
        if (window.innerWidth < 768) {
            searchInput.placeholder = '🔍 Cari NIP atau Nama...';
        } else {
            searchInput.placeholder = '🔍 Cari berdasarkan NIP atau Nama Pegawai...';
        }
    }

    // Update placeholder on load and resize
    updatePlaceholder();
    window.addEventListener('resize', updatePlaceholder);

    // Add loading state to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !form.classList.contains('import-form')) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                form.classList.add('loading');
            }
        });
    });

    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Tambahkan loading saat proses import
    const importForm = document.querySelector('form[action="import.php"]');
    if (importForm) {
        importForm.classList.add('import-form');
        importForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Memproses Import...',
                html: 'Mohon tunggu, sedang memproses data Anda.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form setelah delay singkat untuk menampilkan loading
            setTimeout(() => {
                this.submit();
            }, 500);
        });
    }
</script>

<?php
// Tampilkan notifikasi hasil import
if (isset($_SESSION['import_result'])) {
    $result = $_SESSION['import_result'];
    $success = $result['success'];
    
    // Hapus session setelah notifikasi ditampilkan
    unset($_SESSION['import_result']);
    
    if ($success) {
        $successCount = $result['success_count'];
        $failedCount = $result['failed_count'];
        $successData = $result['success_data'];
        $failedData = $result['failed_data'];
        
        // Buat pesan notifikasi
        $message = "<div style='text-align: left;'>";
        $message .= "<p><strong>📊 Ringkasan Import:</strong></p>";
        $message .= "<ul>";
        $message .= "<li>✅ Berhasil: " . $successCount . " data</li>";
        $message .= "<li>❌ Gagal: " . $failedCount . " data</li>";
        $message .= "</ul>";
        
        if ($successCount > 0) {
            $message .= "<p><strong>✅ Data Berhasil Diimport:</strong></p>";
            $message .= "<div style='max-height: 150px; overflow-y: auto;'>";
            $message .= "<table class='table table-sm table-striped'>";
            $message .= "<thead><tr><th>NIP</th><th>Nama</th><th>Telepon</th></tr></thead><tbody>";
            foreach ($successData as $data) {
                $message .= "<tr>";
                $message .= "<td>" . htmlspecialchars($data['nip']) . "</td>";
                $message .= "<td>" . htmlspecialchars($data['nama']) . "</td>";
                $message .= "<td>" . htmlspecialchars($data['telepon']) . "</td>";
                $message .= "</tr>";
            }
            $message .= "</tbody></table></div>";
        }
        
        if ($failedCount > 0) {
            $message .= "<p><strong>❌ Data Gagal Diimport:</strong></p>";
            $message .= "<div style='max-height: 150px; overflow-y: auto;'>";
            $message .= "<table class='table table-sm table-striped'>";
            $message .= "<thead><tr><th>NIP</th><th>Nama</th><th>Alasan</th></tr></thead><tbody>";
            foreach ($failedData as $data) {
                $message .= "<tr>";
                $message .= "<td>" . htmlspecialchars($data['nip']) . "</td>";
                $message .= "<td>" . htmlspecialchars($data['nama']) . "</td>";
                $message .= "<td>" . htmlspecialchars($data['alasan']) . "</td>";
                $message .= "</tr>";
            }
            $message .= "</tbody></table></div>";
        }
        
        $message .= "</div>";
        
        // Tampilkan notifikasi dengan SweetAlert
        echo "<script>
            Swal.fire({
                title: 'Hasil Import Data',
                html: `" . $message . "`,
                icon: '" . ($failedCount == 0 ? 'success' : ($successCount == 0 ? 'error' : 'warning')) . "',
                width: '800px',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'fade-in'
                },
                willClose: () => {
                    // Refresh halaman setelah SweetAlert ditutup
                    window.location.reload();
                }
            });
        </script>";
    } else {
        // Tampilkan pesan error
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: `" . addslashes($result['message']) . "`,
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'fade-in'
                },
                willClose: () => {
                    // Refresh halaman setelah SweetAlert ditutup
                    window.location.reload();
                }
            });
        </script>";
    }
}

// Tampilkan notifikasi alert biasa jika ada
if (isset($alert)) {
    echo "<script>
        Swal.fire({
            icon: '" . $alert['status'] . "',
            title: '" . ($alert['status'] === 'success' ? '✅ Berhasil!' : ($alert['status'] === 'error' ? '❌ Gagal!' : 'ℹ️ Informasi')) . "',
            html: " . json_encode($alert['message']) . ",
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'fade-in'
            },
            willClose: () => {
                // Refresh halaman setelah SweetAlert ditutup
                window.location.reload();
            }
        });
    </script>";
}
?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>