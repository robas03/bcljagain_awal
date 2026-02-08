<?php
// Include your database connection code from 'koneksi.php'
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $lokasi = $_POST['lokasi'];
    $catatan = $_POST['catatan'];

    // Check if the checkboxes are checked
    $layanan = isset($_POST['ketentuan']) && in_array('layanan', $_POST['ketentuan']) ? 1 : 0;
    $imbalan = isset($_POST['ketentuan']) && in_array('imbalan', $_POST['ketentuan']) ? 1 : 0;

    // Validasi data
    if (empty($nip) || empty($nama) || empty($telepon) || empty($lokasi) || empty($catatan) || (!$layanan && !$imbalan)) {
        // Data tidak lengkap
        echo "<script>
                alert('Gagal simpan karena isian kurang lengkap.');
                window.location.href = 'index.php';
              </script>";
    } else {
        // Data lengkap, simpan ke database
        $sql = "INSERT INTO pegawai (nip, nama, telepon, lokasi, catatan, layanan, imbalan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssssi", $nip, $nama, $telepon, $lokasi, $catatan, $layanan, $imbalan);
            if ($stmt->execute()) {
                // Data berhasil disimpan
                echo "<script>
                        alert('Data berhasil disimpan ke database.');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                // Gagal menyimpan data ke database
                echo "<script>
                        alert('Gagal menyimpan data ke database.');
                        window.location.href = 'index.php';
                      </script>";
            }
            $stmt->close();
        } else {
            // Kesalahan persiapan pernyataan SQL
            echo "<script>
                    alert('Kesalahan persiapan pernyataan SQL.');
                    window.location.href = 'index.php';
                  </script>";
        }

        // Tutup koneksi database
        $connection->close();
    }
} else {
    // Metode permintaan tidak valid
    echo "<script>
            alert('Metode permintaan tidak valid.');
            window.location.href = 'index.php';
          </script>";
}
?>
