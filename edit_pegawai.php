<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pegawai - BCL JAGAIN</title>
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
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-top: 80px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--card-shadow);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
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
            max-width: 800px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
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

        .form-label {
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .required:after {
            content: " *";
            color: var(--danger-color);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                padding: 1.5rem;
                border-radius: 15px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index_pegawai.php">
                <img src="../bcljagain/image/bcl.png" alt="Logo BCL" width="30" height="30">
                <span>BCL JAGAIN - Edit Pegawai</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="main-container">
            <h1 class="page-title">
                <i class="fas fa-user-edit"></i>
                Edit Data Pegawai
            </h1>
            
            <?php
            include 'koneksi.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM data_pegawai WHERE id = ?";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    } else {
                        // Redirect jika data tidak ditemukan
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Tidak Ditemukan',
                                text: 'Data pegawai tidak ditemukan dalam database.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'index_pegawai.php';
                            });
                        </script>";
                        exit();
                    }
                    $stmt->close();
                }
            } else {
                // Redirect jika ID tidak diset
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Akses Tidak Valid',
                        text: 'Parameter ID tidak ditemukan.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'index_pegawai.php';
                    });
                </script>";
                exit();
            }

            if (isset($_POST['update'])) {
                $newNIP = trim($_POST['nip']);
                $newNama = trim($_POST['nama']);
                $newTelepon = trim($_POST['telepon']);
                
                // Validasi input
                if (empty($newNIP) || empty($newNama)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Tidak Lengkap',
                            text: 'NIP dan Nama Lengkap wajib diisi!',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                } else {
                    // Cek apakah NIP sudah ada (kecuali untuk pegawai ini sendiri)
                    $checkNIP = "SELECT id FROM data_pegawai WHERE nip = ? AND id != ?";
                    $stmt_check = $conn->prepare($checkNIP);
                    $stmt_check->bind_param("si", $newNIP, $id);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();
                    
                    if ($result_check->num_rows > 0) {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'NIP Sudah Digunakan',
                                text: 'NIP ini sudah terdaftar untuk pegawai lain!',
                                confirmButtonText: 'OK'
                            });
                        </script>";
                    } else {
                        // Update data
                        $sql = "UPDATE data_pegawai SET nip = ?, nama = ?, telepon = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);

                        if ($stmt) {
                            $stmt->bind_param("sssi", $newNIP, $newNama, $newTelepon, $id);
                            
                            if ($stmt->execute()) {
                                echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data pegawai berhasil diperbarui.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = 'index_pegawai.php';
                                    });
                                </script>";
                                exit();
                            } else {
                                echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan saat memperbarui data: " . addslashes($conn->error) . "',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                            }
                            $stmt->close();
                        }
                    }
                    $stmt_check->close();
                }
            }
            ?>

            <form action="" method="post" id="editForm">
                <div class="mb-3">
                    <label for="nip" class="form-label required">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?php echo htmlspecialchars($row['nip']); ?>" required>
                    <div class="form-text">Nomor Induk Pegawai harus unik</div>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label required">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo htmlspecialchars($row['telepon'] ?? ''); ?>" placeholder="Contoh: 08123456789">
                    <div class="form-text">Opsional, isi dengan nomor telepon aktif</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" name="update">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="index_pegawai.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validasi form sebelum submit
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const nip = document.getElementById('nip').value.trim();
            const nama = document.getElementById('nama').value.trim();
            
            if (!nip || !nama) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Lengkap',
                    text: 'NIP dan Nama Lengkap wajib diisi!',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>
</html>