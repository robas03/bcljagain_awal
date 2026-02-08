<?php
session_start();
require_once "koneksi.php";

// Cek login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil parameter pagination & pencarian
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Validasi limit
$valid_limits = ['all', 5, 10, 25, 50];
if (!in_array($limit, $valid_limits)) {
    $limit = 10;
}

// Hitung offset
if ($limit !== 'all') {
    $offset = ($page - 1) * $limit;
} else {
    $offset = 0;
}

// Filter pencarian
$search_param = "%" . $search . "%";

// Hitung total data
$count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM users WHERE username LIKE ? OR role LIKE ?");
$count_stmt->bind_param("ss", $search_param, $search_param);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_data = $count_result->fetch_assoc()['total'];
$count_stmt->close();

// Hitung total halaman
$total_pages = ($limit === 'all') ? 1 : ceil($total_data / $limit);

// Ambil data user
$sql = "SELECT * FROM users WHERE username LIKE ? OR role LIKE ? ORDER BY id ASC";
if ($limit !== 'all') {
    $sql .= " LIMIT ?, ?";
}
$stmt = $conn->prepare($sql);
if ($limit !== 'all') {
    $stmt->bind_param("ssii", $search_param, $search_param, $offset, $limit);
} else {
    $stmt->bind_param("ss", $search_param, $search_param);
}
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Hitung jumlah user berdasarkan role dengan variabel $users yang sudah di-fetch
$adminCount = 0;
$pegawaiCount = 0;
$otherCount = 0;

foreach ($users as $user) {
    if ($user['role'] === 'admin') {
        $adminCount++;
    } elseif ($user['role'] === 'pegawai') {
        $pegawaiCount++;
    } else {
        $otherCount++;
    }
}


// Label role
$roleLabels = [
    'admin'      => 'Administrator',
    'atasan'     => 'Atasan',
    'pegawai'    => 'Pegawai',
    'perusahaan' => 'Perusahaan'
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Users - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            color: #334155;
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
        .btn-outline-secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            background: transparent;
        }
        .btn-outline-secondary:hover {
            background: var(--secondary-color);
            color: white;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
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
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: var(--card-shadow-hover);
        }
        .modal-header {
            background: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .modal-title {
            font-weight: 600;
        }
        .btn-close {
            filter: brightness(0) invert(1);
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
        .role-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .role-admin {
            background: #fef3c7;
            color: #92400e;
        }
        .role-atasan {
            background: #dbeafe;
            color: #1e40af;
        }
        .role-pegawai {
            background: #d1fae5;
            color: #065f46;
        }
        .role-perusahaan {
            background: #e5e7eb;
            color: #374151;
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
            .search-form {
                flex-direction: column;
                gap: 1rem;
            }
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
            <span>BCL JAGAIN - Manajemen User</span>
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

    <div class="container main-container fade-in">
        <h1 class="page-title">
            <i class="bi bi-people-fill"></i> Manajemen User
        </h1>
        
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?= $total_data ?></div>
                    <div class="stats-label">Total User</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= $adminCount; ?>
                    </div>
                    <div class="stats-label">Administrator</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= $pegawaiCount; ?>
                    </div>
                    <div class="stats-label">Pegawai</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= $otherCount; ?>
                    </div>
                    <div class="stats-label">User Lainnya</div>
                </div>
            </div>
        </div>
        
        <div class="action-card">
            <form class="row g-3 search-form" method="get">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Cari username atau role">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="limit" class="form-select">
                        <?php foreach ($valid_limits as $opt): ?>
                            <option value="<?= $opt ?>" <?= ($limit == $opt) ? 'selected' : '' ?>>
                                <?= ($opt === 'all') ? 'Semua Data' : $opt . ' Data' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus-circle"></i> Tambah User
                    </button>
                </div>
            </form>
        </div>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($users) > 0): ?>
                        <?php $no = ($limit === 'all') ? 1 : $offset + 1; ?>
                        <?php foreach ($users as $row): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            <i class="bi bi-person-circle fs-3 text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars($row['username']) ?></div>
                                            <small class="text-muted">ID: <?= $row['id'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-<?= $row['role'] ?>">
                                        <?= htmlspecialchars($roleLabels[$row['role']] ?? $row['role']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['id'] ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['id'] ?>, '<?= htmlspecialchars($row['username']) ?>')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editUserModal<?= $row['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="user_edit.php">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                        <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-shield"></i></span>
                                                        <select name="role" class="form-select" required>
                                                            <option value="admin" <?= $row['role']=='admin'?'selected':'' ?>>Administrator</option>
                                                            <option value="atasan" <?= $row['role']=='atasan'?'selected':'' ?>>Atasan</option>
                                                            <option value="pegawai" <?= $row['role']=='pegawai'?'selected':'' ?>>Pegawai</option>
                                                            <option value="perusahaan" <?= $row['role']=='perusahaan'?'selected':'' ?>>Perusahaan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle"></i> Batal
                                                </button>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="mt-2 text-muted">Tidak ada data user</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan
                <?php if ($limit === 'all'): ?>
                    <?= $total_data ?>
                <?php else: ?>
                    <?= min($limit, $total_data - $offset) ?>
                <?php endif; ?>
                dari <?= $total_data ?> data
            </small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <?php if ($limit !== 'all' && $total_pages > 1): ?>
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1&limit=<?= $limit ?>&search=<?= urlencode($search) ?>">
                                    <i class="bi bi-chevron-double-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $total_pages); $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&limit=<?= $limit ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $total_pages ?>&limit=<?= $limit ?>&search=<?= urlencode($search) ?>">
                                    <i class="bi bi-chevron-double-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="user_add.php">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield"></i></span>
                                <select name="role" class="form-select" required>
                                    <option value="admin">Administrator</option>
                                    <option value="atasan">Atasan</option>
                                    <option value="pegawai">Pegawai</option>
                                    <option value="perusahaan">Perusahaan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Tambah User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <footer class="text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> BCL JAGAIN. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to show notification
        function showNotification(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb',
                timer: 3000,
                timerProgressBar: true
            });
        }
        
        // Check for URL parameters to show notifications
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success')) {
            showNotification('Berhasil!', urlParams.get('success'), 'success');
        } else if (urlParams.get('error')) {
            showNotification('Error!', urlParams.get('error'), 'error');
        }
        
        // Confirm delete function
        function confirmDelete(id, username) {
            Swal.fire({
                title: 'Hapus User?',
                html: `Apakah Anda yakin ingin menghapus user <strong>${username}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `user_delete.php?id=${id}`;
                }
            });
        }
        
        // Add animation to elements when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>