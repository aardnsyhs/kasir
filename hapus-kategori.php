<?php
include "connection.php";

$sulistyo_id = $_GET['id'];
$sulistyo_sql = "DELETE FROM sulistyo_kategori WHERE id_kategori = $sulistyo_id";
$sulistyo_hapus = mysqli_query($conn, $sulistyo_sql);
$sulistyo_ai = "ALTER TABLE sulistyo_kategori AUTO_INCREMENT = $sulistyo_id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($sulistyo_hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data Kategori Berhasil Dihapus');
            window.location.href = 'master-kategori.php';
        </script>";
} else {
    echo "<script>
            alert('Data Kategori Gagal Dihapus');
            window.location.href = 'master-kategori.php';
        </script>";
}
?>