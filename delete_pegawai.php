<?php
session_start();
include 'koneksi.php';

// Atur header agar respons berformat JSON
header('Content-Type: application/json');

// Pastikan permintaan menggunakan metode POST dan parameter 'id' ada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Validasi ID
    if (!ctype_digit($id) || (int)$id <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID pegawai tidak valid.'
        ]);
        exit();
    }

    $id = (int)$id;

    // Mulai transaksi database untuk memastikan operasi atomik
    $conn->begin_transaction();

    try {
        // Ambil nama pegawai sebelum dihapus untuk pesan yang lebih informatif
        $sql_select_nama = "SELECT nama FROM data_pegawai WHERE id = ?";
        $stmt_select_nama = $conn->prepare($sql_select_nama);
        if (!$stmt_select_nama) {
            throw new Exception("Gagal menyiapkan query SELECT: " . $conn->error);
        }
        $stmt_select_nama->bind_param("i", $id);
        $stmt_select_nama->execute();
        $result_select_nama = $stmt_select_nama->get_result();
        $pegawai = $result_select_nama->fetch_assoc();
        $nama_pegawai = $pegawai['nama'] ?? 'Pegawai tidak dikenal';
        $stmt_select_nama->close();

        // Siapkan dan jalankan query DELETE
        $sql_delete = "DELETE FROM data_pegawai WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        if (!$stmt_delete) {
            throw new Exception("Gagal menyiapkan query DELETE: " . $conn->error);
        }

        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();

        // Periksa apakah ada baris yang terpengaruh
        if ($stmt_delete->affected_rows > 0) {
            // Jika berhasil, commit transaksi dan kirim respons sukses
            $conn->commit();
            echo json_encode([
                'status' => 'success',
                'message' => "Data pegawai $nama_pegawai berhasil dihapus!",
                'id' => $id
            ]);
        } else {
            // Jika tidak ada baris yang terpengaruh, rollback dan kirim respons error
            $conn->rollback();
            echo json_encode([
                'status' => 'error',
                'message' => 'Data pegawai tidak ditemukan atau sudah dihapus.'
            ]);
        }

        $stmt_delete->close();

    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi dan kirim respons error
        $conn->rollback();
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
} else {
    // Jika permintaan tidak valid, kirim respons error
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode permintaan tidak valid atau ID tidak diberikan.'
    ]);
}

// Tutup koneksi database
$conn->close();
?>