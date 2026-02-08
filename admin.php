<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard BCL JAGAIN - Kelola Sistem Integritas">
    <meta name="author" content="BCL JAGAIN">
    <title>Admin Dashboard - BCL JAGAIN</title>
    <link rel="icon" type="image/x-icon" href="../bcljagain/image/bcl.ico">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --admin-primary: #6c5ce7;
            --admin-secondary: #a29bfe;
            --admin-accent: #fd79a8;
            --admin-success: #00b894;
            --admin-warning: #fdcb6e;
            --admin-danger: #e17055;
            --text-dark: #2d3436;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --admin-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-gradient: linear-gradient(135deg, #6c5ce7, #a29bfe);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--admin-gradient);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="admin-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23admin-grid)"/></svg>');
            z-index: -1;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid var(--admin-primary);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--admin-primary) !important;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin: 2rem 0;
            animation: fadeInUp 0.8s ease;
            backdrop-filter: blur(10px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-section {
            background: var(--card-gradient);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="admin-pattern" width="60" height="60" patternUnits="userSpaceOnUse"><circle cx="30" cy="30" r="4" fill="white" opacity="0.1"/><rect x="20" y="20" width="20" height="20" fill="none" stroke="white" stroke-width="1" opacity="0.08"/><path d="M15 45 L25 35 L35 45 L45 35" fill="none" stroke="white" stroke-width="1" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23admin-pattern)"/></svg>');
            animation: float 30s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(-50px) translateY(-50px) rotate(0deg); }
            100% { transform: translateX(-50px) translateY(-70px) rotate(360deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .dashboard-section {
            padding: 4rem;
            background: linear-gradient(135deg, #f8f9ff, #fff5f8);
        }

        .dashboard-card {
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(108, 92, 231, 0.1);
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .dashboard-card:hover::before {
            left: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(108, 92, 231, 0.2);
            text-decoration: none;
            color: inherit;
        }

        .card-header {
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header.perusahaan {
            background: linear-gradient(135deg, #00b894, #00cec9);
        }

        .card-header.pegawai {
            background: linear-gradient(135deg, #0984e3, #74b9ff);
        }

        .card-header.user {
            background: linear-gradient(135deg, #fd79a8, #fdcb6e);
        }

        .card-icon {
            font-size: 4rem;
            color: white;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover .card-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .card-body {
            padding: 2rem;
            text-align: center;
        }

        .card-description {
            color: var(--text-dark);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card-features li {
            padding: 0.5rem 0;
            color: #666;
            font-size: 0.9rem;
        }

        .card-features li i {
            color: var(--admin-primary);
            margin-right: 0.5rem;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--admin-danger), #d63031);
            border: none;
            border-radius: 25px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(225, 112, 85, 0.3);
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .admin-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--admin-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer {
            background: linear-gradient(135deg, #2d3436, #636e72);
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            text-align: center;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-description {
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--admin-accent);
            transform: translateY(-2px);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }
            
            .dashboard-section {
                padding: 2rem 1rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .card-icon {
                font-size: 3rem;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .dashboard-card:hover {
                transform: translateY(-5px) scale(1.01);
            }

            .stat-number {
                font-size: 2rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .loading-animation {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e3e3e3;
            border-top: 4px solid var(--admin-primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="30" height="30" class="me-2">
            <span><i class="fas fa-crown text-warning me-2"></i>BCL JAGAIN - Admin</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="ms-auto d-flex gap-2">
            <a href="logout.php" class="btn btn-danger" onclick="showLoading()">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<!-- Loading Animation -->
<div id="loadingAnimation" class="loading-animation">
    <div class="spinner"></div>
    <p>Loading...</p>
</div>

<!-- Main Content -->
<div style="padding-top: 100px;">
    <div class="container">
        <div class="main-container">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="admin-badge">
                    <i class="fas fa-shield-alt me-1"></i>ADMIN
                </div>
                <div class="container">
                    <div class="hero-content text-center">
                        <h1 class="display-3 fw-bold mb-4">
                            <i class="fas fa-tachometer-alt me-3"></i>
                            Admin Dashboard
                        </h1>
                        <p class="fs-4 mb-4">
                            Sistem Manajemen BCL JAGAIN - Kelola Integritas dengan Mudah
                        </p>
                        <div class="stats-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stat-item">
                                        <span class="stat-number">
                                            <i class="fas fa-building me-2"></i>∞
                                        </span>
                                        <div class="stat-label">Perusahaan</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-item">
                                        <span class="stat-number">
                                            <i class="fas fa-users me-2"></i>∞
                                        </span>
                                        <div class="stat-label">Pegawai</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-item">
                                        <span class="stat-number">
                                            <i class="fas fa-user-cog me-2"></i>∞
                                        </span>
                                        <div class="stat-label">Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Section -->
            <div class="dashboard-section">
                <div class="row g-4">
                    <!-- Perusahaan Card -->
                    <div class="col-lg-4 col-md-6">
                        <a href="perusahaan.php" class="dashboard-card" onclick="showLoading()">
                            <div class="card-header perusahaan">
                                <div class="card-icon">
                                    <i class="fas fa-industry"></i>
                                </div>
                                <h3 class="card-title">Perusahaan</h3>
                                <p class="card-subtitle">Kelola Data Perusahaan</p>
                            </div>
                            <div class="card-body">
                                <p class="card-description">
                                    Manajemen lengkap data perusahaan yang terdaftar dalam sistem BCL JAGAIN.
                                </p>
                                <ul class="card-features">
                                    <li><i class="fas fa-check"></i> Tambah & Edit Perusahaan</li>
                                    <li><i class="fas fa-check"></i> Import/Export Excel</li>
                                    <li><i class="fas fa-check"></i> Search & Filter Data</li>
                                    <li><i class="fas fa-check"></i> Manajemen Database</li>
                                </ul>
                            </div>
                        </a>
                    </div>

                    <!-- Pegawai Card -->
                    <div class="col-lg-4 col-md-6">
                        <a href="index_pegawai.php" class="dashboard-card" onclick="showLoading()">
                            <div class="card-header pegawai">
                                <div class="card-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h3 class="card-title">Pegawai</h3>
                                <p class="card-subtitle">Kelola Data Pegawai</p>
                            </div>
                            <div class="card-body">
                                <p class="card-description">
                                    Sistem manajemen pegawai dengan fitur pernyataan integritas dan monitoring.
                                </p>
                                <ul class="card-features">
                                    <li><i class="fas fa-check"></i> Data Pegawai Lengkap</li>
                                    <li><i class="fas fa-check"></i> Pernyataan Integritas</li>
                                    <li><i class="fas fa-check"></i> Monitoring Aktivitas</li>
                                    <li><i class="fas fa-check"></i> Laporan & Analytics</li>
                                </ul>
                            </div>
                        </a>
                    </div>

                    <!-- User Card -->
                    <div class="col-lg-4 col-md-6">
                        <a href="user.php" class="dashboard-card" onclick="showLoading()">
                            <div class="card-header user">
                                <div class="card-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h3 class="card-title">User</h3>
                                <p class="card-subtitle">Kelola Pengguna Sistem</p>
                            </div>
                            <div class="card-body">
                                <p class="card-description">
                                    Manajemen pengguna sistem dengan kontrol akses dan role management.
                                </p>
                                <ul class="card-features">
                                    <li><i class="fas fa-check"></i> User Management</li>
                                    <li><i class="fas fa-check"></i> Role & Permission</li>
                                    <li><i class="fas fa-check"></i> Access Control</li>
                                    <li><i class="fas fa-check"></i> Security Settings</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="text-center">
                            <h4 class="mb-4">
                                <i class="fas fa-bolt me-2" style="color: var(--admin-primary);"></i>
                                Quick Actions
                            </h4>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <button class="btn btn-outline-primary" onclick="showComingSoon()">
                                    <i class="fas fa-chart-bar me-2"></i>View Reports
                                </button>
                                <button class="btn btn-outline-success" onclick="showComingSoon()">
                                    <i class="fas fa-download me-2"></i>Export All Data
                                </button>
                                <button class="btn btn-outline-warning" onclick="showComingSoon()">
                                    <i class="fas fa-cog me-2"></i>System Settings
                                </button>
                                <button class="btn btn-outline-info" onclick="showComingSoon()">
                                    <i class="fas fa-question-circle me-2"></i>Help & Support
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-shield-alt me-2" style="color: var(--admin-accent);"></i>
                BCL JAGAIN - Admin Portal
            </div>
            <p class="footer-description">
                Sistem Manajemen Integritas Beacukai Luwuk - Kelola dengan Profesional
            </p>
            <ul class="footer-links">
                <li><a href="#" onclick="showComingSoon()"><i class="fas fa-home me-1"></i>Dashboard</a></li>
                <li><a href="#" onclick="showComingSoon()"><i class="fas fa-chart-line me-1"></i>Analytics</a></li>
                <li><a href="#" onclick="showComingSoon()"><i class="fas fa-cog me-1"></i>Settings</a></li>
                <li><a href="#" onclick="showComingSoon()"><i class="fas fa-life-ring me-1"></i>Support</a></li>
            </ul>
            <div class="copyright">
                <p class="mb-0">
                    <i class="fas fa-copyright me-1"></i>
                    Copyright &copy; Beacukai Luwuk <?php echo date('Y'); ?> - All Rights Reserved
                </p>
                <small class="mt-2 d-block">Powered by BCL JAGAIN Admin System</small>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Show loading animation
function showLoading() {
    document.getElementById('loadingAnimation').style.display = 'block';
}

// Hide loading animation
function hideLoading() {
    document.getElementById('loadingAnimation').style.display = 'none';
}

// Coming soon notification
function showComingSoon() {
    Swal.fire({
        icon: 'info',
        title: 'Coming Soon!',
        text: 'Fitur ini sedang dalam pengembangan dan akan segera hadir.',
        confirmButtonColor: '#6c5ce7',
        timer: 3000,
        timerProgressBar: true,
        showCloseButton: true
    });
}

// Page load animation
document.addEventListener('DOMContentLoaded', function() {
    // Hide loading when page is fully loaded
    window.addEventListener('load', function() {
        setTimeout(hideLoading, 500);
    });

    // Add hover sound effect (optional)
    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add click effect
    cards.forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'translateY(-5px) scale(0.98)';
            setTimeout(() => {
                showLoading();
            }, 150);
        });
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + 1 = Perusahaan
    if ((e.ctrlKey || e.metaKey) && e.key === '1') {
        e.preventDefault();
        window.location.href = 'perusahaan.php';
    }
    
    // Ctrl/Cmd + 2 = Pegawai
    if ((e.ctrlKey || e.metaKey) && e.key === '2') {
        e.preventDefault();
        window.location.href = 'index_pegawai.php';
    }
    
    // Ctrl/Cmd + 3 = User
    if ((e.ctrlKey || e.metaKey) && e.key === '3') {
        e.preventDefault();
        window.location.href = 'user.php';
    }
});

// Welcome message
setTimeout(function() {
    Swal.fire({
        icon: 'success',
        title: 'Selamat Datang Admin!',
        text: 'Anda berhasil masuk ke Admin Dashboard BCL JAGAIN',
        confirmButtonColor: '#6c5ce7',
        timer: 4000,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',
        showConfirmButton: false
    });
}, 1000);
</script>

</body>
</html>