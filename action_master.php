<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $lokasi = $_POST['lokasi'];
    $catatan = $_POST['catatan'];

    $layanan = isset($_POST['ketentuan']) && in_array('layanan', $_POST['ketentuan']);
    $imbalan = isset($_POST['ketentuan']) && in_array('imbalan', $_POST['ketentuan']);

    $formIsComplete = !empty($nip) && !empty($nama) && !empty($telepon) && !empty($lokasi) && !empty($catatan);

    if (!$formIsComplete) {
        echo "<script>
                alert('Gagal simpan karena isian kurang lengkap.');
                window.location.href = 'pegawai.php';
              </script>";
    } elseif (!$layanan || !$imbalan) {
        echo "<script>
                alert('Anda harus mencentang kedua kotak.');
                window.location.href = 'pegawai.php';
              </script>";
    } else {
        $sql = "INSERT INTO pegawai (nip, nama, telepon, lokasi, catatan, layanan, imbalan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $layananValue = $layanan ? 1 : 0;
            $imbalanValue = $imbalan ? 1 : 0;
            $stmt->bind_param("ssssssi", $nip, $nama, $telepon, $lokasi, $catatan, $layananValue, $imbalanValue);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Data berhasil disimpan. Tetap Jaga Integritas.');
                        window.location.href = 'pegawai.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal menyimpan data ke database: " . $stmt->error . "');
                        window.location.href = 'pegawai.php';
                      </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
                    alert('Kesalahan persiapan pernyataan SQL: " . $conn->error . "');
                    window.location.href = 'pegawai.php';
                  </script>";
        }
        $conn->close();
    }
} else {
    echo "<script>
            alert('Metode permintaan tidak valid.');
            window.location.href = 'pegawai.php';
          </script>";
}
?>
