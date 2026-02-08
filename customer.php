<?php
session_start();
include 'koneksi.php';

// Pastikan user memiliki role 'customer'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Portal Customer BCL JAGAIN - Berikan Penilaian Layanan">
    <meta name="author" content="BCL JAGAIN">
    <title>Customer Portal - BCL JAGAIN</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/bcl.ico">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6f42c1;
            --customer-color: #fd7e14;
            --accent-color: #20c997;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --text-dark: #333;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --customer-gradient: linear-gradient(135deg, #fd7e14, #f86d05);
            --purple-gradient: linear-gradient(135deg, #6f42c1, #5a2d91);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stars" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="5" cy="5" r="0.5" fill="white" opacity="0.15"/><circle cx="15" cy="15" r="0.8" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23stars)"/></svg>');
            z-index: -1;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
            border-bottom: 3px solid var(--customer-color);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--customer-color) !important;
            font-size: 1.5rem;
        }

        .main-container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin: 2rem 0;
            animation: fadeInUp 0.8s ease;
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
            background: var(--customer-gradient);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="feedback" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M25 10 L35 20 L25 30 L15 20 Z" fill="white" opacity="0.1"/><circle cx="25" cy="40" r="3" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23feedback)"/></svg>');
            animation: float 25s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(-50px) translateY(-50px) rotate(0deg); }
            100% { transform: translateX(-50px) translateY(-70px) rotate(360deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-image {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease;
        }

        .hero-image:hover {
            transform: translateY(-10px) rotateY(5deg);
        }

        .form-section {
            padding: 4rem;
            background: linear-gradient(135deg, #f8f9ff, #fff5f5);
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(253, 126, 20, 0.1);
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.8rem;
            display: block;
            font-size: 1.1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1.2rem;
            font-size: 1rem;
            transition: all 0.4s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--customer-color);
            box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1.2rem;
            background: #f8f9fa;
            font-size: 1rem;
        }

        .input-group-text {
            background: var(--customer-gradient);
            color: white;
            border: 2px solid var(--customer-color);
            border-radius: 15px 0 0 15px;
            font-weight: 600;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 15px 15px 0;
        }

        .star-rating {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .star-option {
            display: none;
        }

        .star-label {
            cursor: pointer;
            padding: 1rem 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            background: #f8f9fa;
            transition: all 0.3s ease;
            text-align: center;
            font-size: 1.2rem;
            min-width: 80px;
        }

        .star-label:hover {
            background: rgba(253, 126, 20, 0.1);
            border-color: var(--customer-color);
            transform: translateY(-2px);
        }

        .star-option:checked + .star-label {
            background: var(--customer-gradient);
            color: white;
            border-color: var(--customer-color);
            transform: scale(1.05);
        }

        .commitment-section {
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .form-check {
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            margin-bottom: 1rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .form-check:hover {
            border-color: var(--customer-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .form-check-input:checked {
            background-color: var(--customer-color);
            border-color: var(--customer-color);
        }

        .form-check-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.1rem;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--customer-gradient);
            border: none;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(253, 126, 20, 0.3);
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(253, 126, 20, 0.4);
            background: linear-gradient(135deg, #f86d05, #e55a00);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
            border: none;
            border-radius: 25px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(220, 53, 69, 0.3);
        }

        .loading-spinner {
            display: none;
            width: 24px;
            height: 24px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
            margin-right: 12px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .select2-container--bootstrap-5 .select2-selection--single {
            height: calc(3.5rem + 2px) !important;
            border: 2px solid #e9ecef !important;
            border-radius: 15px !important;
            background: #f8f9fa !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            padding-left: 1.2rem !important;
            padding-top: 1rem !important;
            font-size: 1rem !important;
        }

        .feedback-icons {
            text-align: center;
            margin: 2rem 0;
        }

        .feedback-icons i {
            font-size: 3rem;
            color: var(--customer-color);
            margin: 0 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .rating-description {
            text-align: center;
            margin: 1rem 0;
            font-style: italic;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
                text-align: center;
            }
            
            .form-section {
                padding: 2rem 1rem;
            }

            .form-container {
                padding: 2rem 1rem;
            }

            .btn-primary {
                width: 100%;
                margin-top: 1rem;
            }

            .star-rating {
                flex-wrap: wrap;
                justify-content: center;
            }

            .star-label {
                min-width: 60px;
                padding: 0.8rem 1rem;
                font-size: 1rem;
            }
        }

        .footer {
            background: var(--purple-gradient);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .customer-icon {
            color: var(--customer-color);
        }
    </style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="30" height="30" class="me-2">
            <span><i class="fas fa-users customer-icon me-2"></i>BCL JAGAIN - Customer</span>
        </a>
        <div class="d-flex">
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
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="container">
                    <div class="row align-items-center hero-content">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <h1 class="display-4 fw-bold mb-4">
                                <i class="fas fa-star me-3"></i>
                                Berikan Penilaian Layanan
                            </h1>
                            <div class="fs-5 mb-4">
                                <p class="mb-2">
                                    <i class="fas fa-building me-2"></i>
                                    KPPBC TMP C Luwuk
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-heart me-2"></i>
                                    Pengguna Jasa Luwuk Jaga Integritas
                                </p>
                            </div>
                            <div class="feedback-icons">
                                <i class="fas fa-thumbs-up"></i>
                                <i class="fas fa-comments"></i>
                                <i class="fas fa-award"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                            <img class="hero-image" src="../bcljagain/image/jagain.jpeg" alt="Jaga Integritas">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <div class="form-container">
                    <form id="customer-form" action="action_customer.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user" class="form-label">
                                        <i class="fas fa-user customer-icon me-2"></i>Nama Lengkap
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-signature"></i>
                                        </span>
                                        <input type="text" class="form-control" id="user" name="nama" 
                                               required placeholder="Masukkan nama lengkap Anda">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telepon" class="form-label">
                                        <i class="fas fa-phone customer-icon me-2"></i>No. Telepon
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                        <input type="text" class="form-control" id="telepon" name="telepon" 
                                               required onkeypress="return hanyaAngka(event)"
                                               placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi" class="form-label">
                                        <i class="fas fa-industry customer-icon me-2"></i>Nama Perusahaan
                                    </label>
                                    <select class="form-select" id="lokasi" name="lokasi" required>
                                        <option value="" disabled selected>Pilih Perusahaan</option>
                                        <?php
                                        $sql = "SELECT id, nama FROM data_perusahaan ORDER BY nama";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>" . htmlspecialchars($row['nama']) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pegawai" class="form-label">
                                        <i class="fas fa-user-tie customer-icon me-2"></i>Pegawai yang Dinilai
                                    </label>
                                    <select class="form-select" id="pegawai" name="pegawai" required>
                                        <option value="" disabled selected>Pilih Pegawai</option>
                                        <?php
                                        $timeLimit = date('Y-m-d H:i:s', strtotime('-12 hours'));
                                        $sql = "SELECT MIN(id) as id, nip, nama FROM pegawai WHERE waktu_rekam >= '$timeLimit' GROUP BY nama ORDER BY nama";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>" . htmlspecialchars($row['nama']) . " ({$row['nip']})</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-star customer-icon me-2"></i>Berikan Penilaian Anda
                            </label>
                            <div class="star-rating">
                                <input type="radio" name="nilai" value="1" id="star1" class="star-option" required>
                                <label for="star1" class="star-label">⭐<br><small>Buruk</small></label>
                                
                                <input type="radio" name="nilai" value="2" id="star2" class="star-option">
                                <label for="star2" class="star-label">⭐⭐<br><small>Kurang</small></label>
                                
                                <input type="radio" name="nilai" value="3" id="star3" class="star-option">
                                <label for="star3" class="star-label">⭐⭐⭐<br><small>Cukup</small></label>
                                
                                <input type="radio" name="nilai" value="4" id="star4" class="star-option">
                                <label for="star4" class="star-label">⭐⭐⭐⭐<br><small>Baik</small></label>
                                
                                <input type="radio" name="nilai" value="5" id="star5" class="star-option">
                                <label for="star5" class="star-label">⭐⭐⭐⭐⭐<br><small>Excellent</small></label>
                            </div>
                            <div id="ratingDescription" class="rating-description"></div>
                        </div>

                        <div class="form-group">
                            <label for="respon" class="form-label">
                                <i class="fas fa-comment-dots customer-icon me-2"></i>Catatan & Saran
                            </label>
                            <textarea class="form-control" rows="4" id="respon" name="respon" 
                                      placeholder="Berikan catatan atau saran untuk meningkatkan pelayanan..."></textarea>
                        </div>

                        <div class="commitment-section">
                            <h5 class="text-center mb-4">
                                <i class="fas fa-handshake customer-icon me-2"></i>Komitmen Pengguna Jasa
                            </h5>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1" 
                                       name="ketentuan[]" value="layanan" required>
                                <label class="form-check-label" for="check1">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Mentaati peraturan dan ketentuan yang berlaku
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check2" 
                                       name="ketentuan[]" value="imbalan" required>
                                <label class="form-check-label" for="check2">
                                    <i class="fas fa-ban me-2"></i>
                                    Tidak memberi imbalan kepada pegawai yang bertugas
                                </label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <div class="loading-spinner"></div>
                                <i class="fas fa-paper-plane me-2"></i>
                                <span class="btn-text">Kirim Penilaian</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <i class="fas fa-users customer-icon me-2"></i>
                <strong>BCL JAGAIN - Customer Portal</strong>
                <p class="mt-2 mb-0">Copyright &copy; Beacukai Luwuk <?php echo date('Y'); ?></p>
                <p class="small mt-1">Terima kasih atas kepercayaan dan penilaian Anda</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('#lokasi, #pegawai').select2({
        theme: 'bootstrap-5',
        allowClear: true
    });

    // Rating descriptions
    const ratingDescriptions = {
        1: "Layanan sangat tidak memuaskan",
        2: "Layanan kurang memuaskan",
        3: "Layanan cukup memuaskan",
        4: "Layanan baik dan memuaskan",
        5: "Layanan sangat excellent dan memuaskan"
    };

    // Show rating description
    $('input[name="nilai"]').change(function() {
        const value = $(this).val();
        const description = ratingDescriptions[value];
        $('#ratingDescription').text(description).fadeIn();
    });

    // Form submission
    $('#customer-form').submit(function(event) {
        event.preventDefault();
        
        const submitBtn = $(this).find('button[type="submit"]');
        const spinner = submitBtn.find('.loading-spinner');
        const btnText = submitBtn.find('.btn-text');
        
        // Show loading state
        submitBtn.prop('disabled', true);
        spinner.show();
        btnText.text('Mengirim...');
        
        let formData = $(this).serialize();
        
        $.post("action_customer.php", formData, function(response) {
            // Hide loading
            spinner.hide();
            submitBtn.prop('disabled', false);
            btnText.text('Kirim Penilaian');
            
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: 'Terima Kasih!',
                    html: 'Penilaian Anda telah berhasil dikirim.<br>Masukan Anda sangat berharga untuk meningkatkan layanan kami.',
                    confirmButtonColor: '#fd7e14',
                    timer: 6000,
                    timerProgressBar: true,
                    showCloseButton: true
                }).then(() => {
                    $('#customer-form')[0].reset();
                    $('#lokasi, #pegawai').val(null).trigger('change');
                    $('#ratingDescription').fadeOut();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengirim!',
                    text: 'Pastikan semua data telah diisi dengan lengkap dan benar.',
                    confirmButtonColor: '#dc3545'
                });
            }
        }).fail(function() {
            // Hide loading
            spinner.hide();
            submitBtn.prop('disabled', false);
            btnText.text('Kirim Penilaian');
            
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Tidak dapat terhubung ke server. Silakan coba lagi.',
                confirmButtonColor: '#dc3545'
            });
        });
    });
});

// Phone number validation
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        return false;
    }
    return true;
}

// Phone number formatting
$('#telepon').on('input', function() {
    let value = this.value;
    if (value.length === 1 && value !== '0') {
        this.value = '0' + value;
    }
});

// Form validation feedback
$('.form-control, .form-select').on('blur', function() {
    if ($(this).prop('required') && !$(this).val()) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
    }
});

// Clear validation on input
$('.form-control, .form-select').on('input change', function() {
    $(this).removeClass('is-invalid');
});
</script>

</body>
</html>