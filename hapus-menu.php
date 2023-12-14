<?php
include "connection.php";

$sulistyo_id = $_GET['id'];
$sulistyo_sql = "DELETE FROM sulistyo_menu WHERE id_menu = $sulistyo_id";
$sulistyo_hapus = mysqli_query($conn, $sulistyo_sql);
$sulistyo_ai = "ALTER TABLE sulistyo_menu AUTO_INCREMENT = $sulistyo_id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($sulistyo_hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data Menu Berhasil Dihapus');
            window.location.href = 'master-menu.php';
        </script>";
} else {
    echo "<script>
            alert('Data Menu Gagal Dihapus');
            window.location.href = 'master-menu.php';
        </script>";
}
?>