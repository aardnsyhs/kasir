<?php
include "connection.php";

$sulistyo_id = $_GET['id'];
$sulistyo_sql = "DELETE FROM sulistyo_pelanggan WHERE id_pelanggan = $sulistyo_id";
$sulistyo_hapus = mysqli_query($conn, $sulistyo_sql);
$sulistyo_ai = "ALTER TABLE sulistyo_pelanggan AUTO_INCREMENT = $sulistyo_id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($sulistyo_hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data Pelanggan Berhasil Dihapus');
            window.location.href = 'master-pelanggan.php';
        </script>";
} else {
    echo "<script>
            alert('Data Pelanggan Gagal Dihapus');
            window.location.href = 'master-pelanggan.php';
        </script>";
}
?>